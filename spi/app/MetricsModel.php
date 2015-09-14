<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MetricsModel extends Model {

    public function scopeGetAuditUser( $query, $id )
    {
        $user = User::findOrFail($id);
        return  $user->last_name . ', ' . $user->first_name;

    }

}
