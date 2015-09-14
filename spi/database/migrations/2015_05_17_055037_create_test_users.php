<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        // Roles
        // Super Admin ->  1, Member-> 2, Manager -> 3, Owner -> 4

        DB::table('users')->insert(array( 'email' => 'system@system.com', 'first_name' => 'System', 'last_name' => 'Admin', 'password' => bcrypt('abcd@1234'), 'role_id' => '1',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'adm@adm.com', 'first_name' => 'Company', 'last_name' => 'Owner', 'password' => bcrypt('abcd@1234'), 'role_id' => '4',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'manager@manager.com', 'first_name' => 'Office', 'last_name' => 'Manager', 'password' => bcrypt('abcd@1234'), 'role_id' => '3',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec2.com', 'first_name' => 'Member', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));


        //Other users
        DB::table('users')->insert(array( 'email' => 'rec2@rec3.com', 'first_name' => 'Member1', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec4.com', 'first_name' => 'Member2', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec5.com', 'first_name' => 'Member3', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec6.com', 'first_name' => 'Member4', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec7.com', 'first_name' => 'Member5', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec8.com', 'first_name' => 'Member6', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec9.com', 'first_name' => 'Member7', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec10.com', 'first_name' => 'Member8', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec11.com', 'first_name' => 'Member9', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '2',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec12.com', 'first_name' => 'Member10', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '1',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '2',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec13.com', 'first_name' => 'Member11', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 1', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '2',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec14.com', 'first_name' => 'Member12', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '3',
            'address1' => 'Address 1', 'address2' => 'Address 1', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '2',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec15.com', 'first_name' => 'Member13', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '4',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '2',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec16.com', 'first_name' => 'Member14', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '2',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec17.com', 'first_name' => 'Member15', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '2',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec18.com', 'first_name' => 'Member16', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '3',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec19.com', 'first_name' => 'Member17', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '1',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '3',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec20.com', 'first_name' => 'Member18', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '3',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec21.com', 'first_name' => 'Member19', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '3',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '3',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec22.com', 'first_name' => 'Member20', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '4',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '3',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec23.com', 'first_name' => 'Member21', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '3',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec24.com', 'first_name' => 'Member22', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '3',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec25.com', 'first_name' => 'Member23', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '3',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec26.com', 'first_name' => 'Member24', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '3',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec27.com', 'first_name' => 'Member25', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec28.com', 'first_name' => 'Member26', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec29.com', 'first_name' => 'Member', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec30.com', 'first_name' => 'Member', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec31.com', 'first_name' => 'Member', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));
        DB::table('users')->insert(array( 'email' => 'rec2@rec32.com', 'first_name' => 'Member', 'last_name' => 'Test', 'password' => bcrypt('abcd@1234'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));

        DB::table('users')->insert(array( 'email' => 'steve@torrefranca.org', 'first_name' => 'Steve', 'last_name' => 'Torrefranca', 'password' => bcrypt('123456'), 'role_id' => '2',
            'address1' => 'Address 1', 'address2' => 'Address 2', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'company_id' => '1',  'status' => 'ACTIVE'));


        DB::table('companies')->insert(array( 'name' => 'Good as Gold Training', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'status' => 'ACTIVE'));
        DB::table('companies')->insert(array( 'name' => 'Another Company', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'status' => 'ACTIVE'));
        DB::table('companies')->insert(array( 'name' => 'Microsoft', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'status' => 'ACTIVE'));
        DB::table('companies')->insert(array( 'name' => 'Oracle', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'status' => 'ACTIVE'));
        DB::table('companies')->insert(array( 'name' => 'Apple', 'created_by' => '1', 'updated_by' => '1', 'created_at' => new DateTime(), 'updated_at' => new DateTime(), 'status' => 'ACTIVE'));

        //Goals

        DB::table('task_types')->insert(array( 'name' => 'Recruiting'));
        DB::table('task_types')->insert(array( 'name' => 'Client Development - Inside'));
        DB::table('task_types')->insert(array( 'name' => 'Client Development - Outside'));

        DB::table('tasks')->insert(array( 'name' => 'Recruiting Presentations', 'description' => 'Number of actual recruiting presentations to prospective candidates.', 'task_type_id' => 1, 'icon' => 'recruiting-presentation.png', 'value' => 2));
        DB::table('tasks')->insert(array( 'name' => 'Recruiting Hits', 'description' => 'Number of prospective candidates who show interest and set up a time to be interviewed as a result of recruiting hit.', 'task_type_id' => 1, 'icon' => 'recruiting-hint.png', 'value' => 5));
        DB::table('tasks')->insert(array( 'name' => 'Reactivated Candidates Hits', 'description' => 'Number of past candidates you reactivate, show interest and set up a time to be interviewed by you.', 'task_type_id' => 1, 'icon' => 'reactivated-candidates.png', 'value' => 5));
        DB::table('tasks')->insert(array( 'name' => 'Candidate Interview', 'description' => 'Number of candidates you interview by phone or in person.', 'task_type_id' => 1, 'icon' => 'interview-candidate.png', 'value' => 10));
        DB::table('tasks')->insert(array( 'name' => 'Interview Reactivated Candidates', 'description' => 'Number of reactivated candidates you interview by phone or in person.', 'task_type_id' => 1, 'icon' => 'interview-candidate.png', 'value' => 10));
        DB::table('tasks')->insert(array( 'name' => 'Send Outs', 'description' => 'Number of send outs (interview between your candidate and client) as a result of your interview.', 'task_type_id' => 1, 'icon' => 'send-out.png', 'value' => 15));
        DB::table('tasks')->insert(array( 'name' => 'Send Outs of Reactivated Candidates', 'description' => 'Number of send outs (interview between your candidate and client) as a result of reactivated candidate interview.', 'task_type_id' => 1, 'icon' => 'send-out.png', 'value' => 15));
        DB::table('tasks')->insert(array( 'name' => 'Reference Checks', 'description' => 'Number of candidate reference checks completed.', 'task_type_id' => 1, 'icon' => 'reference-checks.png', 'value' => 10));
        DB::table('tasks')->insert(array( 'name' => 'Placements or Fills', 'description' => 'Number of job orders, contracts or assignments you filled with your candidate.', 'task_type_id' => 1, 'icon' => 'placement-or-fill.png', 'value' => 25));

        DB::table('tasks')->insert(array( 'name' => 'Marketing Calls', 'description' => 'Number of completed marketing presentations.', 'task_type_id' => 2, 'icon' => 'marketing-call.png', 'value' =>2 ));
        DB::table('tasks')->insert(array( 'name' => 'MPC Presentations', 'description' => 'Number of marketing presentations using a MPC (most placeable candidate).', 'task_type_id' => 2, 'icon' => 'mpc-presentation.png', 'value' =>5 ));
        DB::table('tasks')->insert(array( 'name' => 'Job Orders, Contracts or Temp Assignments', 'description' => 'Number of job orders, contracts or temp assignments written as a result of MPC presentation.', 'task_type_id' => 2, 'icon' => 'job-order.png', 'value' =>10 ));
        DB::table('tasks')->insert(array( 'name' => 'Job Order, Contract or Temp Assignment', 'description' => 'Number of job orders, contracts or temp assignments written as a result of marketing call.', 'task_type_id' => 2, 'icon' => 'job-order.png', 'value' =>10 ));
        DB::table('tasks')->insert(array( 'name' => 'Candidate Presentations or Submittals to Client', 'description' => 'Number of candidates presented or submitted to client.', 'task_type_id' => 2, 'icon' => 'candidate-presentation.png', 'value' =>2 ));
        DB::table('tasks')->insert(array( 'name' => 'Send Outs', 'description' => 'Number of your send outs (interview between candidate and your client).', 'task_type_id' => 2, 'icon' => 'send-out.png', 'value' =>10 ));
        DB::table('tasks')->insert(array( 'name' => 'Fill by Self', 'description' => 'Number of your job orders, contracts or assignments you filled with your own candidate.', 'task_type_id' => 2, 'icon' => 'fill-by-self.png', 'value' =>25 ));
        DB::table('tasks')->insert(array( 'name' => 'Fill by Others\'', 'description' => 'Number of your job orders, contracts or assignment you filled with others’ candidates.', 'task_type_id' => 2, 'icon' => 'fill-by-other.png', 'value' =>25 ));

        DB::table('tasks')->insert(array( 'name' => 'Schedule Face-to-Face Appointments', 'description' => 'Number of in person face-to-face appointments scheduled.', 'task_type_id' => 3, 'icon' => 'schedule-face-to-face-appointment.png', 'value' => 5 ));
        DB::table('tasks')->insert(array( 'name' => 'Complete Face-to-Face Appointments', 'description' => 'Number of completed face-to-face in person appointments.', 'task_type_id' => 3, 'icon' => 'complete-ff-appointment.png', 'value' => 10 ));
        DB::table('tasks')->insert(array( 'name' => 'Marketing Calls', 'description' => 'Number of completed marketing presentations.', 'task_type_id' => 3, 'icon' => 'marketing-call.png', 'value' => 2 ));
        DB::table('tasks')->insert(array( 'name' => 'MPC Presentations', 'description' => 'Number of marketing presentations using a MPC (most placeable candidate).', 'task_type_id' => 3, 'icon' => 'mpc-presentation2.png', 'value' => 5 ));
        DB::table('tasks')->insert(array( 'name' => 'Job Orders, Contracts or Temp Assignments', 'description' => 'Number of job orders, contracts or temp assignments written as a result of marketing call or appointment.', 'task_type_id' => 3, 'icon' => 'job-order2.png', 'value' => 10 ));
        DB::table('tasks')->insert(array( 'name' => 'Job Orders, Contracts or Temp Assignments', 'description' => 'Number of job orders, contracts or temp assignments written as a result of MPC (most placeable candidate) presentation.', 'task_type_id' => 3, 'icon' => 'job-order2.png', 'value' => 10 ));
        DB::table('tasks')->insert(array( 'name' => 'Fill by Self', 'description' => 'Number of your job orders, contracts or assignments you filled with your own candidate.', 'task_type_id' => 3, 'icon' => 'fill-by-self2.png', 'value' => 25 ));
        DB::table('tasks')->insert(array( 'name' => 'Fill by Others\'', 'description' => 'Number of your job orders, contracts or assignment you filled with others’ candidates.', 'task_type_id' => 3, 'icon' => 'fill-by-self2.png', 'value' => 25 ));


        for ($i = 1; $i <= 35; $i++) {
            DB::table('goal_managements')->insert(array( 'user_id' => $i, 'jan' => 10000,'feb' => 10000,'mar' => 10000,'apr' => 10000,'may' => 10000,'jun' => 10000,'jul' => 10000,'aug' => 10000,'sep' => 10000,'oct' => 10000, 'nov' => 10000,'dec' => 10000,'created_by' => 1, 'updated_by' => 1, 'annual'=> 120000, 'created_at' => new DateTime(), 'updated_at' => new DateTime() ));

        }


        //Sales
        DB::table('sale_types')->insert(array( 'name' => 'Direct Production', 'description' => 'List dollar amount of revenue profit generated.', 'icon' => 'revenue.png' ));
        DB::table('sale_types')->insert(array( 'name' => 'Temp or Contract GMP', 'description' => 'List gross margin of profit generated.', 'icon' => 'revenue.png' ));


        DB::table('sales')->insert(array( 'id' => '301012011', 'month'=>'01', 'year'=>'2011', 'user_id'=>3, 'company_id'=>1, 'saleType_id'=> 1,'sale'=>3342));
        DB::table('sales')->insert(array( 'id' => '301012013', 'month'=>'01', 'year'=>'2013', 'user_id'=>3, 'company_id'=>1, 'saleType_id'=> 1,'sale'=>30290));

        DB::table('sales')->insert(array( 'id' => '301012015', 'month'=>'01', 'year'=>'2015', 'user_id'=>3, 'company_id'=>1, 'saleType_id'=> 1,'sale'=>30290));
        DB::table('sales')->insert(array( 'id' => '301052015', 'month'=>'01', 'year'=>'2015', 'user_id'=>3, 'company_id'=>1, 'saleType_id'=> 2, 'sale'=>6690.99));
        DB::table('sales')->insert(array( 'id' => '301252015', 'month'=>'01', 'year'=>'2015', 'user_id'=>3, 'company_id'=>1, 'saleType_id'=> 1, 'sale'=>700));

        DB::table('sales')->insert(array( 'id' => '302012015', 'month'=>'02', 'year'=>'2015', 'user_id'=>3, 'company_id'=>1, 'saleType_id'=> 1, 'sale'=>287.90));
        DB::table('sales')->insert(array( 'id' => '302052015', 'month'=>'02', 'year'=>'2015', 'user_id'=>3, 'company_id'=>1, 'saleType_id'=> 2, 'sale'=>32223));
        DB::table('sales')->insert(array( 'id' => '302252015', 'month'=>'02', 'year'=>'2015', 'user_id'=>3, 'company_id'=>1, 'saleType_id'=> 1, 'sale'=>2222));

        DB::table('sales')->insert(array( 'id' => '303012015', 'month'=>'03', 'year'=>'2015', 'user_id'=>3, 'company_id'=>1, 'saleType_id'=> 1, 'sale'=>44));
        DB::table('sales')->insert(array( 'id' => '303052015', 'month'=>'03', 'year'=>'2015', 'user_id'=>3, 'company_id'=>1, 'saleType_id'=> 1, 'sale'=>3344));
        DB::table('sales')->insert(array( 'id' => '303252015', 'month'=>'03', 'year'=>'2015', 'user_id'=>3, 'company_id'=>1, 'saleType_id'=> 2, 'sale'=>33442));
//        for ($i = 1; $i <= 35; $i++) {
//            DB::table('goal_managements')->insert(array( 'user_id' => $i, 'direct_hire' => 10000, 'gmp' => 10000, 'jan' => 140,'feb' => 140,'mar' => 140,'apr' => 140,'may' => 140,'jun' => 140,'jul' => 140,'aug' => 140,'sep' => 140,'oct' => 140, 'nov' => 140,'dec' => 140,'created_by' => 1, 'updated_by' => 1, 'annual'=> 33600, 'created_at' => new DateTime(), 'updated_at' => new DateTime() ));
//
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2014-01-15'), 'point' => 140, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2014-02-15'), 'point' => 55, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-01'), 'point' => 190, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-01'), 'point' => 920, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-05'), 'point' => 560, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-07'), 'point' => 570, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-08'), 'point' => 423, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-09'), 'point' => 443, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-10'), 'point' => 1234, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-11'), 'point' => 90, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-12'), 'point' => 890, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-13'), 'point' => 882, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-14'), 'point' => 1111, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-15'), 'point' => 502, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-16'), 'point' => 190, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-17'), 'point' => 210, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-18'), 'point' => 190, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-19'), 'point' => 670, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-20'), 'point' => 210, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-25'), 'point' => 330, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-26'), 'point' => 220, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2014-04-30'), 'point' => 15, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2014-05-15'), 'point' => 20, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2014-06-15'), 'point' => 35, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2014-07-15'), 'point' => 11, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2014-08-15'), 'point' => 23, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2014-09-15'), 'point' => 109, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2014-10-15'), 'point' => 333, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2014-11-15'), 'point' => 225, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2014-12-15'), 'point' => 125, 'review' => false ));
//            //DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-01-15'), 'point' => 225, 'review' => false ));
//            //DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-02-15'), 'point' => 25, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 15, 'date' => new DateTime('2015-03-15'), 'point' => 75, 'review' => false ));
//
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 1, 'date' => new DateTime('2013-03-15'), 'point' => 1275, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 2, 'date' => new DateTime('2012-03-15'), 'point' => 7335, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 3, 'date' => new DateTime('2015-03-15'), 'point' => 1225, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 4, 'date' => new DateTime('2015-03-15'), 'point' => 375, 'review' => false ));
//            DB::table('my_stats')->insert(array( 'user_id' => $i, 'company_id' => 1, 'task_id' => 5, 'date' => new DateTime('2012-03-15'), 'point' => 4175, 'review' => false ));
//
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-01-15'), 'sales' => 4175.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-02-15'), 'sales' => 10987.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-03-15'), 'sales' => 1124.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-04-15'), 'sales' => 9098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-05-15'), 'sales' => 10098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-06-15'), 'sales' => 76591.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-07-15'), 'sales' => 101989.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-08-15'), 'sales' => 4578.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-09-15'), 'sales' => 55421.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-10-15'), 'sales' => 4175.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-11-15'), 'sales' => 10987.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2014-12-15'), 'sales' => 1124.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-02-15'), 'sales' => 9098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-02-15'), 'sales' => 9098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-15'), 'sales' => 9098.89, 'review' => false ));
//
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-05-15'), 'sales' => 4175.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-04-15'), 'sales' => 10987.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-03-15'), 'sales' => 1124.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-02-15'), 'sales' => 9098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-01-15'), 'sales' => 10098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-12-15'), 'sales' => 76591.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-11-15'), 'sales' => 101989.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-10-15'), 'sales' => 4578.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-09-15'), 'sales' => 55421.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-08-15'), 'sales' => 4175.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-07-15'), 'sales' => 10987.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2014-06-15'), 'sales' => 1124.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-01-15'), 'sales' => 9098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-01-15'), 'sales' => 9098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-01-15'), 'sales' => 9098.89, 'review' => false ));
//
//
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-01'), 'sales' => 4175.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-02'), 'sales' => 10987.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-04'), 'sales' => 1124.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-05'), 'sales' => 9098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-08'), 'sales' => 10098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-09'), 'sales' => 76591.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-12'), 'sales' => 101989.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-13'), 'sales' => 4578.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-15'), 'sales' => 55421.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-16'), 'sales' => 4175.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-17'), 'sales' => 10987.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-18'), 'sales' => 1124.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-20'), 'sales' => 9098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-21'), 'sales' => 9098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-25'), 'sales' => 9098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-26'), 'sales' => 9098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 1, 'date' => new DateTime('2015-03-27'), 'sales' => 9098.89, 'review' => false ));
//
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-01'), 'sales' => 7689.2, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-02'), 'sales' => 88761.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-04'), 'sales' => 1334.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-05'), 'sales' => 88766.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-08'), 'sales' => 10098.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-09'), 'sales' => 90191.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-12'), 'sales' => 9901.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-13'), 'sales' => 12.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-15'), 'sales' => 23244.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-16'), 'sales' => 54335.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-17'), 'sales' => 14447.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-18'), 'sales' => 134534.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-20'), 'sales' => 93458.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-21'), 'sales' => 911.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-25'), 'sales' => 92398.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-26'), 'sales' => 908.89, 'review' => false ));
//            DB::table('my_sales')->insert(array( 'user_id' => $i, 'company_id' => 1, 'sales_id' => 2, 'date' => new DateTime('2015-03-27'), 'sales' => 4556.89, 'review' => false ));
//        }
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
