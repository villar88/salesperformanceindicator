<?php namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\User;
use App\License;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;


class TrainingController extends SecureController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('training.list');
        }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('company.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store( Requests\UpdateAndSaveCompany $request, Company $company )
	{
            $company->create( $request->all() );
            \Session::flash('message','You have successfully Created '. $company->name);
            $companies = Company::orderBy('name')->paginate(15);
            $keyword = '';
            return view('company.list', compact('companies', 'keyword'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $company = Company::findOrFail($id);
        $message = '';
        $users = User::whereRaw('company_id = ? order by first_name', array($company->id))->paginate(15)->appends(Input::except('page'));

        return view('company.show',  ['company' => $company, 'users' => $users,'message'=> $message]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update(Requests\UpdateAndSaveCompany $request, $id)
	{
        $company = Company::findOrFail($id);
        $company->update( $request->all());

        \Session::flash('message','You have successfully Updated '. $company->name);
        return \Redirect::action('CompanyController@index');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $date=new \DateTime(); //this returns the current date time
        $company->status = 'INACTIVE';
        $company->save();
        DB::table('users')
            ->where('company_id', $id)
            ->update(array('status' => 'INACTIVE','inactive_date'=>$date));
        \Session::flash('message','You have successfully disabled '. $company->name);
        $keyword = '';
        $companies = Company:: paginate(15);
        return view('company.list', compact('companies', 'keyword'));
    }

    public function activate($id)
    {
        $company = Company::findOrFail($id);
        $company->status = 'ACTIVE';
        $company->save();
        $date=new \DateTime();
        DB::table('users')
            ->where('company_id', $id)
            ->update(array('status' => 'ACTIVE','active_date'=>$date));
        \Session::flash('message','You have successfully activated '. $company->name);
        $keyword = '';
        $companies = Company:: paginate(15);
        return view('company.list', compact('companies', 'keyword'));
    }


}
