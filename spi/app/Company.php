<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends MetricsModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'created_by', 'updated_by'];

    public $timestamps = true;

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function scopeGetAllSortedOwners( $query, $id )
    {
        $users = User::whereRaw('company_id = ? and role_id = ?', array($id, 4))->get();
        $owners = array();
        foreach( $users as $user )
        {
            array_push($owners, ($user->first_name . ' ' . $user->last_name) );
        }

        if( count($owners) == 0 )
        {
            return ' ';
        }
        else
        {
            return implode(", ", $owners);
        }

    }


    public function scopeGetUsersCount( $query, $id )
    {
        $count = User::whereRaw('company_id = ?', array($id))->count();
        return $count. " users";

    }


    public function scopeGetActiveUsersCount( $query, $id )
    {
        $count = User::whereIn('status', array( 'NEW', 'ACTIVE', 'RESET' ))->where('company_id', '=', $id)->count();
        return $count. " users";

    }
}
