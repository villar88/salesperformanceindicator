<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'licenses';

    


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

