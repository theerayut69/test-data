<?php
namespace App\Observers;

use Auth;
use Storage;

class LogObserver
{
    public function created(Team $model)
    {
        $action = 'created';
        Storage::prepend('test_file.log', date('Y-m-d H:i:s') . ' ' . $action . ' table:' . $model->getTable() . ' id:' . $model->id);
    }

    public function updated(Team $model)
    {
        $action = 'updated';
        Storage::prepend('test_file.log', '[' . date('Y-m-d H:i:s') . '] ' . $action . ' table:' . $model->getTable() . ' id:' . $model->id);
    }

    public function deleting(Team $model)
    {
        $action = 'deleted';
        Storage::prepend('test_file.log', date('Y-m-d H:i:s') . ' ' . $action . ' table:' . $model->getTable() . ' id:' . $model->id);
    }
}