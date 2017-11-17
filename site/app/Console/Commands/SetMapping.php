<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;

class SetMapping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:mapping {--force : Drop existing index before mapping}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set ElasticSearch Mapping and Settings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $hosts = [ env('ELASTICSEARCH_HOST', 'http://laravel:laravel@elasticsearch:9200') ];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
        $this->index = 'mthai';
        $this->type = 'search';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $force = $this->option('force');
        if ($force) {
            $parameters = ['index' => $this->index];
            $res = $this->client->indices()->delete($parameters);
            $response = $this->client->indices()->create($parameters);
            if (array_get($response, 'acknowledged') == 1) {
                $this->info('Create Index successful');
            } else {
                $this->error('Failed');
                return;
            }
        }
        
        $settings = json_decode(file_get_contents(__DIR__.'/settings.json'), true);
        $item = array();
        $item = $settings;
        $set = array();
        $set ['index'] = $this->index;
        $set ['body'] = $item;

        $this->client->indices()->close(['index' => $this->index]);
        $response = $this->client->indices()->putSettings($set);
        $this->client->indices()->open(['index' => $this->index]);

        if (array_get($response, 'acknowledged') == 1) {
            $this->info('Settings successful');
        } else {
            $this->error('Failed');
            return;
        }

        $mappings = json_decode(file_get_contents(__DIR__.'/mapping.json'), true);
        $map ['index'] = $this->index;
        $map ['type'] = $this->type;
        $map ['body'] = $mappings;
        $response = $this->client->indices()->putMapping($map);
        if (array_get($response, 'acknowledged') == 1) {
            $this->info('Mapping successful');
        } else {
            $this->error('Failed');
            return;
        }
    }
}
