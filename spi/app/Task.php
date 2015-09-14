<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Task extends Model {

    public $timestamps = false;


    public function scopeGetTodayPoints( $query )
    {
        $user = Auth::user();
        $task_total = $users = DB::table('point_audits')
            ->join('tasks', 'point_audits.task_id', '=', 'tasks.id')
            ->select(DB::raw('SUM(point*value) as total'))
            ->where('date', '=', DB::raw('CURDATE()'))
            ->where('user_id', '=', $user->id)
            ->where('task_id', '=', $this->id)
            ->groupBy('user_id')
            ->first();

            return empty($task_total->total) ?  '0 pts' : $task_total->total.' pts';

        //return "(0)";
    }
}
