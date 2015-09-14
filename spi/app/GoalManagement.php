<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GoalManagement extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'goal_managements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jan',
        'feb',
        'mar',
        'apr',
        'may',
        'jun',
        'jul',
        'aug',
        'sep',
        'oct',
        'nov',
        'dec',
        'annual',
        'updated_by'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

