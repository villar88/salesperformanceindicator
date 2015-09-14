<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPassword extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_passwords';

    


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

