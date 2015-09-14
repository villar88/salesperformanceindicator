@extends('app')

@section('content')

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h2>Manage Companies</h2>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <script type="text/javascript">

                    function setRequest(arg)
                    {
                        $("#request").val(arg);
                    }


                </script>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><h3>Search</h3></div>
                    <div class="panel-body">
                        <div class="col-md-10 col-md-offset-1">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/companies/search') }}">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <input type="hidden" id="request" name="request" value="" />
                            <fieldset>

                                <div class="input-group">
                                    <input name="keyword" type="text" class="form-control" value="{{ $keyword }}"/>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary" value="Search" onclick="setRequest('search')">Search</button>
                                        <button type="submit" class="btn btn-default" value="Show_All"  onclick="setRequest('showAll')">Show All</button>
                                    </span>
                                </div>
                                <span>Please enter name of Company.</span>

                            </fieldset>
                        </form>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h3>Companies</h3>
                    </div>
                    @if (Session::has('message') )
                        <div class="alert alert-dismissible alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span>{{ Session::get('message') }}</span>
                        </div>
                    @endif
                    <div class="panel-body">
                        <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <a href="{{ url('/companies/create') }}" class="btn btn-primary pull-right">Create Company</a>
                                </div>
                            </div>

                        <!-- Table -->
                        <table class="table table-small hidden-sm hidden-md hidden-lg">
                            <tbody>
                                @foreach ($companies as $company)
                                <tr>
                                    <td>
                                        <table class="table-small-bordered">
                                                <tr>
                                                    <td class="col-xs-5">Name</td>
                                                    <td class="col-xs-7 text-right td-vcenter"><a href="{{ url('/companies/'.$company->id) }}">{{$company->name}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-xs-5">Owner</td>
                                                    <td class="col-xs-7 text-right td-vcenter">{!! $company->getAllSortedOwners( $company->id ) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-xs-5">Total Users</td>
                                                    <td class="col-xs-7 text-right td-vcenter">{!! $company->getUsersCount( $company->id ) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-xs-5">Active Users</td>
                                                    <td class="col-xs-7 text-right td-vcenter">{!! $company->getActiveUsersCount( $company->id ) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-xs-5">Date Created</td>
                                                    <td class="col-xs-7 text-right td-vcenter">{{ $company->created_at->format('Y-m-d') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-xs-5">Date Updated</td>
                                                    <td class="col-xs-7 text-right td-vcenter">{{ $company->updated_at->format('Y-m-d') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-xs-5">Status</td>
                                                    <td class="col-xs-7 text-right td-vcenter">{{ $company->status }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="icons col-xs-5">Actions</td>
                                                    <td class="col-xs-7 text-right td-vcenter">
                                                        <a href="{{ url('/licenses/list/'.$company->id) }}" title="Manage Licenses" ><span class="glyphicon glyphicon-gift" aria-hidden="true"></span></a> 
                                        <a href="{{ url('/companies/'.$company->id) }}" title="Edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> |
                                        @if( $company->status == 'INACTIVE' )
                                            <a href="{{ url('/companies/activate/'.$company->id) }}" title="Activate"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a>
                                        @else
                                            <a href="{{ url('/companies/destroy/'.$company->id) }}" title="Desactivate" onclick="return  confirm('Are you sure you want to disable {{$company->name}}?');"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>
                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                    </td>
                                </tr>
                                <tr><td class="td-separator">&nbsp;</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <table class="table hidden-xs">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>Total Users</th>
                                <th>Active Users</th>
                                <th>Date Created</th>
                                <th>Date Updated</th>
                                <th>Status</th>
                                <th class="icons">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($companies as $company)
                                <tr>
                                    <td><a href="{{ url('/companies/'.$company->id) }}">{{$company->name}}</a></td>
                                    <td>{!! $company->getAllSortedOwners( $company->id ) !!}</td>
                                    <td>{!! $company->getUsersCount( $company->id ) !!}</td>
                                    <td>{!! $company->getActiveUsersCount( $company->id ) !!}</td>
                                    <td>{{ $company->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $company->updated_at->format('Y-m-d') }}</td>
                                    <td>{{ $company->status }}</td>
                                    <td>
                                        <a href="{{ url('/licenses/list/'.$company->id) }}" title="Manage Licenses" ><span class="glyphicon glyphicon-gift" aria-hidden="true"></span></a> 
                                        <a href="{{ url('/companies/'.$company->id) }}" title="Edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> |
                                        @if( $company->status == 'INACTIVE' )
                                            <a href="{{ url('/companies/activate/'.$company->id) }}" title="Activate"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a>
                                        @else
                                            <a href="{{ url('/companies/destroy/'.$company->id) }}" title="Desactivate" onclick="return  confirm('Are you sure you want to disable {{$company->name}}?');"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            <?php echo $companies->render(); ?>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                        <div class="col-md-11"><a href="{{ url('/companies/create') }}" class="btn btn-primary">Create Company</a></div>
                    </div>

                </div>


            </div>
        </div>


@endsection