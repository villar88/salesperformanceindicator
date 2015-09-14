<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['last_name', 'first_name', 'email', 'password', 'role_id', 'address1', 'address2', 'contact_number', 'company_id','manager_id', 'updated_by', 'updated_at', 'created_by', 'created_at', 'status','active_date','inactive_date'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function goalManagement()
    {
        return $this->hasOne('App\GoalManagement');
    }


    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function scopeGetCompleteName( $query, $id )
    {
        $user = User::findOrFail($id);
        return  $user.first_Name . ', ' . $user.first_Name;

    }

    public function scopeGetEmailDisp( $query )
    {

        if( $this->status == 'INACTIVE' )
        {
            //$emailArr = explode('_', $this->email);
            //return $emailArr[1];
            return $this->email;
        }
        else{
            return $this->email;
        }

    }
}