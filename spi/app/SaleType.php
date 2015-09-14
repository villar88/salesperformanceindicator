<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleType extends Model {

    public function scopeGetTodaySales( $query )
    {
        $user = Auth::user();
        $sales_total = $users = DB::table('sale_audits')
            ->select(DB::raw('SUM(sale) as total'))
            ->where('date', '=', DB::raw('CURDATE()') )
            ->where('user_id', '=', $user->id)
            ->where('saleType_id', '=', $this->id)
            ->groupBy('user_id')
            ->first();
        return empty( $sales_total->total ) ?  '(0)' : '('. number_format( $sales_total->total, 2 ) .')';
    }

}
