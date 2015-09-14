@extends('app')

@section('content')
<div class="page-header" id="banner">
    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-6">
            <h2>Manage Licenses</h2>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <h2>Licenses for  {{ $company->name }}</h2>
    </div>
    @if (Session::has('message') )
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <span>{{ Session::get('message') }}</span>
    </div>
    @endif
    <div class="panel-body">
        @if ( Auth::user()->role->id == 1)
        <a href="{{ url('/licenses/create/'.$company->id) }}" class="btn btn-primary pull-right">Add License</a>
        @endif

        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>User License</th>
                    <th>Created By</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Life</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($licenses as $license)
                <tr>
                    @if( $license->user_id == 0 )
                        <td>Unassigned</td>
                    @else
                        <td><a href="{{ url('/users/'.$license->user_id) }}">{{$license->user->first_name.' '.$license->user->last_name}}</a></td>
                    @endif
                    <td>{{ $company->getAuditUser( $license->created_by )  }}</td>
                    <td>{{ date('Y-m-d',strtotime($license->start_date)) }}</td>
                    <td>{{ date('Y-m-d',strtotime($license->end_date)) }}</td>
                        @if( $license->life ==0 )
                            <td>Lifetime</td>
                        @else
                            @if( $license->life <7 )
                                <td>{{ $license->life.' Months' }}</td>
                            @else
                                @if( $license->life ==7 )
                                    <td>{{ 'One Year' }}</td>
                                @endif
                                @if( $license->life ==8 )
                                    <td>{{ 'Two Years' }}</td>
                                @endif
                                @if( $license->life ==9 )
                                    <td>{{ 'Five Years' }}</td>
                                @endif
                            @endif
                        @endif
                    <td>{{ $license->status }}</td>
                    <td>
                        @if( $license->status == 'INACTIVE' )
                        <a href="{{ url('/licenses/activate/'.$license->id) }}" title="Activate"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a>
                        @else
                        <a href="{{ url('/licenses/destroy/'.$license->id) }}" title="Inactive" onclick="return  confirm('Owners within the Sales Performance Indicator software have the ability to deactivate a user.  Your cancellation will take effect on your next billing date.  Refunds will not be provided for deactivation during a billing cycle.\n\nAre you sure?');"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>
                        @endif
                        @if( $license->user_id != 0 )
                        <a href="{{ url('/licenses/remove/'.$license->id) }}" title="Remove User" onclick="return  confirm('Owners within the Sales Performance Indicator software have the ability to remove a user.  Once you remove a user, we cannot retrieve any data.  Your cancellation will take effect on your next billing date.  Refunds will not be provided for the removed user during a billing cycle.\n\nAre you sure?');"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>
        <div class="col-md-2 col-md-offset-5">
            {!! str_replace('/?', '?', $licenses->render()) !!}
        </div>
    </div>

</div>

@endsection