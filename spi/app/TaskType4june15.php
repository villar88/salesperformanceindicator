<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskType extends Model {

    protected $table = 'task_types';
    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function scopeGetTasks( $query)
    {

        $task_total = Task::whereRaw('task_type_id = ?', array($this->id))->get();

        return $task_total;
    }
}
