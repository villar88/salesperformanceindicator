<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <h3>Users</h3>
    </div>
    <div class="panel-body">

        @if( \Illuminate\Support\Facades\Auth::user()->role_id == 4 || \Illuminate\Support\Facades\Auth::user()->role_id == 3 )
            <a href="{{ url('/companyUsers/create') }}" class="btn btn-primary pull-right">Add User</a>
        @endif

            <!--...@include('_message')-->
            @if (Session::has('message') )
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span>{{ Session::get('message') }}</span>
                </div>
            @endif

        <!-- Table -->
        <table class="table">
            <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a href="{{ url('/companyUsers/'.$user->id) }}">{{$user->first_name.' '.$user->last_name}}</a></td>
                    <td>{{$user->getEmailDisp()}}</td>
                    <td>{{$user->status}}</td>
                    <td>
                        <a href="{{ url('/companyUsers/sendEmail/'.$user->id) }}" title="Send Username and Password" ><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
                        <a href="{{ url('/users/support/'.$user->id) }}" title="Support Standpoint" ><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-md-2 col-md-offset-5">{!! str_replace('/?', '?', $users->render()) !!}</div>
            @if( \Illuminate\Support\Facades\Auth::user()->role_id == 4 )
                <div class="col-md-11 "><a href="{{ url('/companyUsers/create') }}" class="btn btn-primary">Add User</a></div>
            @endif
    </div>
</div>