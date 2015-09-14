<?php namespace App\Http\Controllers;

use App\GoalManagement;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class GoalSettingController extends SecureController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $requested = Input::get('request');
        $message = '';
        if( $requested == null || $requested == '' || $requested == 'showAll' )
        {
            $users = $this->getActiveCompanyUsers( null );
            $keyword = '';
            if( count( $users ) == 25 ) $message = "There are more users than are currently displayed. Please use the search filter.";
            return view('goalSettings.list', compact('users', 'keyword', 'message'));
        }elseif( $requested == 'excel' ){


            $keyword = Input::get('keyword');
            $users = $this->getActiveCompanyUsers( $keyword );

            $data = array(
                array('Member Name', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'ANNUAL')
            );
            foreach( $users as $user )
            {
                array_push ($data, array( $user->first_name . ' ' . $user->last_name, $user->goalManagement->jan, $user->goalManagement->feb, $user->goalManagement->mar, $user->goalManagement->apr,
                    $user->goalManagement->may, $user->goalManagement->jun, $user->goalManagement->jul, $user->goalManagement->aug, $user->goalManagement->sep, $user->goalManagement->oct,
                    $user->goalManagement->nov, $user->goalManagement->dec, $user->goalManagement->annual));
            }


            Excel::create('revenueGoalSettings', function($excel) use($data) {

                $excel->sheet('Revenue Goal Settings', function($sheet) use($data) {

                    $sheet->fromArray($data);

                });

            })->export('xlsx');
        }
        else
        {
            $keyword = Input::get('keyword');
            $users = $this->getActiveCompanyUsers( $keyword );
            if( count( $users ) == 25 ) $message = "There are more users than are currently displayed. Please use the search filter.";
            return view('goalSettings.list', compact('users', 'keyword', 'message'));
        }


    }

    private function getActiveCompanyUsers( $keyword )
    {
        $role_id = Auth::user()->role_id;
        $company_id = Auth::user()->company_id;
        $manager_id = Auth::user()->id;
        $filter = '';
        if( $role_id == 3 )
        {
            $filter = ' and role_id in( 2 ) ';
            if( empty( $keyword) )
            {
                return User::whereRaw('company_id = ? and status = ? and manager_id = ? '.$filter.' order by first_name', array($company_id, 'ACTIVE',$manager_id))->paginate(25)->appends(Input::except('page'));
            }
            else
            {
                return User::whereRaw(' ( first_name like ? or last_name like ? or email like ? ) and  status = ? and company_id = ? and manager_id = ? '.$filter.' order by first_name', array('%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', 'ACTIVE', $company_id,$manager_id))->paginate(25)->appends(Input::except('page'));
            }
        }
        elseif( $role_id == 4 )
        {// En teoria deberia tambien incluir en la lista al mismo owner... se deberia agregar el id del owner
            $filter = ' and role_id in( 2, 3 ) ';
            if( empty( $keyword) )
            {
                return User::whereRaw('company_id = ? and status = ? '.$filter.' order by first_name', array(Auth::user()->company_id, 'ACTIVE'))->paginate(25)->appends(Input::except('page'));
            }
            else
            {
                return User::whereRaw(' ( first_name like ? or last_name like ? or email like ? ) and  status = ? and company_id = ? '.$filter.' order by first_name', array('%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', 'ACTIVE', $company_id))->paginate(25)->appends(Input::except('page'));
            }
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $goalSetting = GoalManagement::findOrFail($id);
        $user = User::findOrFail($goalSetting->user_id);
        return view('goalSettings.edit', compact('user', 'goalSetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\SaveGoalSettingRequest $request, $id)
    {
        $goalSetting = GoalManagement::findOrFail($id);

        $goalSetting->annual = $this->calculateAnnual($request);
        $goalSetting->update( $request->all() );
        $message = 'Goals for ' . $goalSetting->user->last_name . ', ' . $goalSetting->user->first_name .  ' have successfully Updated ';
        $users = $this->getActiveCompanyUsers( null );
        $keyword = '';
        return view('goalSettings.list', compact('users', 'message', 'keyword'));
    }


    public function updateAll()
    {
        $forUpdateArr = Input::get('_id');
        if (!empty($forUpdateArr)) {

            foreach( $forUpdateArr as $id => $value )
            {
                $goalSet = GoalManagement::whereRaw('user_id = ?', array( $id ))->first();
                $goalSet->jan = $this->getInputValue('jan', $id);
                $goalSet->feb = $this->getInputValue('feb', $id);
                $goalSet->mar = $this->getInputValue('mar', $id);
                $goalSet->apr = $this->getInputValue('apr', $id);
                $goalSet->may = $this->getInputValue('may', $id);
                $goalSet->jun = $this->getInputValue('jun', $id);
                $goalSet->jul = $this->getInputValue('jul', $id);
                $goalSet->aug = $this->getInputValue('aug', $id);
                $goalSet->sep = $this->getInputValue('sep', $id);
                $goalSet->oct = $this->getInputValue('oct', $id);
                $goalSet->nov = $this->getInputValue('nov', $id);
                $goalSet->dec = $this->getInputValue('dec', $id);
                $goalSet->annual = $this->compAnnual( $goalSet );
                $goalSet->save();

            }

        }
        $keyword = '';
        $message = 'Goals have been updated. ';
        $users = $this->getActiveCompanyUsers( null );
        if( count( $users ) == 25 ) $message . " There are more users than are currently displayed. Please use the search filter.";
        return view('goalSettings.list', compact('users', 'keyword', 'message'));

    }

    private function getInputValue( $key, $id )
    {
        return  floatval(str_replace(',', '', Input::get($key)[$id]));
    }

    private function compAnnual( $goalSet )
    {
        return
            $goalSet->jan+
            $goalSet->feb+
            $goalSet->mar+
            $goalSet->apr+
            $goalSet->may+
            $goalSet->jun+
            $goalSet->jul+
            $goalSet->aug+
            $goalSet->sep+
            $goalSet->oct+
            $goalSet->nov+
            $goalSet->dec;
    }

    public function export()
    {

    }
}
