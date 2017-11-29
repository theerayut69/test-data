<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     LeagueSeeder::class,
        //     TeamSeeder::class,
        //     PlayerSeeder::class,
        //     FixtureSeeder::class,
        // ]);
        $this->call(LeagueSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(PlayerSeeder::class);
        $this->call(FixtureSeeder::class);
    }
}
