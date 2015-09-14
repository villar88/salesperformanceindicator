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
                        @if( \Illuminate\Support\Facades\Auth::user()->role_id == 4)
                            @if( $user->status == 'INACTIVE' )
                                <a href="{{ url('/companyUsers/activate/'.$user->id) }}" title="Active"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a> |
                            @else
                                <a href="{{ url('/companyUsers/destroy/'.$user->id) }}" onclick="return  confirm('Are you sure you want to disable {{$user->last_name}}, {{$user->first_name}}?');" title="Inactive"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a> |
                            @endif
                        @endif
                        <a href="{{ url('/companyUsers/'.$user->id) }}" title="Edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> |
                        <a href="{{ url('/companyUsers/statistics/'.$user->id) }}" title="Statistics"><span class="glyphicon glyphicon-stats"  aria-hidden="true"></span></a>|
                        <a href="{{ url('/users/reset/'.$user->id) }}" title="Reset" ><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span></a>
                        <a href="{{ url('/companyUsers/sendEmail/'.$user->id) }}" title="Send Username and Password" ><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
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