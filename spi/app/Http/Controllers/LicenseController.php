<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\User;
use App\License;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
require_once("infusion/isdk.php");

class LicenseController extends SecureController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id) {
        $company = Company::findOrFail($id);
        $licenses = License::whereRaw('company_id like ? order by id', array($id))->paginate(15)->appends(Input::except('page'));
        return view('licenses.list', compact('company', 'licenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id) {
        $company = Company::findOrFail($id);
        return view('licenses.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\UpdateAndSaveLicense $request, Company $company) {
        $date = new \DateTime();
        for($i=0;$i<$request->quantity;$i++){
            $license = new License();
            $license->life = 1;
            $license->company_id = $request->company_id;
            $license->user_id = 0;
            $license->status = 'ACTIVE';
            $license->created_by = Auth::user()->id;
            $license->created_at = $date;
            $license->updated_at = $date;
            $license->save();
        }
        
        \Session::flash('message', 'You have successfully Created a License ');
        $company = Company::findOrFail($license->company_id);
        $licenses = License::whereRaw('company_id like ? order by id', array($license->company_id))->paginate(15)->appends(Input::except('page'));
        return view('licenses.list', compact('company', 'licenses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $license = License::findOrFail($id);
        $company = Company::findOrFail($license->company_id);

        return view('licenses.show', ['license' => $license, 'company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        /*$license = License::findOrFail($id);
        $company = Company::findOrFail($license->company_id);
        return view('licenses._editForm', compact('company','license'));*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Requests\UpdateAndSaveLicense $request, $id) {
        $date = new \DateTime();
        $license = License::findOrFail($id);
        $license->life = 1;//$request->life
        $license->user_id = 0;//Deveria haber una lista con los usuarios
        $license->updated_at = $date;
        $license->update();

        \Session::flash('message', 'You have successfully Updated License');
        //return \Redirect::action('LicenseController@index'); deberia ser
        $company = Company::findOrFail($license->company_id);
        $licenses = License::whereRaw('company_id like ? order by id', array($license->company_id))->paginate(15)->appends(Input::except('page'));
        return view('licenses.list', compact('company', 'licenses'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $license = License::findOrFail($id);
        $date = new \DateTime(); //this returns the current date time
        $license->status = 'INACTIVE';
        $license->save();
        if ($license->user_id != 0) {
            DB::table('users')
                    ->where('id', $license->user_id)
                    ->update(array('status' => 'INACTIVE', 'inactive_date' => $date));
        }
        \Session::flash('message', 'You have successfully disabled License');
        $company = Company::findOrFail($license->company_id);
        $licenses = License::whereRaw('company_id like ? order by id', array($license->company_id))->paginate(15)->appends(Input::except('page'));
        return view('licenses.list', compact('company', 'licenses'));
    }

    public function activate($id) {
        $license = License::findOrFail($id);
        $license->status = 'ACTIVE';
        $license->save();
        $date = new \DateTime();
        if ($license->user_id != 0) {
            DB::table('users')
                    ->where('id', $license->user_id)
                    ->update(array('status' => 'ACTIVE', 'inactive_date' => $date));
        }
        \Session::flash('message', 'You have successfully activated License');
        $company = Company::findOrFail($license->company_id);
        $licenses = License::whereRaw('company_id like ? order by id', array($license->company_id))->paginate(15)->appends(Input::except('page'));
        return view('licenses.list', compact('company', 'licenses'));
    }
    
    public function shoppingcart() {
		
		
	
		if(isset($_POST['first_name'])){
				$app = new \iSDK;
				if ($app->cfgCon("connectionName")) {
					$qry = array('Email'=>$_POST['emailAddress']);
					$ret = array("Id");
					$dups = $app->dsQuery("Contact",1,0,$qry,$ret);
					if(empty($dups)){
							$contact = array( 
								"FirstName" =>     $_POST['first_name'], 
								"LastName" =>         $_POST['last_name'], 
								"State" =>         $_POST['state'],
								"Phone1" =>         $_POST['phoneNumber'],
								"City" =>         $_POST['city'],
								"Email" =>         $_POST['emailAddress'],
								"Address1Type" =>         $_POST['addressLine1'],
								"ZipFour1" =>         $_POST['last_name'],
								"Country" =>         $_POST['last_name'],
								"Company" =>         $_POST['company'],
							);
							$date=date('d/m/y');
							$cid=$app->addCon($contact );
					}else{
							$cid = $dups[0]['Id'];
							$contact = array( 
								"FirstName" =>     $_POST['first_name'], 
								"LastName" =>         $_POST['last_name'], 
								"State" =>         $_POST['state'],
								"Phone1" =>         $_POST['phoneNumber'],
								"City" =>         $_POST['city'],
								"Email" =>         $_POST['emailAddress'],
								"Address1Type" =>         $_POST['addressLine1'],
								"ZipFour1" =>         $_POST['last_name'],
								"Country" =>         $_POST['last_name'],
								"Company" =>         $_POST['company'],
							);
							$contact_ID=$app->updateCon($cid, $contact);
					}
					$fullname = explode(" ", $_POST['nameoncard']);
					$card['FirstName'] = $fullname[0];
					$card['LastName'] = $fullname[1];
					$card['CardNumber'] = $_POST['cnumber'];
					$card['ExpirationMonth'] = $_POST['cardmonth'];
					$card['ExpirationYear'] = $_POST['cardyear'];
					$card['CVV2'] = $_POST['CVV'];
					$result = $app->validateCard($card);
					if ($result['Valid'] == 'false') {
						$msg="Order cancel due to credit card";
						return view('licenses.shoppingcart', compact('msg'));
					}else{
						$ccid = $app->dsAdd("CreditCard", $card);
						//$timezone = new DateTimeZone( "America/New_York" );
						//$date = new DateTime();
						//$date->setTimezone( $timezone );
						$currentDate =  date( 'Y-m-d H:i:s' );
						$oDate = $app->infuDate($currentDate);
						try {
							$invID = $app->blankOrder($cid,"Order for Licenses" . $cid, $oDate,0,0);
						} catch (Exception $e) {
							echo 'Caught exception: ',  $e->getMessage(), "\n";
						}
						$ord = $app->getOrderId($invID);
						$Quantity=$_POST['Quantity'];
						$subID=array();
						for($i=1; $i<=$Quantity; $i++){
								$app->addOrderItem((int)$invID, (int)50, (int)4, (double)0.1, (int)1, 'Licenses Item'.$i, '');
								$_intproductid = $app->addRecurringAdv((int)$cid,true,(int)34,(int)1,(double)0.1,false,(int)2,(int)$ccid,(int)0,(int)30);
								$_nextBillDate = date("d-m-Y", strtotime("1 Months + 1 day"));
								$subID[$i]=$_intproductid;
								$thedate = $app->infuDate($_nextBillDate);
								$app->updateSubscriptionNextBillDate($_intproductid, $thedate);
								$service["Frequency"] = 1;
								$service["BillingCycle"] = 2;
								$app->dsUpdate("RecurringOrder", $_intproductid, $service);
						}
						$payStat = $app->chargeInvoice((int)$invID,"Payment Via API",(int)$ccid,(int)2,false);
						if (substr($payStat['Message'],0,2) == "91"){
							$payStat = $app->chargeInvoice((int)$invID,"Payment Via API",(int)$ccid,(int)2,false);
						}
						if ($payStat['RefNum']!="E"  && $payStat['Code'] == "APPROVED") {
							 $msg="Thanks For Order";
							 $user_id=Auth::user()->id;
							$users = User::findOrFail($user_id);
							for($i=1; $i<=$Quantity; $i++){ 
								$date = new \DateTime();
								$license = new License();
								$license->life = 1;
								$license->license_key=$subID[$i];
								$license->company_id =$users->company_id;
								$license->user_id = 0;
								$license->status = 'ACTIVE';
								$license->created_by = Auth::user()->id;
								$license->created_at = $date;
								$license->updated_at = $date;
								$license->save();
							} 
							return view('licenses.shoppingcart', compact('msg'));
						}else{
							 $msg="Order cancel due payment";
							return view('licenses.shoppingcart', compact('msg'));
						}
					}
					
				}
		}
       
        
       $msg="";
		return view('licenses.shoppingcart', compact('msg'));
    }
    
    public function remove($id) {
        $license = License::findOrFail($id);
        $date = new \DateTime(); //this returns the current date time
        $license->user_id=0;
        $license->save();
        if ($license->user_id != 0) {
            DB::table('users')
                    ->where('id', $license->user_id)
                    ->update(array('status' => 'INACTIVE', 'inactive_date' => $date));
        }
        \Session::flash('message', 'You have successfully remove user for this License');
        $company = Company::findOrFail($license->company_id);
        $licenses = License::whereRaw('company_id like ? order by id', array($license->company_id))->paginate(15)->appends(Input::except('page'));
        return view('licenses.list', compact('company', 'licenses'));
    }

}
