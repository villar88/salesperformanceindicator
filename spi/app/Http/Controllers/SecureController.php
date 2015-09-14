<?php

namespace App\Http\Controllers;

use App\GoalManagement;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SecureController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function calculateAnnual(Requests\SaveGoalSettingRequest $request) {
        return ( ( $request->jan * 5 ) * 4 ) + ( ( $request->feb * 5 ) * 4 ) + ( ( $request->mar * 5 ) * 4 ) + ( ( $request->apr * 5 ) * 4 ) + ( ( $request->may * 5 ) * 4 )
                + ( ( $request->jun * 5 ) * 4 ) + ( ( $request->jul * 5 ) * 4 ) + ( ( $request->aug * 5 ) * 4 ) + ( ( $request->sep * 5 ) * 4 ) + ( ( $request->oct * 5 ) * 4 )
                + ( ( $request->nov * 5 ) * 4 ) + ( ( $request->dec * 5 ) * 4 );
    }

    public function assembleGoalSetting() {
        $goal = new GoalManagement();
        $default_sales = 10000;
        $goal->jan = $default_sales;
        $goal->feb = $default_sales;
        $goal->mar = $default_sales;
        $goal->apr = $default_sales;
        $goal->may = $default_sales;
        $goal->jun = $default_sales;
        $goal->jul = $default_sales;
        $goal->aug = $default_sales;
        $goal->sep = $default_sales;
        $goal->oct = $default_sales;
        $goal->nov = $default_sales;
        $goal->dec = $default_sales;
        $goal->annual = ( $default_sales * 12 );
        return $goal;
    }

    public function getMonth($month) {
        switch ($month) {
            case '01':
                return 'jan';
            case '02':
                return 'feb';
            case '03':
                return 'mar';
            case '04':
                return 'apr';
            case '05':
                return 'may';
            case '06':
                return 'jun';
            case '07':
                return 'jul';
            case '08':
                return 'aug';
            case '09':
                return 'sep';
            case '10':
                return 'oct';
            case '11':
                return 'nov';
            case '12':
                return 'dec';
        }
    }

    public function getMonthQuery() {
        $month = date('m');
        switch ($month) {
            case '01':
                return 'jan';
            case '02':
                return 'feb';
            case '03':
                return 'mar';
            case '04':
                return 'apr';
            case '05':
                return 'may';
            case '06':
                return 'jun';
            case '07':
                return 'jul';
            case '08':
                return 'aug';
            case '09':
                return 'sep';
            case '10':
                return 'oct';
            case '11':
                return 'nov';
            case '12':
                return 'dec';
        }
    }
    
    public function getPointMonthly($user_id,$type) {
        //SELECT month, sum(sale) FROM salesper_metrics.sales where user_id = 3 AND year = 2015 group by month
        $user_id = $user_id == null ? Auth::user()->id : $user_id;
        if($type==0){
            $data = DB::table('points')
                ->select(DB::raw('sum(points.points) as monthlyTotal, points.month'))
                ->where('points.user_id', '=', $user_id)
                ->where('points.year', '=', date("Y"))
                ->groupBy('points.month')
                ->orderBy('points.month')
                ->get();
        }else{
            if(Auth::user()->role_id==3){
                $data = DB::table('points')
                ->join('users', 'points.user_id', '=', 'users.id')
                ->select(DB::raw('sum(points.points) as monthlyTotal, points.month'))
                ->where('points.year', '=', date("Y"))
                ->where('users.manager_id', '=',Auth::user()->id )
                ->groupBy('points.month')
                ->orderBy('points.month')
                ->get();
            }else{
                $data = DB::table('points')
                ->join('users', 'points.user_id', '=', 'users.id')
                ->select(DB::raw('sum(points.points) as monthlyTotal, points.month'))
                ->where('points.year', '=', date("Y"))
                ->where('users.company_id', '=',Auth::user()->company_id )
                ->groupBy('points.month')
                ->orderBy('points.month')
                ->get();
            }
        }
        

        $array = array();
        $annualTotal = 0;
        foreach ($data as $datum) {
            $array[$this->getMonth($datum->month)] = $datum->monthlyTotal;
            $annualTotal += $datum->monthlyTotal;
        }
        $array['annual'] = $annualTotal;
        return $array;
    }
    
    public function getPointDaily($user_id,$type) {
        //SELECT month, sum(sale) FROM salesper_metrics.sales where user_id = 3 AND year = 2015 group by month
        $user_id = $user_id == null ? Auth::user()->id : $user_id;
        if($type==0){
            $data = DB::table('point_audits')
                ->join('tasks', 'point_audits.task_id', '=', 'tasks.id')
                ->select(DB::raw('case when SUM(point*value)<1 then 0 else SUM(point*value) end as total, Date_format(date,"%W") as day'))
                ->where(DB::raw( 'WEEKOFYEAR(date)' ), '=', DB::raw( 'WEEKOFYEAR(NOW())' ))
                ->where(DB::raw( 'Date_format(date,"%W")' ), '!=', 'Saturday')
                ->where(DB::raw( 'Date_format(date,"%W")' ), '!=', 'Sunday')
                ->where('point_audits.user_id', '=', $user_id)
                ->orderBy('point_audits.date')
                ->get();
        }else{
            if(Auth::user()->role_id==3){
                $data = DB::table('point_audits')
                ->join('tasks', 'point_audits.task_id', '=', 'tasks.id')
                ->join('users', 'point_audits.user_id', '=', 'users.id')
                ->select(DB::raw('case when SUM(point*value)<1 then 0 else SUM(point*value) end as total, Date_format(date,"%W") as day'))
                ->where(DB::raw( 'WEEKOFYEAR(date)' ), '=', DB::raw( 'WEEKOFYEAR(NOW())' ))
                ->where(DB::raw( 'Date_format(date,"%W")' ), '!=', 'Saturday')
                ->where(DB::raw( 'Date_format(date,"%W")' ), '!=', 'Sunday')
                ->where('users.manager_id', '=',Auth::user()->id )
                ->orderBy('point_audits.date')
                ->get();
            }else{
                $data = DB::table('point_audits')
                ->join('tasks', 'point_audits.task_id', '=', 'tasks.id')
                ->join('users', 'point_audits.user_id', '=', 'users.id')
                ->select(DB::raw('case when SUM(point*value)<1 then 0 else SUM(point*value) end as total, Date_format(date,"%W") as day'))
                ->where(DB::raw( 'WEEKOFYEAR(date)' ), '=', DB::raw( 'WEEKOFYEAR(NOW())' ))
                ->where(DB::raw( 'Date_format(date,"%W")' ), '!=', 'Saturday')
                ->where(DB::raw( 'Date_format(date,"%W")' ), '!=', 'Sunday')
                ->where('users.company_id', '=',Auth::user()->company_id )
                ->orderBy('point_audits.date')
                ->get();
            }
            
        }
        
        
        $array = array();
        $weekly= 0;
        $day='';
        $day=$data[0]->day;
        $array[$data[0]->day]=0;
        foreach ($data as $datum) {
            if($day==$datum->day){
                $array[$datum->day] += $datum->total;
            }else{
                $day=$datum->day;
                $array[$datum->day]=0;
                $array[$datum->day] += $datum->total;
            }
            $weekly += $datum->total;
        }
        $array['weekly'] = $weekly;
        /*echo '<pre>';
        print_r($array);
        echo '</pre>';
        exit();*/
        return $array;
    }

    public function getDirectHire($user_id,$type) {
        //SELECT month, sum(sale) FROM salesper_metrics.sales where user_id = 3 AND year = 2015 group by month
        $user_id = $user_id == null ? Auth::user()->id : $user_id;
        if($type==0){
            $data = DB::table('sales')
                ->select(DB::raw('sum(sales.sale) as monthlyTotal, sales.month'))
                ->where('sales.user_id', '=', $user_id)
                ->where('sales.saleType_id', '=', 1)
                ->where('sales.year', '=', date("Y"))
                ->groupBy('sales.month')
                ->get();
        }else{
            if(Auth::user()->role_id==3){
                $data = DB::table('sales')
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->select(DB::raw('sum(sales.sale) as monthlyTotal, sales.month'))
                ->where('sales.saleType_id', '=', 1)
                ->where('sales.year', '=', date("Y"))
                ->where('users.manager_id', '=',Auth::user()->id )
                ->groupBy('sales.month')
                ->get();
            }else{
                $data = DB::table('sales')
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->select(DB::raw('sum(sales.sale) as monthlyTotal, sales.month'))
                ->where('sales.saleType_id', '=', 1)
                ->where('sales.year', '=', date("Y"))
                ->where('users.company_id', '=',Auth::user()->company_id )
                ->groupBy('sales.month')
                ->get();
            }
            
        }
        

        $array = array();
        $annualTotal = 0;
        foreach ($data as $datum) {
            $array[$this->getMonth($datum->month)] = $datum->monthlyTotal;
            $annualTotal += $datum->monthlyTotal;
        }
        $array['annual'] = $annualTotal;
        return $array;
    }

    public function getDirectHireAnnual($user_id,$type) {
        $user_id = $user_id == null ? Auth::user()->id : $user_id;
        if($type==0){
        $data = DB::table('sales')
                ->select(DB::raw('sum(sales.sale) as yearlyTotal, sales.year'))
                ->where('sales.user_id', '=', $user_id)
                ->where('sales.saleType_id', '=', 1)
                ->groupBy('sales.year')
                ->get();
        
        }else{
            if(Auth::user()->role_id==3){
                $data = DB::table('sales')
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->select(DB::raw('sum(sales.sale) as yearlyTotal, sales.year'))
                ->where('sales.saleType_id', '=', 1)
                ->where('users.manager_id', '=',Auth::user()->id )
                ->groupBy('sales.year')
                ->get();
            }else{
                $data = DB::table('sales')
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->select(DB::raw('sum(sales.sale) as yearlyTotal, sales.year'))
                ->where('sales.saleType_id', '=', 1)
                ->where('users.company_id', '=',Auth::user()->company_id )
                ->groupBy('sales.year')
                ->get();
            }
        }
        $array = array();
        $grandTotal = 0;
        foreach ($data as $datum) {
            $array[$datum->year] = $datum->yearlyTotal;
            $grandTotal += $datum->yearlyTotal;
        }
        $array['grandTotal'] = $grandTotal;
        return $array;
    }

    public function getGMP($user_id,$type) {
        $user_id = $user_id == null ? Auth::user()->id : $user_id;
        if($type==0){
            $data = DB::table('sales')
                ->select(DB::raw('sum(sales.sale) as monthlyTotal, sales.month'))
                ->where('sales.user_id', '=', $user_id)
                ->where('sales.saleType_id', '=', 2)
                ->where('sales.year', '=', date("Y"))
                ->groupBy('sales.month')
                ->get();
        }else{
            if(Auth::user()->role_id==3){
                $data = DB::table('sales')
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->select(DB::raw('sum(sales.sale) as monthlyTotal, sales.month'))
                ->where('sales.saleType_id', '=', 2)
                ->where('sales.year', '=', date("Y"))
                ->where('users.manager_id', '=',Auth::user()->id )
                ->groupBy('sales.month')
                ->get();
            }else{
                $data = DB::table('sales')
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->select(DB::raw('sum(sales.sale) as monthlyTotal, sales.month'))
                ->where('sales.saleType_id', '=', 2)
                ->where('sales.year', '=', date("Y"))
                ->where('users.company_id', '=',Auth::user()->company_id )
                ->groupBy('sales.month')
                ->get();
            }
            
        }
        

        $array = array();
        $annualTotal = 0;
        foreach ($data as $datum) {
            $array[$this->getMonth($datum->month)] = $datum->monthlyTotal;
            $annualTotal += $datum->monthlyTotal;
        }
        $array['annual'] = $annualTotal;
        return $array;
    }

    public function getGMPAnnual($user_id,$type) {
        $user_id = $user_id == null ? Auth::user()->id : $user_id;
        if($type==0){
            $data = DB::table('sales')
                ->select(DB::raw('sum(sales.sale) as yearlyTotal, sales.year'))
                ->where('sales.user_id', '=', $user_id)
                ->where('sales.saleType_id', '=', 2)
                ->groupBy('sales.year')
                ->get();
        }else{
            if(Auth::user()->role_id==3){
                $data = DB::table('sales')
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->select(DB::raw('sum(sales.sale) as yearlyTotal, sales.year'))
                ->where('sales.saleType_id', '=', 2)
                ->where('users.manager_id', '=',Auth::user()->id )
                ->groupBy('sales.year')
                ->get();
            }else{
                $data = DB::table('sales')
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->select(DB::raw('sum(sales.sale) as yearlyTotal, sales.year'))
                ->where('sales.saleType_id', '=', 2)
                ->where('users.company_id', '=',Auth::user()->company_id )
                ->groupBy('sales.year')
                ->get();
            }
            
        }

        $array = array();
        $grandTotal = 0;
        foreach ($data as $datum) {
            $array[$datum->year] = $datum->yearlyTotal;
            $grandTotal += $datum->yearlyTotal;
        }
        $array['grandTotal'] = $grandTotal;
        return $array;
    }

    public function getRecruitingPoints($user_id) {
        $user_id = $user_id == null ? Auth::user()->id : $user_id;
        $data = DB::table('my_stats')
                ->select(DB::raw('DATE_FORMAT(my_stats.date, \'%d\') as day, sum(my_stats.point) as dailyTotal'))
                //->join('goal_managements', 'my_stats.user_id', '=', 'goal_managements.user_id')
                ->where(DB::raw('concat(DATE_FORMAT(my_stats.date, \'%m\'), DATE_FORMAT(date, \'%Y\'))'), '=', DB::raw('concat(DATE_FORMAT(curdate(), \'%m\'), DATE_FORMAT(curdate(), \'%Y\'))'))
                ->where('my_stats.user_id', '=', $user_id)
                ->groupBy('my_stats.date')
                ->orderBy('day')
                ->get();
        return $data;
    }

    public function getRecruitingGoal($user_id) {

        $user_id = $user_id == null ? Auth::user()->id : $user_id;
        $data = DB::table('goal_managements')
                ->select(DB::raw($this->getMonthQuery() . ' as target'))
                ->where('user_id', '=', $user_id)
                ->first();
        return $data;
    }

    public function getRecruitingTarget($user_id) {
        $user_id = $user_id == null ? Auth::user()->id : $user_id;
        $data = DB::table('goal_managements')
                ->select(DB::raw($this->getMonthQuery() . ' as target'))
                ->where('user_id', '=', $user_id)
                ->first();
        return $data;
    }

    public function getGMPTarget($user_id) {
        $user_id = $user_id == null ? Auth::user()->id : $user_id;
        $data = DB::table('goal_managements')
                ->select('gmp as target')
                ->where('user_id', '=', $user_id)
                ->first();
        return $data;
    }

    public function getDirectHireTarget($user_id) {
        $user_id = $user_id == null ? Auth::user()->id : $user_id;
        $data = GoalManagement::where('user_id', '=', $user_id)->first();
        return $data;
    }

    public function randStrGen($len) {
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }

    public function getRecruiting($id,$type) {
        if($type==0){
            $recruiting = DB::table('point_audits')
                ->select(DB::raw(
                                ' IfNULL(sum(point), 0 ) as recruitingPresentationToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 1 and user_id = ' . $id . ' ) as recruitingPresentationOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 2 and user_id = ' . $id . ' ) as recruitingHitToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 2 and user_id = ' . $id . ' ) as recruitingHitOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 4 and user_id = ' . $id . ' ) as candidateInterviewToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 4 and user_id = ' . $id . ' ) as candidateInterviewOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where date = current_date() and task_id = 5 and user_id = ' . $id . ' ) as interviewReactivatedCandidateToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 5 and user_id = ' . $id . ' ) as interviewReactivatedCandidateOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 5 and user_id = ' . $id . ' ) as interviewReactivatedCandidateToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 5 and user_id = ' . $id . ' ) as interviewReactivatedCandidateOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 9 and user_id = ' . $id . ' ) as fillOrPlacementToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 9 and user_id = ' . $id . ' ) as fillOrPlacementOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 7 and user_id = ' . $id . ' ) as sendOutRToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 7 and user_id = ' . $id . ' ) as sendOutROngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 6 and user_id = ' . $id . ' ) as sendOutInterviewToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 6 and user_id = ' . $id . ' ) as sendOutInterviewOngoing '
                        ))
                ->where('date', '=', DB::raw('current_date()'))
                ->where('task_id', '=', 1)
                ->where('user_id', '=', $id)
                ->first();
        }else{
            
            if(Auth::user()->role_id==3){
                $recruiting = DB::table('point_audits')
                ->join('users', 'point_audits.user_id', '=', 'users.id')
                ->select(DB::raw(
                                ' IfNULL(sum(point), 0 ) as recruitingPresentationToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 1 ) as recruitingPresentationOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 2 ) as recruitingHitToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 2 ) as recruitingHitOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 4 ) as candidateInterviewToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 4 ) as candidateInterviewOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where date = current_date() and task_id = 5 ) as interviewReactivatedCandidateToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 5 ) as interviewReactivatedCandidateOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 5 ) as interviewReactivatedCandidateToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 5 ) as interviewReactivatedCandidateOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 9 ) as fillOrPlacementToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 9 ) as fillOrPlacementOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 7 ) as sendOutRToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 7 ) as sendOutROngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 6 ) as sendOutInterviewToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 6 ) as sendOutInterviewOngoing '
                        ))
                ->where('date', '=', DB::raw('current_date()'))
                ->where('task_id', '=', 1)
                ->where('users.manager_id', '=',Auth::user()->id )
                ->first();
            }else{
                $recruiting = DB::table('point_audits')
                ->join('users', 'point_audits.user_id', '=', 'users.id')
                ->select(DB::raw(
                                ' IfNULL(sum(point), 0 ) as recruitingPresentationToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 1 ) as recruitingPresentationOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 2 ) as recruitingHitToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 2 ) as recruitingHitOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 4 ) as candidateInterviewToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 4 ) as candidateInterviewOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where date = current_date() and task_id = 5 ) as interviewReactivatedCandidateToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 5 ) as interviewReactivatedCandidateOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 5 ) as interviewReactivatedCandidateToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 5 ) as interviewReactivatedCandidateOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 9 ) as fillOrPlacementToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 9 ) as fillOrPlacementOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 7 ) as sendOutRToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 7 ) as sendOutROngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 6 ) as sendOutInterviewToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 6 ) as sendOutInterviewOngoing '
                        ))
                ->where('date', '=', DB::raw('current_date()'))
                ->where('task_id', '=', 1)
                ->where('users.company_id', '=',Auth::user()->company_id )
                ->first();
            }
            
        }
        

        //ajustando datos a la vista
        $recruiting->recruit_1 = $recruiting->recruitingPresentationToday;
        $recruiting->recruit_2 = $recruiting->recruitingHitToday;
        $recruiting->recruit_3 = $recruiting->recruitingPresentationOngoing;
        $recruiting->recruit_4 = $recruiting->recruitingHitOngoing;
        $recruiting->recruit_5 = $recruiting->recruitingHitToday;
        $recruiting->recruit_6 = $recruiting->candidateInterviewToday;
        $recruiting->recruit_7 = $recruiting->recruitingHitOngoing;
        $recruiting->recruit_8 = $recruiting->candidateInterviewOngoing;
        $recruiting->recruit_9 = $recruiting->recruitingHitToday;
        $recruiting->recruit_10 = $recruiting->interviewReactivatedCandidateToday;
        $recruiting->recruit_11 = $recruiting->recruitingHitOngoing;
        $recruiting->recruit_12 = $recruiting->interviewReactivatedCandidateOngoing;
        $recruiting->recruit_13 = $recruiting->candidateInterviewToday;
        $recruiting->recruit_14 = $recruiting->sendOutInterviewToday;
        $recruiting->recruit_15 = $recruiting->candidateInterviewOngoing;
        $recruiting->recruit_16 = $recruiting->sendOutInterviewToday;
        $recruiting->recruit_17 = $recruiting->interviewReactivatedCandidateToday;
        $recruiting->recruit_18 = $recruiting->sendOutRToday;
        $recruiting->recruit_19 = $recruiting->interviewReactivatedCandidateOngoing;
        $recruiting->recruit_20 = $recruiting->sendOutROngoing;
        $recruiting->recruit_21 = $recruiting->sendOutInterviewToday;
        $recruiting->recruit_22 = $recruiting->fillOrPlacementToday;
        $recruiting->recruit_23 = $recruiting->sendOutInterviewOngoing;
        $recruiting->recruit_24 = $recruiting->fillOrPlacementOngoing;



        if ($recruiting->recruitingPresentationToday != 0 && $recruiting->recruitingHitToday != 0) {
            $b = $this->mcd($recruiting->recruitingPresentationToday, $recruiting->recruitingHitToday);
            if ($b != 0) {
                if(($recruiting->recruitingHitToday / $b)>1){
                    $recruiting->recruit_1 =round(($recruiting->recruitingPresentationToday / $b)/($recruiting->recruitingHitToday / $b));
                    $recruiting->recruit_2=1;
                }else{
                    $recruiting->recruit_1 = $recruiting->recruitingPresentationToday / $b;
                    $recruiting->recruit_2 = $recruiting->recruitingHitToday / $b;
                }
                
            }
        }
        if ($recruiting->recruitingPresentationOngoing != 0 && $recruiting->recruitingHitOngoing != 0) {
            $b = $this->mcd($recruiting->recruitingPresentationOngoing, $recruiting->recruitingHitOngoing);
            if ($b != 0) {
                if(($recruiting->recruitingHitOngoing / $b)>1){
                    $recruiting->recruit_3 =round(($recruiting->recruitingPresentationOngoing / $b)/($recruiting->recruitingHitOngoing / $b));
                    $recruiting->recruit_4=1;
                }else{
                    $recruiting->recruit_3 = $recruiting->recruitingPresentationOngoing / $b;
                    $recruiting->recruit_4 = $recruiting->recruitingHitOngoing / $b;
                }
            }
        }
        if ($recruiting->recruitingHitToday != 0 && $recruiting->candidateInterviewToday != 0) {
            $b = $this->mcd($recruiting->recruitingHitToday, $recruiting->candidateInterviewToday);
            if ($b != 0) {
                if(($recruiting->candidateInterviewToday / $b)>1){
                    $recruiting->recruit_5 =round(($recruiting->recruitingHitToday / $b)/($recruiting->candidateInterviewToday / $b));
                    $recruiting->recruit_6=1;
                }else{
                    $recruiting->recruit_5 = $recruiting->recruitingHitToday / $b;
                    $recruiting->recruit_6 = $recruiting->candidateInterviewToday / $b;
                }
            }
        }
        if ($recruiting->recruitingHitOngoing != 0 && $recruiting->candidateInterviewOngoing != 0) {
            $b = $this->mcd($recruiting->recruitingHitOngoing, $recruiting->candidateInterviewOngoing);
            if ($b != 0) {
                if(($recruiting->candidateInterviewOngoing / $b)>1){
                    $recruiting->recruit_7 =round(($recruiting->recruitingHitOngoing / $b)/($recruiting->candidateInterviewOngoing / $b));
                    $recruiting->recruit_8=1;
                }else{
                    $recruiting->recruit_7 = $recruiting->recruitingHitOngoing / $b;
                    $recruiting->recruit_8 = $recruiting->candidateInterviewOngoing / $b;
                }
                
            }
        }
        if ($recruiting->recruitingHitToday != 0 && $recruiting->interviewReactivatedCandidateToday != 0) {
            $b = $this->mcd($recruiting->recruitingHitToday, $recruiting->interviewReactivatedCandidateToday);
            if ($b != 0) {
                if(($recruiting->interviewReactivatedCandidateToday / $b)>1){
                    $recruiting->recruit_9 =round(($recruiting->recruitingHitToday / $b)/($recruiting->interviewReactivatedCandidateToday / $b));
                    $recruiting->recruit_10=1;
                }else{
                    $recruiting->recruit_9 = $recruiting->recruitingHitToday / $b;
                    $recruiting->recruit_10 = $recruiting->interviewReactivatedCandidateToday / $b;
                } 
            }
        }
        if ($recruiting->recruitingHitOngoing != 0 && $recruiting->interviewReactivatedCandidateOngoing != 0) {
            $b = $this->mcd($recruiting->recruitingHitOngoing, $recruiting->interviewReactivatedCandidateOngoing);
            if ($b != 0) {
                if(($recruiting->interviewReactivatedCandidateOngoing / $b)>1){
                    $recruiting->recruit_11 =round(($recruiting->recruitingHitOngoing / $b)/($recruiting->interviewReactivatedCandidateOngoing / $b));
                    $recruiting->recruit_12=1;
                }else{
                    $recruiting->recruit_11 = $recruiting->recruitingHitOngoing / $b;
                    $recruiting->recruit_12 = $recruiting->interviewReactivatedCandidateOngoing / $b;
                } 
            }
        }
        if ($recruiting->candidateInterviewToday != 0 && $recruiting->sendOutInterviewToday != 0) {
            $b = $this->mcd($recruiting->candidateInterviewToday, $recruiting->sendOutInterviewToday);
            if ($b != 0) {
                if(($recruiting->sendOutInterviewToday / $b)>1){
                    $recruiting->recruit_13 =round(($recruiting->candidateInterviewToday / $b)/($recruiting->sendOutInterviewToday / $b));
                    $recruiting->recruit_14=1;
                }else{
                    $recruiting->recruit_13 = $recruiting->candidateInterviewToday / $b;
                    $recruiting->recruit_14 = $recruiting->sendOutInterviewToday / $b;
                } 
            }
        }
        if ($recruiting->candidateInterviewOngoing != 0 && $recruiting->sendOutInterviewOngoing != 0) {
            $b = $this->mcd($recruiting->candidateInterviewOngoing, $recruiting->sendOutInterviewToday);
            if ($b != 0) {
                if(($recruiting->sendOutInterviewToday / $b)>1){
                    $recruiting->recruit_15 =round(($recruiting->candidateInterviewOngoing / $b)/($recruiting->sendOutInterviewToday / $b));
                    $recruiting->recruit_16=1;
                }else{
                    $recruiting->recruit_15 = $recruiting->candidateInterviewOngoing / $b;
                    $recruiting->recruit_16 = $recruiting->sendOutInterviewToday / $b;
                }
            }
        }
        if ($recruiting->interviewReactivatedCandidateToday != 0 && $recruiting->sendOutRToday != 0) {
            $b = $this->mcd($recruiting->interviewReactivatedCandidateToday, $recruiting->sendOutRToday);
            if ($b != 0) {
                if(($recruiting->sendOutRToday / $b)>1){
                    $recruiting->recruit_17 =round(($recruiting->interviewReactivatedCandidateToday / $b)/($recruiting->sendOutRToday / $b));
                    $recruiting->recruit_18=1;
                }else{
                    $recruiting->recruit_17 = $recruiting->interviewReactivatedCandidateToday / $b;
                    $recruiting->recruit_18 = $recruiting->sendOutRToday / $b;
                }
            }
        }
        if ($recruiting->interviewReactivatedCandidateOngoing != 0 && $recruiting->sendOutROngoing != 0) {
            $b = $this->mcd($recruiting->interviewReactivatedCandidateOngoing, $recruiting->sendOutROngoing);
            if ($b != 0) {
                if(($recruiting->sendOutROngoing / $b)>1){
                    $recruiting->recruit_19 =round(($recruiting->interviewReactivatedCandidateOngoing / $b)/($recruiting->sendOutROngoing / $b));
                    $recruiting->recruit_20=1;
                }else{
                    $recruiting->recruit_19 = $recruiting->interviewReactivatedCandidateOngoing / $b;
                    $recruiting->recruit_20 = $recruiting->sendOutROngoing / $b;
                }
            }
        }
        if ($recruiting->sendOutInterviewToday != 0 && $recruiting->fillOrPlacementToday != 0) {
            $b = $this->mcd($recruiting->sendOutInterviewToday, $recruiting->fillOrPlacementToday);
            if ($b != 0) {
                if(($recruiting->fillOrPlacementToday / $b)>1){
                    $recruiting->recruit_21 =round(($recruiting->sendOutInterviewToday / $b)/($recruiting->fillOrPlacementToday / $b));
                    $recruiting->recruit_22=1;
                }else{
                    $recruiting->recruit_21 = $recruiting->sendOutInterviewToday / $b;
                    $recruiting->recruit_22 = $recruiting->fillOrPlacementToday / $b;
                }
            }
        }
        if ($recruiting->sendOutInterviewOngoing != 0 && $recruiting->fillOrPlacementOngoing != 0) {
            $b = $this->mcd($recruiting->sendOutInterviewOngoing, $recruiting->fillOrPlacementOngoing);
            if ($b != 0) {
                if(($recruiting->fillOrPlacementOngoing / $b)>1){
                    $recruiting->recruit_23 =round(($recruiting->sendOutInterviewOngoing / $b)/($recruiting->fillOrPlacementOngoing / $b));
                    $recruiting->recruit_24=1;
                }else{
                    $recruiting->recruit_23 = $recruiting->sendOutInterviewOngoing / $b;
                    $recruiting->recruit_24 = $recruiting->fillOrPlacementOngoing / $b;
                }
            }
        }

        return $recruiting;
    }

    public function getClientDev($id,$type) {
        if($type==0){
            $clientDev = DB::table('point_audits')
                ->select(DB::raw(
                                ' IfNULL( sum(point), 0) as marketingCallToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 10 and user_id = ' . $id . ' ) as marketingCallOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 11 and user_id = ' . $id . ' ) as mPCPresentationToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 11 and user_id = ' . $id . ' ) as mPCPresentationOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 12 and user_id = ' . $id . ' ) as jobOrderContractTempAssignmentMpcToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 12 and user_id = ' . $id . ' ) as jobOrderContractTempAssignmentMpcOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 16 and user_id = ' . $id . ' ) as fillBySelfToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 16 and user_id = ' . $id . ' ) as fillBySelfOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 17 and user_id = ' . $id . ' ) as fillByOtherToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 17 and user_id = ' . $id . ' ) as fillByOtherOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 14 and user_id = ' . $id . ' ) as submittalToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 14 and user_id = ' . $id . ' ) as submittalOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 15 and user_id = ' . $id . ' ) as sendOutToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 15 and user_id = ' . $id . ' ) as sendOutOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 13 and user_id = ' . $id . ' ) as jobOrderContractTempAssignmentMarketingToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 13 and user_id = ' . $id . ' ) as jobOrderContractTempAssignmentMarketingOngoing '
                        ))
                ->where('date', '=', DB::raw('current_date()'))
                ->where('task_id', '=', 10)
                ->where('user_id', '=', $id)
                ->first();
        }else{
            if(Auth::user()->role_id==3){
                $clientDev = DB::table('point_audits')
                ->join('users', 'point_audits.user_id', '=', 'users.id')
                ->select(DB::raw(
                                ' IfNULL( sum(point), 0) as marketingCallToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 10 ) as marketingCallOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 11 ) as mPCPresentationToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 11 ) as mPCPresentationOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 12 ) as jobOrderContractTempAssignmentMpcToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 12 ) as jobOrderContractTempAssignmentMpcOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 16 ) as fillBySelfToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 16 ) as fillBySelfOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 17 ) as fillByOtherToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 17 ) as fillByOtherOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 14 ) as submittalToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 14 ) as submittalOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 15 ) as sendOutToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 15 ) as sendOutOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 13 ) as jobOrderContractTempAssignmentMarketingToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 13 ) as jobOrderContractTempAssignmentMarketingOngoing '
                        ))
                ->where('date', '=', DB::raw('current_date()'))
                ->where('task_id', '=', 10)
                ->where('users.manager_id', '=',Auth::user()->id )
                ->first();
            }else{
                $clientDev = DB::table('point_audits')
                ->join('users', 'point_audits.user_id', '=', 'users.id')
                ->select(DB::raw(
                                ' IfNULL( sum(point), 0) as marketingCallToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 10 ) as marketingCallOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 11 ) as mPCPresentationToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 11 ) as mPCPresentationOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 12 ) as jobOrderContractTempAssignmentMpcToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 12 ) as jobOrderContractTempAssignmentMpcOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 16 ) as fillBySelfToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 16 ) as fillBySelfOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 17 ) as fillByOtherToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 17 ) as fillByOtherOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 14 ) as submittalToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 14 ) as submittalOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 15 ) as sendOutToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 15 ) as sendOutOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 13 ) as jobOrderContractTempAssignmentMarketingToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 13 ) as jobOrderContractTempAssignmentMarketingOngoing '
                        ))
                ->where('date', '=', DB::raw('current_date()'))
                ->where('task_id', '=', 10)
                ->where('users.company_id', '=',Auth::user()->company_id )
                ->first();
            }
            
        }
        

        $clientDev->clientDev_1 = $clientDev->marketingCallToday;
        $clientDev->clientDev_2 = $clientDev->jobOrderContractTempAssignmentMarketingToday;
        $clientDev->clientDev_3 = $clientDev->marketingCallOngoing;
        $clientDev->clientDev_4 = $clientDev->jobOrderContractTempAssignmentMarketingOngoing;
        $clientDev->clientDev_5 = $clientDev->mPCPresentationToday;
        $clientDev->clientDev_6 = $clientDev->jobOrderContractTempAssignmentMpcToday;
        $clientDev->clientDev_7 = $clientDev->mPCPresentationOngoing;
        $clientDev->clientDev_8 = $clientDev->jobOrderContractTempAssignmentMpcOngoing;
        $clientDev->clientDev_9 = $clientDev->jobOrderContractTempAssignmentMarketingToday;
        $clientDev->clientDev_10 = $clientDev->fillBySelfToday;
        $clientDev->clientDev_11 = $clientDev->jobOrderContractTempAssignmentMarketingOngoing;
        $clientDev->clientDev_12 = $clientDev->fillBySelfOngoing;
        $clientDev->clientDev_13 = $clientDev->jobOrderContractTempAssignmentMarketingToday;
        $clientDev->clientDev_14 = $clientDev->fillByOtherToday;
        $clientDev->clientDev_15 = $clientDev->jobOrderContractTempAssignmentMarketingOngoing;
        $clientDev->clientDev_16 = $clientDev->fillByOtherOngoing;
        $clientDev->clientDev_17 = $clientDev->submittalToday;
        $clientDev->clientDev_18 = $clientDev->sendOutToday;
        $clientDev->clientDev_19 = $clientDev->submittalOngoing;
        $clientDev->clientDev_20 = $clientDev->sendOutOngoing;
        $clientDev->clientDev_21 = $clientDev->sendOutToday;
        $clientDev->clientDev_22 = $clientDev->fillBySelfToday;
        $clientDev->clientDev_23 = $clientDev->sendOutOngoing;
        $clientDev->clientDev_24 = $clientDev->fillBySelfOngoing;
        $clientDev->clientDev_25 = $clientDev->sendOutToday;
        $clientDev->clientDev_26 = $clientDev->fillByOtherToday;
        $clientDev->clientDev_27 = $clientDev->sendOutOngoing;
        $clientDev->clientDev_28 = $clientDev->fillByOtherOngoing;


        if ($clientDev->marketingCallToday != 0 && $clientDev->jobOrderContractTempAssignmentMarketingToday != 0) {
            $b = $this->mcd($clientDev->marketingCallToday, $clientDev->jobOrderContractTempAssignmentMarketingToday);
            if ($b != 0) {
                if(($clientDev->jobOrderContractTempAssignmentMarketingToday / $b)>1){
                    $clientDev->clientDev_1 =round(($clientDev->marketingCallToday / $b)/($clientDev->jobOrderContractTempAssignmentMarketingToday / $b));
                    $clientDev->clientDev_2=1;
                }else{
                    $clientDev->clientDev_1 = $clientDev->marketingCallToday / $b;
                    $clientDev->clientDev_2 = $clientDev->jobOrderContractTempAssignmentMarketingToday / $b;
                }
            }
        }
        if ($clientDev->marketingCallOngoing != 0 && $clientDev->jobOrderContractTempAssignmentMarketingOngoing != 0) {
            $b = $this->mcd($clientDev->marketingCallOngoing, $clientDev->jobOrderContractTempAssignmentMarketingOngoing);
            if ($b != 0) {
                if(($clientDev->jobOrderContractTempAssignmentMarketingOngoing / $b)>1){
                    $clientDev->clientDev_3 =round(($clientDev->marketingCallOngoing / $b)/($clientDev->jobOrderContractTempAssignmentMarketingOngoing / $b));
                    $clientDev->clientDev_4=1;
                }else{
                    $clientDev->clientDev_3 = $clientDev->marketingCallOngoing / $b;
                    $clientDev->clientDev_4 = $clientDev->jobOrderContractTempAssignmentMarketingOngoing / $b;
                }
                
            }
        }
        if ($clientDev->mPCPresentationToday != 0 && $clientDev->jobOrderContractTempAssignmentMpcToday != 0) {
            $b = $this->mcd($clientDev->mPCPresentationToday, $clientDev->jobOrderContractTempAssignmentMpcToday);
            if ($b != 0) {
                if(($clientDev->jobOrderContractTempAssignmentMpcToday / $b)>1){
                    $clientDev->clientDev_5 =round(($clientDev->mPCPresentationToday / $b)/($clientDev->jobOrderContractTempAssignmentMpcToday / $b));
                    $clientDev->clientDev_6=1;
                }else{
                    $clientDev->clientDev_5 = $clientDev->mPCPresentationToday / $b;
                    $clientDev->clientDev_6 = $clientDev->jobOrderContractTempAssignmentMpcToday / $b;
                }
            }
        }
        if ($clientDev->mPCPresentationOngoing != 0 && $clientDev->jobOrderContractTempAssignmentMpcOngoing != 0) {
            $b = $this->mcd($clientDev->mPCPresentationOngoing, $clientDev->jobOrderContractTempAssignmentMpcOngoing);
            if ($b != 0) {
                if(($clientDev->jobOrderContractTempAssignmentMpcOngoing / $b)>1){
                    $clientDev->clientDev_7 =round(($clientDev->mPCPresentationOngoing / $b)/($clientDev->jobOrderContractTempAssignmentMpcOngoing / $b));
                    $clientDev->clientDev_8=1;
                }else{
                    $clientDev->clientDev_7 = $clientDev->mPCPresentationOngoing / $b;
                    $clientDev->clientDev_8 = $clientDev->jobOrderContractTempAssignmentMpcOngoing / $b;
                }
            }
        }
        if ($clientDev->jobOrderContractTempAssignmentMarketingToday != 0 && $clientDev->fillBySelfToday != 0) {
            $b = $this->mcd($clientDev->jobOrderContractTempAssignmentMarketingToday, $clientDev->fillBySelfToday);
            if ($b != 0) {
                if(($clientDev->fillBySelfToday / $b)>1){
                    $clientDev->clientDev_9 =round(($clientDev->jobOrderContractTempAssignmentMarketingToday / $b)/($clientDev->fillBySelfToday / $b));
                    $clientDev->clientDev_10=1;
                }else{
                    $clientDev->clientDev_9 = $clientDev->jobOrderContractTempAssignmentMarketingToday / $b;
                    $clientDev->clientDev_10 = $clientDev->fillBySelfToday / $b;
                }
            }
        }
        if ($clientDev->jobOrderContractTempAssignmentMarketingOngoing != 0 && $clientDev->fillBySelfOngoing != 0) {
            $b = $this->mcd($clientDev->jobOrderContractTempAssignmentMarketingOngoing, $clientDev->fillBySelfOngoing);
            if ($b != 0) {
                if(($clientDev->fillBySelfOngoing / $b)>1){
                    $clientDev->clientDev_11 =round(($clientDev->jobOrderContractTempAssignmentMarketingOngoing / $b)/($clientDev->fillBySelfOngoing / $b));
                    $clientDev->clientDev_12=1;
                }else{
                    $clientDev->clientDev_11 = $clientDev->jobOrderContractTempAssignmentMarketingOngoing / $b;
                    $clientDev->clientDev_12 = $clientDev->fillBySelfOngoing / $b;
                }
            }
        }
        if ($clientDev->jobOrderContractTempAssignmentMarketingToday != 0 && $clientDev->fillByOtherToday != 0) {
            $b = $this->mcd($clientDev->jobOrderContractTempAssignmentMarketingToday, $clientDev->fillByOtherToday);
            if ($b != 0) {
                if(($clientDev->fillByOtherToday / $b)>1){
                    $clientDev->clientDev_13 =round(($clientDev->jobOrderContractTempAssignmentMarketingToday / $b)/($clientDev->fillByOtherToday / $b));
                    $clientDev->clientDev_14=1;
                }else{
                    $clientDev->clientDev_13 = $clientDev->jobOrderContractTempAssignmentMarketingToday / $b;
                    $clientDev->clientDev_14 = $clientDev->fillByOtherToday / $b;
                }
                
            }
        }
        if ($clientDev->jobOrderContractTempAssignmentMarketingOngoing != 0 && $clientDev->fillByOtherOngoing != 0) {
            $b = $this->mcd($clientDev->jobOrderContractTempAssignmentMarketingOngoing, $clientDev->fillByOtherOngoing);
            if ($b != 0) {
                if(($clientDev->fillByOtherOngoing / $b)>1){
                    $clientDev->clientDev_15 =round(($clientDev->jobOrderContractTempAssignmentMarketingOngoing / $b)/($clientDev->fillByOtherOngoing / $b));
                    $clientDev->clientDev_16=1;
                }else{
                    $clientDev->clientDev_15 = $clientDev->jobOrderContractTempAssignmentMarketingOngoing / $b;
                    $clientDev->clientDev_16 = $clientDev->fillByOtherOngoing / $b;
                }
            }
        }
        if ($clientDev->submittalToday != 0 && $clientDev->sendOutToday != 0) {
            $b = $this->mcd($clientDev->submittalToday, $clientDev->sendOutToday);
            if ($b != 0) {
                if(($clientDev->sendOutToday / $b)>1){
                    $clientDev->clientDev_17 =round(($clientDev->submittalToday / $b)/($clientDev->sendOutToday / $b));
                    $clientDev->clientDev_18=1;
                }else{
                    $clientDev->clientDev_17 = $clientDev->submittalToday / $b;
                    $clientDev->clientDev_18 = $clientDev->sendOutToday / $b;
                } 
            }
        }
        if ($clientDev->submittalOngoing != 0 && $clientDev->sendOutOngoing != 0) {
            $b = $this->mcd($clientDev->submittalOngoing, $clientDev->sendOutOngoing);
            if ($b != 0) {
                if(($clientDev->sendOutOngoing / $b)>1){
                    $clientDev->clientDev_19 =round(($clientDev->submittalOngoing / $b)/($clientDev->sendOutOngoing / $b));
                    $clientDev->clientDev_20=1;
                }else{
                    $clientDev->clientDev_19 = $clientDev->submittalOngoing / $b;
                    $clientDev->clientDev_20 = $clientDev->sendOutOngoing / $b;
                } 
            }
        }
        if ($clientDev->sendOutToday != 0 && $clientDev->fillBySelfToday != 0) {
            $b = $this->mcd($clientDev->sendOutToday, $clientDev->fillBySelfToday);
            if ($b != 0) {
                if(($clientDev->sendOutToday / $b)>1){
                    $clientDev->clientDev_21 =round(($clientDev->sendOutToday / $b)/($clientDev->fillBySelfToday / $b));
                    $clientDev->clientDev_22=1;
                }else{
                    $clientDev->clientDev_21 = $clientDev->sendOutToday / $b;
                    $clientDev->clientDev_22 = $clientDev->fillBySelfToday / $b;
                }
            }
        }
        if ($clientDev->sendOutOngoing != 0 && $clientDev->fillBySelfOngoing != 0) {
            $b = $this->mcd($clientDev->sendOutOngoing, $clientDev->fillBySelfOngoing);
            if ($b != 0) {
                if(($clientDev->fillBySelfOngoing / $b)>1){
                    $clientDev->clientDev_23 =round(($clientDev->sendOutOngoing / $b)/($clientDev->fillBySelfOngoing / $b));
                    $clientDev->clientDev_24=1;
                }else{
                    $clientDev->clientDev_23 = $clientDev->sendOutOngoing / $b;
                    $clientDev->clientDev_24 = $clientDev->fillBySelfOngoing / $b;
                }
            }
        }
        if ($clientDev->sendOutToday != 0 && $clientDev->fillByOtherToday != 0) {
            $b = $this->mcd($clientDev->sendOutToday, $clientDev->fillByOtherToday);
            if ($b != 0) {
                if(($clientDev->fillByOtherToday / $b)>1){
                    $clientDev->clientDev_25 =round(($clientDev->sendOutToday / $b)/($clientDev->fillByOtherToday / $b));
                    $clientDev->clientDev_26=1;
                }else{
                    $clientDev->clientDev_25 = $clientDev->sendOutToday / $b;
                    $clientDev->clientDev_26 = $clientDev->fillByOtherToday / $b;
                }
            }
        }
        if ($clientDev->sendOutOngoing != 0 && $clientDev->fillByOtherOngoing != 0) {
            $b = $this->mcd($clientDev->sendOutOngoing, $clientDev->fillByOtherOngoing);
            if ($b != 0) {
                if(($clientDev->fillByOtherOngoing / $b)>1){
                    $clientDev->clientDev_27 =round(($clientDev->sendOutOngoing / $b)/($clientDev->fillByOtherOngoing / $b));
                    $clientDev->clientDev_28=1;
                }else{
                    $clientDev->clientDev_27 = $clientDev->sendOutOngoing / $b;
                    $clientDev->clientDev_28 = $clientDev->fillByOtherOngoing / $b;
                }
            }
        }

        return $clientDev;
    }

    public function getClientDevOut($id,$type) {

        if($type==0){
            $clientDevOut = DB::table('point_audits')
                ->select(DB::raw(
                                ' IfNULL( sum(point), 0) as completeFaceToFaceAppointmentToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 19 and user_id = ' . $id . ' ) as completeFaceToFaceAppointmentOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 22 and user_id = ' . $id . ' ) as jobOrderContractTempAssignmentToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 22 and user_id = ' . $id . ' ) as jobOrderContractTempAssignmentOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 20 and user_id = ' . $id . ' ) as marketingCallToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 20 and user_id = ' . $id . ' ) as marketingCallOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 21 and user_id = ' . $id . ' ) as mPCPresentationToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 21 and user_id = ' . $id . ' ) as mPCPresentationOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 23 and user_id = ' . $id . ' ) as mpcJOToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 23 and user_id = ' . $id . ' ) as mpcJOOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 24 and user_id = ' . $id . ' ) as fillSelfToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 24 and user_id = ' . $id . ' ) as fillSelfOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 25 and user_id = ' . $id . ' ) as fillOtherToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 25 and user_id = ' . $id . ' ) as fillOtherOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 26 and user_id = ' . $id . ' ) as sendOutToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 26 and user_id = ' . $id . ' ) as sendOutOngoing '
                        ))
                ->where('date', '=', DB::raw('current_date()'))
                ->where('task_id', '=', 19)
                ->where('user_id', '=', $id)
                ->first();
        }else{
            if(Auth::user()->role_id==3){
                $clientDevOut = DB::table('point_audits')
                ->join('users', 'point_audits.user_id', '=', 'users.id')
                ->select(DB::raw(
                                ' IfNULL( sum(point), 0) as completeFaceToFaceAppointmentToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 19 ) as completeFaceToFaceAppointmentOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 22 ) as jobOrderContractTempAssignmentToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 22 ) as jobOrderContractTempAssignmentOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 20 ) as marketingCallToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 20 ) as marketingCallOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 21 ) as mPCPresentationToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 21 ) as mPCPresentationOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 23 ) as mpcJOToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 23 ) as mpcJOOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 24 ) as fillSelfToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 24 ) as fillSelfOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 25 ) as fillOtherToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 25 ) as fillOtherOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 26 ) as sendOutToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 26 ) as sendOutOngoing '
                        ))
                ->where('date', '=', DB::raw('current_date()'))
                ->where('task_id', '=', 19)
                ->where('users.manager_id', '=',Auth::user()->id )
                ->first();
            }else{
                $clientDevOut = DB::table('point_audits')
                ->join('users', 'point_audits.user_id', '=', 'users.id')
                ->select(DB::raw(
                                ' IfNULL( sum(point), 0) as completeFaceToFaceAppointmentToday, ' .
                                '( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 19 ) as completeFaceToFaceAppointmentOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 22 ) as jobOrderContractTempAssignmentToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 22 ) as jobOrderContractTempAssignmentOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 20 ) as marketingCallToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 20 ) as marketingCallOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 21 ) as mPCPresentationToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 21 ) as mPCPresentationOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 23 ) as mpcJOToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 23 ) as mpcJOOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 24 ) as fillSelfToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 24 ) as fillSelfOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 25 ) as fillOtherToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 25 ) as fillOtherOngoing, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 26 ) as sendOutToday, ' .
                                '( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 26 ) as sendOutOngoing '
                        ))
                ->where('date', '=', DB::raw('current_date()'))
                ->where('task_id', '=', 19)
                ->where('users.company_id', '=',Auth::user()->company_id )
                ->first();
            }
            
        }
        

        //$clientDevOut
        $clientDevOut->clientDevOut_1 = $clientDevOut->completeFaceToFaceAppointmentToday;
        $clientDevOut->clientDevOut_2 = $clientDevOut->jobOrderContractTempAssignmentToday;
        $clientDevOut->clientDevOut_3 = $clientDevOut->completeFaceToFaceAppointmentOngoing;
        $clientDevOut->clientDevOut_4 = $clientDevOut->jobOrderContractTempAssignmentOngoing;
        $clientDevOut->clientDevOut_5 = $clientDevOut->marketingCallToday;
        $clientDevOut->clientDevOut_6 = $clientDevOut->jobOrderContractTempAssignmentToday;
        $clientDevOut->clientDevOut_7 = $clientDevOut->marketingCallOngoing;
        $clientDevOut->clientDevOut_8 = $clientDevOut->jobOrderContractTempAssignmentOngoing;
        $clientDevOut->clientDevOut_9 = $clientDevOut->mPCPresentationToday;
        $clientDevOut->clientDevOut_10 = $clientDevOut->mpcJOToday;
        $clientDevOut->clientDevOut_11 = $clientDevOut->mPCPresentationOngoing;
        $clientDevOut->clientDevOut_12 = $clientDevOut->mpcJOOngoing;
        $clientDevOut->clientDevOut_13 = $clientDevOut->jobOrderContractTempAssignmentToday;
        $clientDevOut->clientDevOut_14 = $clientDevOut->fillSelfToday;
        $clientDevOut->clientDevOut_15 = $clientDevOut->jobOrderContractTempAssignmentOngoing;
        $clientDevOut->clientDevOut_16 = $clientDevOut->fillSelfOngoing;
        $clientDevOut->clientDevOut_17 = $clientDevOut->jobOrderContractTempAssignmentToday;
        $clientDevOut->clientDevOut_18 = $clientDevOut->fillOtherToday;
        $clientDevOut->clientDevOut_19 = $clientDevOut->jobOrderContractTempAssignmentOngoing;
        $clientDevOut->clientDevOut_20 = $clientDevOut->fillOtherOngoing;
        $clientDevOut->clientDevOut_21 = $clientDevOut->sendOutToday;
        $clientDevOut->clientDevOut_22 = $clientDevOut->fillOtherToday;
        $clientDevOut->clientDevOut_23 = $clientDevOut->sendOutOngoing;
        $clientDevOut->clientDevOut_24 = $clientDevOut->fillOtherOngoing;

        if ($clientDevOut->completeFaceToFaceAppointmentToday != 0 && $clientDevOut->jobOrderContractTempAssignmentToday != 0) {
            $b = $this->mcd($clientDevOut->completeFaceToFaceAppointmentToday, $clientDevOut->jobOrderContractTempAssignmentToday);
            if ($b != 0) {
                if(($clientDevOut->jobOrderContractTempAssignmentToday / $b)>1){
                    $clientDevOut->clientDevOut_1 =round(($clientDevOut->completeFaceToFaceAppointmentToday / $b)/($clientDevOut->jobOrderContractTempAssignmentToday / $b));
                    $clientDevOut->clientDevOut_2=1;
                }else{
                    $clientDevOut->clientDevOut_1 = $clientDevOut->completeFaceToFaceAppointmentToday / $b;
                    $clientDevOut->clientDevOut_2 = $clientDevOut->jobOrderContractTempAssignmentToday / $b;
                }
                
            }
        }
        if ($clientDevOut->completeFaceToFaceAppointmentOngoing != 0 && $clientDevOut->jobOrderContractTempAssignmentOngoing != 0) {
            $b = $this->mcd($clientDevOut->completeFaceToFaceAppointmentOngoing, $clientDevOut->jobOrderContractTempAssignmentOngoing);
            if ($b != 0) {
                if(($clientDevOut->jobOrderContractTempAssignmentOngoing / $b)>1){
                    $clientDevOut->clientDevOut_3 =round(($clientDevOut->completeFaceToFaceAppointmentOngoing / $b)/($clientDevOut->jobOrderContractTempAssignmentOngoing / $b));
                    $clientDevOut->clientDevOut_4=1;
                }else{
                    $clientDevOut->clientDevOut_3 = $clientDevOut->completeFaceToFaceAppointmentOngoing / $b;
                    $clientDevOut->clientDevOut_4 = $clientDevOut->jobOrderContractTempAssignmentOngoing / $b;
                }
            }
        }
        if ($clientDevOut->marketingCallToday != 0 && $clientDevOut->jobOrderContractTempAssignmentToday != 0) {
            $b = $this->mcd($clientDevOut->marketingCallToday, $clientDevOut->jobOrderContractTempAssignmentToday);
            if ($b != 0) {
                if(($clientDevOut->jobOrderContractTempAssignmentToday / $b)>1){
                    $clientDevOut->clientDevOut_5 =round(($clientDevOut->marketingCallToday / $b)/($clientDevOut->jobOrderContractTempAssignmentToday / $b));
                    $clientDevOut->clientDevOut_6=1;
                }else{
                    $clientDevOut->clientDevOut_5 = $clientDevOut->marketingCallToday / $b;
                    $clientDevOut->clientDevOut_6 = $clientDevOut->jobOrderContractTempAssignmentToday / $b;
                }
            }
        }
        if ($clientDevOut->marketingCallOngoing != 0 && $clientDevOut->jobOrderContractTempAssignmentOngoing != 0) {
            $b = $this->mcd($clientDevOut->marketingCallOngoing, $clientDevOut->jobOrderContractTempAssignmentOngoing);
            if ($b != 0) {
                if(($clientDevOut->jobOrderContractTempAssignmentOngoing / $b)>1){
                    $clientDevOut->clientDevOut_7 =round(($clientDevOut->marketingCallOngoing / $b)/($clientDevOut->jobOrderContractTempAssignmentOngoing / $b));
                    $clientDevOut->clientDevOut_8=1;
                }else{
                    $clientDevOut->clientDevOut_7 = $clientDevOut->marketingCallOngoing / $b;
                    $clientDevOut->clientDevOut_8 = $clientDevOut->jobOrderContractTempAssignmentOngoing / $b;
                }
            }
        }
        if ($clientDevOut->mPCPresentationToday != 0 && $clientDevOut->mpcJOToday != 0) {
            $b = $this->mcd($clientDevOut->mPCPresentationToday, $clientDevOut->mpcJOToday);
            if ($b != 0) {
                if(($clientDevOut->mpcJOToday / $b)>1){
                    $clientDevOut->clientDevOut_9 =round(($clientDevOut->mPCPresentationToday / $b)/($clientDevOut->mpcJOToday / $b));
                    $clientDevOut->clientDevOut_10=1;
                }else{
                    $clientDevOut->clientDevOut_9 = $clientDevOut->mPCPresentationToday / $b;
                    $clientDevOut->clientDevOut_10 = $clientDevOut->mpcJOToday / $b;
                }
            }
        }
        if ($clientDevOut->mPCPresentationOngoing != 0 && $clientDevOut->mpcJOOngoing != 0) {
            $b = $this->mcd($clientDevOut->mPCPresentationOngoing, $clientDevOut->mpcJOOngoing);
            if ($b != 0) {
                if(($clientDevOut->mpcJOOngoing / $b)>1){
                    $clientDevOut->clientDevOut_11 =round(($clientDevOut->mPCPresentationOngoing / $b)/($clientDevOut->mpcJOOngoing / $b));
                    $clientDevOut->clientDevOut_12=1;
                }else{
                    $clientDevOut->clientDevOut_11 = $clientDevOut->mPCPresentationOngoing / $b;
                    $clientDevOut->clientDevOut_12 = $clientDevOut->mpcJOOngoing / $b;
                }
            }
        }
        if ($clientDevOut->jobOrderContractTempAssignmentToday != 0 && $clientDevOut->fillSelfToday != 0) {
            $b = $this->mcd($clientDevOut->jobOrderContractTempAssignmentToday, $clientDevOut->fillSelfToday);
            if ($b != 0) {
                if(($clientDevOut->fillSelfToday / $b)>1){
                    $clientDevOut->clientDevOut_13 =round(($clientDevOut->jobOrderContractTempAssignmentToday / $b)/($clientDevOut->fillSelfToday / $b));
                    $clientDevOut->clientDevOut_14=1;
                }else{
                    $clientDevOut->clientDevOut_13 = $clientDevOut->jobOrderContractTempAssignmentToday / $b;
                    $clientDevOut->clientDevOut_14 = $clientDevOut->fillSelfToday / $b;
                }
            }
        }
        if ($clientDevOut->jobOrderContractTempAssignmentOngoing != 0 && $clientDevOut->fillSelfOngoing != 0) {
            $b = $this->mcd($clientDevOut->jobOrderContractTempAssignmentOngoing, $clientDevOut->fillSelfOngoing);
            if ($b != 0) {
                if(($clientDevOut->fillSelfOngoing / $b)>1){
                    $clientDevOut->clientDevOut_15 =round(($clientDevOut->jobOrderContractTempAssignmentOngoing / $b)/($clientDevOut->fillSelfOngoing / $b));
                    $clientDevOut->clientDevOut_16=1;
                }else{
                    $clientDevOut->clientDevOut_15 = $clientDevOut->jobOrderContractTempAssignmentOngoing / $b;
                    $clientDevOut->clientDevOut_16 = $clientDevOut->fillSelfOngoing / $b;
                }
            }
        }
        if ($clientDevOut->jobOrderContractTempAssignmentToday != 0 && $clientDevOut->fillOtherToday != 0) {
            $b = $this->mcd($clientDevOut->jobOrderContractTempAssignmentToday, $clientDevOut->fillOtherToday);
            if ($b != 0) {
                if(($clientDevOut->fillOtherToday / $b)>1){
                    $clientDevOut->clientDevOut_17 =round(($clientDevOut->jobOrderContractTempAssignmentToday / $b)/($clientDevOut->fillOtherToday / $b));
                    $clientDevOut->clientDevOut_18=1;
                }else{
                    $clientDevOut->clientDevOut_17 = $clientDevOut->jobOrderContractTempAssignmentToday / $b;
                    $clientDevOut->clientDevOut_18 = $clientDevOut->fillOtherToday / $b;
                }
            }
        }
        if ($clientDevOut->jobOrderContractTempAssignmentOngoing != 0 && $clientDevOut->fillOtherOngoing != 0) {
            $b = $this->mcd($clientDevOut->jobOrderContractTempAssignmentOngoing, $clientDevOut->fillOtherOngoing);
            if ($b != 0) {
                if(($clientDevOut->fillOtherOngoing / $b)>1){
                    $clientDevOut->clientDevOut_19 =round(($clientDevOut->jobOrderContractTempAssignmentOngoing / $b)/($clientDevOut->fillOtherOngoing / $b));
                    $clientDevOut->clientDevOut_20=1;
                }else{
                    $clientDevOut->clientDevOut_19 = $clientDevOut->jobOrderContractTempAssignmentOngoing / $b;
                    $clientDevOut->clientDevOut_20 = $clientDevOut->fillOtherOngoing / $b;
                }
            }   
        }
        if ($clientDevOut->sendOutToday != 0 && $clientDevOut->fillOtherToday != 0) {
            $b = $this->mcd($clientDevOut->sendOutToday, $clientDevOut->fillOtherToday);
            if ($b != 0) {
                if(($clientDevOut->fillOtherToday / $b)>1){
                    $clientDevOut->clientDevOut_21 =round(($clientDevOut->sendOutToday / $b)/($clientDevOut->fillOtherToday / $b));
                    $clientDevOut->clientDevOut_22=1;
                }else{
                    $clientDevOut->clientDevOut_21 = $clientDevOut->sendOutToday / $b;
                    $clientDevOut->clientDevOut_22 = $clientDevOut->fillOtherToday / $b;
                }
            }   
        }
        if ($clientDevOut->sendOutOngoing != 0 && $clientDevOut->fillOtherOngoing != 0) {
            $b = $this->mcd($clientDevOut->sendOutOngoing, $clientDevOut->fillOtherOngoing);
            if ($b != 0) {
                if(($clientDevOut->fillOtherOngoing / $b)>1){
                    $clientDevOut->clientDevOut_23 =round(($clientDevOut->sendOutOngoing / $b)/($clientDevOut->fillOtherOngoing / $b));
                    $clientDevOut->clientDevOut_24=1;
                }else{
                    $clientDevOut->clientDevOut_23 = $clientDevOut->sendOutOngoing / $b;
                    $clientDevOut->clientDevOut_24 = $clientDevOut->fillOtherOngoing / $b;
                }
            }   
        }

        return $clientDevOut;
    }
    
    public function mcd($a,$b) {
        if($b==0) return 0;
                while (($a % $b) != 0) {

                  $c = $b;

                  $b = $a % $b;

                  $a = $c;

                }

                return $b;

            }
            
    public function getTodaysStats2($id,$type)
    {
        
        if($type==0){
            $user = User::findOrFail($id);
            return DB::table('point_audits')
            ->join('tasks', 'point_audits.task_id', '=', 'tasks.id')
            ->select(DB::raw('case when SUM(point*value)<1 then 0 else SUM(point*value) end as total, date'))
            ->where('date', '=', DB::raw( 'current_date()' ))
            ->where('user_id', '=', $user->id)
            ->groupBy('user_id')
            ->first();
        }else{
            if(Auth::user()->role_id==3){
                return DB::table('point_audits')
                ->join('tasks', 'point_audits.task_id', '=', 'tasks.id')
                ->join('users', 'point_audits.user_id', '=', 'users.id')
                ->select(DB::raw('case when SUM(point*value)<1 then 0 else SUM(point*value) end as total, date'))
                ->where('date', '=', DB::raw( 'current_date()' ))
                ->where('users.manager_id', '=',Auth::user()->id )
                ->first();
            }else{
                return DB::table('point_audits')
                ->join('tasks', 'point_audits.task_id', '=', 'tasks.id')
                ->join('users', 'point_audits.user_id', '=', 'users.id')
                ->select(DB::raw('case when SUM(point*value)<1 then 0 else SUM(point*value) end as total, date'))
                ->where('date', '=', DB::raw( 'current_date()' ))
                ->where('users.company_id', '=',Auth::user()->company_id )
                ->first();
            }
            
        }
        
    }
    
    public function getAvgPoints($id,$type)
    {
        if($type==0){
            $user = User::findOrFail($id);
            $result = DB::select('CALL avg_member(?)',array($user->id));
                return round($result[0]->total);
        }else{
            if(Auth::user()->role_id==3){
                $result = DB::select('CALL avg_manager(?)',array(Auth::user()->id));
                return round($result[0]->total);
            }else{
                $result = DB::select('CALL avg_owner(?)',array(Auth::user()->company_id));
                return round($result[0]->total);
            }
        }
    }

}
