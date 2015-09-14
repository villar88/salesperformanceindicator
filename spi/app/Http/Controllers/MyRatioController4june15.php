<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyRatioController extends SecureController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$recruiting = DB::table('point_audits')
			->select(DB::raw(
			' IfNULL(sum(point), 0 ) as recruitingPresentationToday, ' .
			'( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 1 and user_id = ' . $user->id . ' ) as recruitingPresentationOngoing, ' .
			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 2 and user_id = ' . $user->id . ' ) as recruitingHitToday, ' .
			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 2 and user_id = ' . $user->id . ' ) as recruitingHitOngoing, ' .

			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 4 and user_id = ' . $user->id . ' ) as candidateInterviewToday, ' .
			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 4 and user_id = ' . $user->id . ' ) as candidateInterviewOngoing, ' .

			'( SELECT IfNULL( sum(point), 0 ) FROM point_audits where date = current_date() and task_id = 5 and user_id = ' . $user->id . ' ) as interviewReactivatedCandidateToday, ' .
			'( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 5 and user_id = ' . $user->id . ' ) as interviewReactivatedCandidateOngoing, ' .

			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 5 and user_id = ' . $user->id . ' ) as interviewReactivatedCandidateToday, ' .
			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 5 and user_id = ' . $user->id . ' ) as interviewReactivatedCandidateOngoing, ' .

			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 9 and user_id = ' . $user->id . ' ) as fillOrPlacementToday, ' .
			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 9 and user_id = ' . $user->id . ' ) as fillOrPlacementOngoing, ' .

			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 7 and user_id = ' . $user->id . ' ) as sendOutRToday, ' .
			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 7 and user_id = ' . $user->id . ' ) as sendOutROngoing, ' .

			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 6 and user_id = ' . $user->id . ' ) as sendOutInterviewToday, ' .
			'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 6 and user_id = ' . $user->id . ' ) as sendOutInterviewOngoing '

			))
			->where('date', '=', DB::raw('current_date()') )
			->where('task_id', '=', 1 )
			->where('user_id', '=', $user->id )
			->first();

		$clientDev = DB::table('point_audits')
			->select(DB::raw(
				' IfNULL( sum(point), 0) as marketingCallToday, ' .
				'( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 10 and user_id = ' . $user->id . ' ) as marketingCallOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 11 and user_id = ' . $user->id . ' ) as mPCPresentationToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 11 and user_id = ' . $user->id . ' ) as mPCPresentationOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 12 and user_id = ' . $user->id . ' ) as jobOrderContractTempAssignmentMpcToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 12 and user_id = ' . $user->id . ' ) as jobOrderContractTempAssignmentMpcOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 16 and user_id = ' . $user->id . ' ) as fillBySelfToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 16 and user_id = ' . $user->id . ' ) as fillBySelfOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 17 and user_id = ' . $user->id . ' ) as fillByOtherToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 17 and user_id = ' . $user->id . ' ) as fillByOtherOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 14 and user_id = ' . $user->id . ' ) as submittalToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 14 and user_id = ' . $user->id . ' ) as submittalOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 15 and user_id = ' . $user->id . ' ) as sendOutToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 15 and user_id = ' . $user->id . ' ) as sendOutOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 13 and user_id = ' . $user->id . ' ) as jobOrderContractTempAssignmentMarketingToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 13 and user_id = ' . $user->id . ' ) as jobOrderContractTempAssignmentMarketingOngoing '

			))
			->where('date', '=', DB::raw('current_date()') )
			->where('task_id', '=', 10 )
			->where('user_id', '=', $user->id )
			->first();

		$clientDevOut = DB::table('point_audits')
			->select(DB::raw(
				' IfNULL( sum(point), 0) as completeFaceToFaceAppointmentToday, ' .
				'( SELECT IfNULL( sum(point), 0 ) FROM point_audits where task_id = 19 and user_id = ' . $user->id . ' ) as completeFaceToFaceAppointmentOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 22 and user_id = ' . $user->id . ' ) as jobOrderContractTempAssignmentToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 22 and user_id = ' . $user->id . ' ) as jobOrderContractTempAssignmentOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 20 and user_id = ' . $user->id . ' ) as marketingCallToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 20 and user_id = ' . $user->id . ' ) as marketingCallOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 21 and user_id = ' . $user->id . ' ) as mPCPresentationToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 21 and user_id = ' . $user->id . ' ) as mPCPresentationOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 23 and user_id = ' . $user->id . ' ) as mpcJOToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 23 and user_id = ' . $user->id . ' ) as mpcJOOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 24 and user_id = ' . $user->id . ' ) as fillSelfToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 24 and user_id = ' . $user->id . ' ) as fillSelfOngoing, ' .

				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where date = current_date() and task_id = 25 and user_id = ' . $user->id . ' ) as fillOtherToday, ' .
				'( SELECT IfNULL( sum(point), 0 )  FROM point_audits where task_id = 25 and user_id = ' . $user->id . ' ) as fillOtherOngoing '

			))
			->where('date', '=', DB::raw('current_date()') )
			->where('task_id', '=', 19 )
			->where('user_id', '=', $user->id )
			->first();

		return view('myRatio.report', compact('recruiting', 'clientDev', 'clientDevOut'));
	}

}
