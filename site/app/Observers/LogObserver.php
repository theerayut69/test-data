<?php
namespace App\Observers;

use Storage;
use App\Fixture;

class LogObserver
{
    public function created(Fixture $model)
    {
        $action = 'created';
        Storage::prepend('test_file.log', '[' . date('Y-m-d H:i:s') . '] ' . $action . ' table:' . $model->getTable() . ' id:' . $model->id);
    }

    public function updated(Fixture $model)
    {
        $action = 'updated';
        Storage::prepend('test_file.log', '[' . date('Y-m-d H:i:s') . '] ' . $action . ' table:' . $model->getTable() . ' id:' . $model->id);
    }

    public function deleting(Fixture $model)
    {
        $action = 'deleted';
        Storage::prepend('test_file.log', '[' . date('Y-m-d H:i:s') . '] ' . $action . ' table:' . $model->getTable() . ' id:' . $model->id);
    }
}