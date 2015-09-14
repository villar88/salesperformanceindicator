<?php

namespace App\Http\Controllers;

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
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ReportsController extends SecureController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $requested = Input::get('request');
        $status = Input::get('status');
        $companies = Input::get('companies');
        $filter = Input::get('user_filter');
        if ($requested == null || $requested == '' || $requested == 'showAll') {
            $user = Auth::user();
            $activeTab = 'users';
            $keyword = '';
            $users = User::paginate(15);
            $saleTypes = SaleType::all();
            $status = 'ALL';
            $companies = 'default';
            return view('reports.list', compact('user', 'activeTab', 'saleTypes', 'keyword', 'users', 'status', 'companies'));
        } else {
            if ($filter == 1) {
                $user = Auth::user();
                $activeTab = 'users';
                $keyword = '';
                $users = User::paginate(15);
                $saleTypes = SaleType::all();
                $user_filter = Input::get('user_filter');
                $status_date = Input::get('status_date');
                if ($user_filter == '1') {
                    if ($companies == null || $companies == 'default') {
                        if ($status == null || $status == 'ALL') {
                            $status = 'ALL';
                            $companies = 'default';
                            return view('reports.list', compact('user', 'activeTab', 'saleTypes', 'keyword', 'users', 'status', 'companies'));
                        } else {
                            $companies = 'default';
                            $users = User::whereRaw(' ( status = ?) order by first_name', array($status))->paginate(100)->appends(Input::except('page'));
                            return view('reports.list', compact('user', 'activeTab', 'saleTypes', 'keyword', 'users', 'status', 'companies'));
                        }
                    } else {
                        if ($status == null || $status == 'ALL') {
                            $status = 'ALL';
                            $users = User::whereRaw(' ( company_id = ?) order by first_name', array($companies))->paginate(100)->appends(Input::except('page'));
                            return view('reports.list', compact('user', 'activeTab', 'saleTypes', 'keyword', 'users', 'status', 'companies'));
                        } else {
                            $users = User::whereRaw(' ( company_id = ?  and status = ?) order by first_name', array($companies, $status))->paginate(100)->appends(Input::except('page'));
                            return view('reports.list', compact('user', 'activeTab', 'saleTypes', 'keyword', 'users', 'status', 'companies'));
                        }
                    }
                } else {
                    $status = 'ALL';
                    $companies = 'default';
                    return view('reports.list', compact('user', 'activeTab', 'saleTypes', 'keyword', 'users', 'status', 'companies'));
                }
            } else {
                $status_date = Input::get('status_date');
                $user = Auth::user();
                $activeTab = 'users';
                $keyword = '';
                $users = User::paginate(15);
                $saleTypes = SaleType::all();
                $status = 'ALL';
                $companies = 'default';
                $from_date = Input::get('from_date');
                $to_date = Input::get('to_date');   
                if($status_date == null || $status_date == 'ALL'){
                    return view('reports.list', compact('user', 'activeTab', 'saleTypes', 'keyword', 'users', 'status', 'companies'));
                }
                if($status_date=='ACTIVATION'){
                    $users = User::whereRaw(' ( active_date >= ?  and active_date <= ?) order by first_name', array($from_date, $to_date))->paginate(100)->appends(Input::except('page'));
                    return view('reports.list', compact('user', 'activeTab', 'saleTypes', 'keyword', 'users', 'status', 'companies'));
                }
                if($status_date=='CANCELLATION'){
                    $users = User::whereRaw(' ( inactive_date >= ?  and inactive_date <= ?) order by first_name', array($from_date, $to_date))->paginate(100)->appends(Input::except('page'));
                    return view('reports.list', compact('user', 'activeTab', 'saleTypes', 'keyword', 'users', 'status', 'companies'));
                }
            }
        }
    }

    public function findByStatus() {
        echo '<pre>';
        print_r('algo');
        echo '</pre>';
        exit();
    }

    private function getTarget() {
        $user_id = Auth::user()->id;
        return $users = DB::table('goal_managements')
                ->select(DB::raw(parent::getMonthQuery() . ' as target'))
                ->where('user_id', '=', $user_id)
                ->first();
    }

    private function getTodaysStats() {
        $user = Auth::user();
        return DB::table('point_audits')
                        ->join('tasks', 'point_audits.task_id', '=', 'tasks.id')
                        ->select(DB::raw('SUM(point*value) as total, date'))
                        ->where('date', '=', DB::raw('current_date()'))
                        ->where('user_id', '=', $user->id)
                        ->groupBy('user_id')
                        ->first();
    }

    public function addSales() {
        $activeTab = 'sales';
        $task_types = TaskType::all();
        $saleTypes = SaleType::all();
        $user = Auth::user();
        $today_target = 140;

        $add_sales = $this->doubleValue(Input::get('sales'));
        if (empty($add_sales) || $add_sales <= 0) {
            $today_total = $this->getTodaysStats();
            $message = '<strong>Oh snap!</strong>. Please enter a value of 1 or above.  You entered \'' . Input::get('point') . '\'. Try submitting again.';
            $isErr = true;
            return view('myStat.add', compact('user', 'today_total', 'task_types', 'tasks', 'activeTab', 'isErr', 'message', 'today_target', 'saleTypes'));
        } else {
            $saleType = SaleType::findOrfail(Input::get('saleType_id'));
            $salesAudit = new SaleAudit();

            $salesAudit->sale = $add_sales;
            if (stripos(Input::get('sales'), '-') !== false) {
                $salesAudit->sale = ( -1 * $salesAudit->sale );
            }

            $salesAudit->user_id = Auth::user()->id;
            $salesAudit->company_id = Auth::user()->company_id;
            $salesAudit->saleType_id = $saleType->id;
            $salesAudit->date = new \DateTime();
            $salesAudit->save();


            $salesID = Input::get('saleType_id') . $user->id . date("mdY");
            $salesEntity = Sale::find($salesID);
            if ($salesEntity != null) {
                $salesEntity->sale = $salesEntity->sale + ( $salesAudit->sale );
                $salesEntity->update();
            } else {
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
            $message = 'You have added <strong>' . number_format($salesAudit->sale, 2) . ' points</strong> to <strong>' . $saleType->name . '</strong>.';
            $today_total = $this->getTodaysStats();
            $isErr = false;
            return view('myStat.add', compact('user', 'today_total', 'task_types', 'tasks', 'activeTab', 'isErr', 'message', 'today_target', 'saleTypes'));
        }
    }

    private function doubleValue($money) {
        return doubleval(str_replace(',', '', preg_replace('/[^\d,\.]/', '', $money)));
    }

    public function add() {
        $activeTab = Input::get('task_type_id') ? Input::get('task_type_id') : '1';
        $task_types = TaskType::all();
        $saleTypes = SaleType::all();

        $user = Auth::user();
        $point = intval(Input::get('point'));

        $task = Task::findOrFail(Input::get('task_id'));

        $pointAudit = new PointAudit();
        $pointAudit->point = ($point);
        $pointAudit->user_id = $user->id;
        $pointAudit->company_id = $user->company_id;
        $pointAudit->date = new \DateTime();
        $pointAudit->task_id = $task->id;
        $pointAudit->save();

        $pointID = $user->id . date("mdY");
        $pointEntity = Point::find($pointID);
        if ($pointEntity != null) {
            $pointEntity->points = $pointEntity->points + ( $point );
            $pointEntity->update();
        } else {
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
        $message = '';
        $today_total = $this->getTodaysStats();
        $today_target = 140;
        $isErr = false;


        //echo strip_tags($message);
        //exit;*/
        return view('myStat.add', compact('user', 'today_total', 'task_types', 'tasks', 'activeTab', 'isErr', 'message', 'today_target', 'saleTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\UpdateAndSaveCompany $request, User $user) {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return view('reports.show', ['user' => User::findOrFail($id)]);
    }

}
