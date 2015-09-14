<?php namespace App\Http\Controllers;

use App\GoalManagement;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MyStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductionSalesRptController extends SecureController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $directHire = parent::getDirectHire(null,0);
		$directHireAnnual = parent::getDirectHireAnnual( null,0);
		$directHireTarget = parent::getDirectHireTarget( null,0);
        $gmp = parent::getGMP( null,0);
		$gmpAnnual = parent::getGMPAnnual( null,0);
                $pointMonthly = parent::getPointMonthly(null,0);
            $pointDaily = parent::getPointDaily(null,0);
//        $gmpTarget = parent::getGMPTarget( null );
//        $recruitingData = parent::getRecruitingPoints( null );
//        $recruitingGoal = parent::getRecruitingGoal( null );
//        return view('prodSales.report', compact('recruitingData', 'recruitingGoal', 'directHire', 'directHireAnnual', 'directHireTarget', 'gmp', 'gmpAnnual', 'gmpTarget'));

		return view('prodSales.report', compact( 'directHireTarget', 'directHireAnnual', 'directHire', 'gmp', 'gmpAnnual','pointMonthly','pointDaily' ));
	}

}
