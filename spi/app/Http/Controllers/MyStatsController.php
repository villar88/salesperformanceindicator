<?php namespace App\Http\Controllers;

use App\GoalManagement;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MySales;
use App\MyStat;
use App\Point;
use App\PointAudit;
use App\Sale;
use App\SaleAudit;
use App\SaleType;
use App\Task;
use App\TaskType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MyStatsController extends SecureController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $activeTab = Input::get('task_type_id') ? Input::get('task_type_id') : '1';
        $today_total = $this->getTodaysStats();
        $today_target = 140;

        $task_types = TaskType::all();
        $saleTypes = SaleType::all();
        return view('myStat.add', compact('user', 'today_total', 'task_types', 'tasks', 'activeTab', 'isErr', 'message', 'today_target', 'saleTypes'));
    }

    private function getTarget()
    {
        $user_id = Auth::user()->id;
        return $users = DB::table('goal_managements')
            ->select(DB::raw( parent::getMonthQuery().' as target'))
            ->where('user_id', '=', $user_id)
            ->first();
    }


    private function getTodaysStats()
    {
        $user = Auth::user();
        return DB::table('point_audits')
            ->join('tasks', 'point_audits.task_id', '=', 'tasks.id')
            ->select(DB::raw('SUM(point*value) as total, date'))
            ->where('date', '=', DB::raw( 'current_date()' ))
            ->where('user_id', '=', $user->id)
            ->groupBy('user_id')
            ->first();
    }

    public function addSales()
    {
        $activeTab = 'sales';
        $task_types = TaskType::all();
        $saleTypes = SaleType::all();
        $user = Auth::user();
        $today_target = 140;

        $add_sales = $this->doubleValue ( Input::get('sales') );
        if( empty($add_sales) || $add_sales <= 0 )
        {
            $today_total = $this->getTodaysStats();
            $message = '<strong>Oh snap!</strong>. Please enter a value of 1 or above.  You entered \''.Input::get('point'). '\'. Try submitting again.';
            $isErr = true;
            return view('myStat.add', compact('user', 'today_total', 'task_types', 'tasks', 'activeTab', 'isErr', 'message', 'today_target', 'saleTypes'));
        }
        else
        {
            $saleType = SaleType::findOrfail( Input::get('saleType_id') );
            $salesAudit = new SaleAudit();

            $salesAudit->sale = $add_sales;
            if(stripos(Input::get('sales'), '-') !== false)
            {
                $salesAudit->sale = ( -1 * $salesAudit->sale );
            }

            $salesAudit->user_id = Auth::user()->id;
            $salesAudit->company_id = Auth::user()->company_id;
            $salesAudit->saleType_id = $saleType->id;
            $salesAudit->date = new \DateTime();
            $salesAudit->save();


            $salesID = Input::get('saleType_id').$user->id . date("mdY");
            $salesEntity = Sale::find($salesID);
            if( $salesEntity != null )
            {
                $salesEntity->sale = $salesEntity->sale + ( $salesAudit->sale );
                $salesEntity->update();

            }
            else
            {
                $salesEntity = new Sale();
                $salesEntity->id = $salesID;

                $salesEntity->month = date("m");
                $salesEntity->year = date("Y");
                $salesEntity->user_id = $user->id;
                $salesEntity->saleType_id = Input::get('saleType_id');
                $salesEntity->company_id = $user->company_id;
                $salesEntity->sale = $salesAudit->sale;
                $salesEntity->save();
            }
            $message = 'You have added <strong>'. number_format( $salesAudit->sale, 2 ) .' points</strong> to <strong>'.$saleType->name.'</strong>.';
            $today_total = $this->getTodaysStats();
            $isErr = false;
            return view('myStat.add', compact('user', 'today_total', 'task_types', 'tasks', 'activeTab', 'isErr', 'message', 'today_target', 'saleTypes'));
        }

    }

    private function doubleValue( $money )
    {
        return  doubleval( str_replace(',', '', preg_replace('/[^\d,\.]/', '', $money) ));
    }

    public function  add ()
    {
        $activeTab = Input::get('task_type_id') ? Input::get('task_type_id') : '1';
        $task_types = TaskType::all();
        $saleTypes = SaleType::all();

        $user = Auth::user();
        $point = intval(Input::get('point'));

        $task = Task::findOrFail( Input::get('task_id') );

        $pointAudit = new PointAudit();
        $pointAudit->point = ($point);
        $pointAudit->user_id = $user->id;
        $pointAudit->company_id = $user->company_id;
        $pointAudit->date = new \DateTime();
        $pointAudit->task_id = $task->id;
        $pointAudit->save();

        $pointID = $user->id . date("mdY");
        $pointEntity = Point::find($pointID);
        if( $pointEntity != null )
        {
            $pointEntity->points = $pointEntity->points + ( $point );
            $pointEntity->update();

        }
        else
        {
            $pointEntity = new Point();
            $pointEntity->id = $pointID;

            $pointEntity->month = date("m");
            $pointEntity->year = date("Y");
            $pointEntity->user_id = $user->id;
            $pointEntity->company_id = $user->company_id;
            $pointEntity->points = ( $point );
            $pointEntity->save();
        }


        //$message = 'You have ' . ( $pointAudit->point > 0 ? 'added' : 'adjusted' ) . ' <strong> ' . intval( $point ) . ' points</strong> to <strong>'.$task->name.'</strong>.';
        $message='';
        $today_total = $this->getTodaysStats();
        $today_target = 140;
        $isErr = false;
        $location='#point_'.$task->id;

		//echo strip_tags($message);
                //exit;*/
        return view('myStat.add', compact('user', 'today_total', 'task_types', 'tasks', 'activeTab', 'isErr', 'message', 'today_target', 'saleTypes','location'));

    }

//    public function add(  )
//    {
//        $activeTab = Input::get('task_type_id') ? Input::get('task_type_id') : '1';
//        $task_types = TaskType::all();
//        $sales = Sale::all();
//
//        $point = intval(Input::get('point'));
//        $today_target = $this->getTarget();
//
//         if( empty($point) || $point <= 0 )
//        {
//            $today_total = $this->getTodaysStats();
//            $message = '<strong>Oh snap!</strong>. Please enter a value of 1 or above.  You entered \''.Input::get('point'). '\'. Try submitting again.';
//            $isErr = true;
//            return view('myStat.add', compact('user', 'today_total', 'task_types', 'tasks', 'activeTab', 'isErr', 'message', 'today_target', 'sales'));
//        }
//        else
//        {
//            $task = Task::findOrFail( Input::get('task_id') );
//            $myTask = new MyStat();
//            $myTask->point = ( $point * $task->value);
//            $myTask->user_id = Auth::user()->id;
//            $myTask->company_id = Auth::user()->company_id;
//            $myTask->date = new \DateTime();
//            $myTask->task_id = $task->id;
//            $myTask->save();
//            $message = 'You have added <strong>'. $myTask->point .' points</strong> to <strong>'.$task->name.'</strong>.';
//            $today_total = $this->getTodaysStats();
//            $isErr = false;
//
//            return view('myStat.add', compact('user', 'today_total', 'task_types', 'tasks', 'activeTab', 'isErr', 'message', 'today_target', 'sales'));
//        }
//
//    }

}
