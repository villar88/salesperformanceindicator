@extends('app')

@section('content')
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2>Manage Users</h2>
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

                function setAction(arg)
                {
                if (arg == "1"){
                document.getElementById("prueba").submit();
                }
                if (arg == "2"){
                document.getElementById("prueba").action = "{{ url('/users/searchByStatus') }}";
                        document.getElementById("prueba").submit();
                }
                }


            </script>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"><h3>Search</h3></div>
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/users/search') }}">
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
                                <span>Please enter Email, First or Last Name of the User.</span>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>


            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h3>Users</h3>
                </div>
                @if (Session::has('message') )
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span>{{ Session::get('message') }}</span>
                </div>
                @endif
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('/users/create') }}" class="btn btn-primary pull-right">Create User</a>
                        </div>
                    </div>
                    <!-- Table -->
                    <form name="prueba" id="prueba" class="form-horizontal" role="form" method="POST" action="{{ url('/users/searchById') }}">
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <input type="hidden" id="request" name="request" value="" />
                        <table class="table table-small hidden-sm hidden-md hidden-lg">
                            <tbody>
                                @foreach ($users as $user)
                                @if ($user->role->id!=1 )
                                <tr>
                                    <td>
                                        <table class="table-small-bordered">
                                            <tr>
                                                <td class="col-xs-5">First Name</td>
                                                <td class="col-xs-7 text-right td-vcenter"><a href="{{ url('/users/'.$user->id) }}">{{$user->first_name}}</a></td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-5">Last Name</td>
                                                <td class="col-xs-7 text-right td-vcenter"><a href="{{ url('/users/'.$user->id) }}">{{$user->last_name}}</a></td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-5">Email</td>
                                                <td class="col-xs-7 text-right td-vcenter">{{$user->getEmailDisp()}}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-5">Phone Number</td>
                                                <td class="col-xs-7 text-right td-vcenter">{{$user->contact_number}}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-5">User Group</td>
                                                <td class="col-xs-7 text-right td-vcenter">{{$user->role->name}}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-5">Company Name
                                                    @if( !empty($companies) )
                                                    {!! Form::select('companies',array('default' => 'All Companies') + \App\Company::where('status','ACTIVE')->orderBy('name')->lists('name', 'id') , $companies, ['class' => 'form-control','onchange' => 'setAction("1");'] ) !!}
                                                    @else
                                                    {!! Form::select('companies',array('default' => 'All Companies') + \App\Company::where('status','ACTIVE')->orderBy('name')->lists('name', 'id') , 'default' , ['class' => 'form-control','onchange' => 'setAction("1");'] ) !!}
                                                    @endif
                                                </td>
                                                <td class="col-xs-7 text-right td-vcenter">{{$user->company->name}}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-5">Status 
                                                    @if( !empty($status) )
                                                    {!! Form::select('status', array('ALL' => 'ALL','ACTIVE' =>'ACTIVE','INACTIVE' =>'INACTIVE','RESET' =>'RESET','NEW' =>'NEW'),$status,['class' => 'form-control','onchange' => 'setAction("2");this.form.submit();']); !!}
                                                    @else
                                                    {!! Form::select('status', array('ALL' => 'ALL','ACTIVE' =>'ACTIVE','INACTIVE' =>'INACTIVE','RESET' =>'RESET','NEW' =>'NEW'),'0',['class' => 'form-control','onchange' => 'setAction("2");this.form.submit();']); !!}
                                                    @endif
                                                </td>
                                                <td class="col-xs-7 text-right td-vcenter">{{$user->status}}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-5">Date Created</td>
                                                <td class="col-xs-7 text-right td-vcenter">{{$user->created_at->format('Y-m-d')}}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-xs-5">Date Updated</td>
                                                <td class="col-xs-7 text-right td-vcenter">{{$user->updated_at->format('Y-m-d')}}</td>
                                            </tr>
                                            <tr>
                                                <td class="icons col-xs-5">Actions</td>
                                                <td class="col-xs-7 text-right td-vcenter">
                                                    @if( $user->status == 'INACTIVE' )
                                                    <a href="{{ url('/users/activate/'.$user->id) }}" title="Active"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a> |
                                                    @else
                                                    <a href="{{ url('/users/destroy/'.$user->id) }}" onclick="return  confirm('Are you sure you want to disable {{$user->last_name}}, {{$user->first_name}}?');" title="Inactive"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a> |
                                                    @endif


                                                    <a href="{{ url('/users/'.$user->id) }}" title="Edit" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> |
                                                    <a href="{{ url('/users/support/'.$user->id) }}" title="Support Standpoint" ><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td class="td-separator">&nbsp;</td></tr>
                                @endif
                                @endforeach

                            </tbody>
                        </table>
                        
                        <table class="table hidden-xs">
                            <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>User Group</th>
                                            <th>Company Name
                                                    @if( !empty($companies) )
                                                    {!! Form::select('companies',array('default' => 'All Companies') + \App\Company::where('status','ACTIVE')->orderBy('name')->lists('name', 'id') , $companies, ['class' => 'form-control','onchange' => 'setAction("1");'] ) !!}
                                                    @else
                                                    {!! Form::select('companies',array('default' => 'All Companies') + \App\Company::where('status','ACTIVE')->orderBy('name')->lists('name', 'id') , 'default' , ['class' => 'form-control','onchange' => 'setAction("1");'] ) !!}
                                                    @endif
                                            </th>
                                            <th>Status 
                                                    @if( !empty($status) )
                                                    {!! Form::select('status', array('ALL' => 'ALL','ACTIVE' =>'ACTIVE','INACTIVE' =>'INACTIVE','RESET' =>'RESET','NEW' =>'NEW'),$status,['class' => 'form-control','onchange' => 'setAction("2");this.form.submit();']); !!}
                                                    @else
                                                    {!! Form::select('status', array('ALL' => 'ALL','ACTIVE' =>'ACTIVE','INACTIVE' =>'INACTIVE','RESET' =>'RESET','NEW' =>'NEW'),'0',['class' => 'form-control','onchange' => 'setAction("2");this.form.submit();']); !!}
                                                    @endif
                                            </th>
                                            <th>Date Created</th>
                                            <th>Date Updated</th>
                                            <th class="icons">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        @if ($user->role->id!=1 )
                                        <tr>
                                    <td><a href="{{ url('/users/'.$user->id) }}">{{$user->first_name}}</a></td>
                                    <td><a href="{{ url('/users/'.$user->id) }}">{{$user->last_name}}</a></td>
                                    <td>{{$user->getEmailDisp()}}</td>
                                    <td>{{$user->contact_number}}</td>
                                    <td>{{$user->role->name}}</td>
                                    <td>{{$user->company->name}}</td>
                                    <td>{{$user->status}}</td>
                                    <td>{{$user->created_at->format('Y-m-d')}}</td>
                                    <td>{{$user->updated_at->format('Y-m-d')}}</td>
                                    <td>
                                        @if( $user->status == 'INACTIVE' )
                                            <a href="{{ url('/users/activate/'.$user->id) }}" title="Active"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a> |
                                        @else
                                            <a href="{{ url('/users/destroy/'.$user->id) }}" onclick="return  confirm('Are you sure you want to disable {{$user->last_name}}, {{$user->first_name}}?');" title="Inactive"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a> |
                                        @endif


                                        <a href="{{ url('/users/'.$user->id) }}" title="Edit" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> |
                                        <a href="{{ url('/users/support/'.$user->id) }}" title="Support Standpoint" ><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
                                    </td>
                                </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                        </table>
                    </form>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            {!! str_replace('/?', '?', $users->render()) !!}
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="col-md-11 "><a href="{{ url('/users/create') }}" class="btn btn-primary">Create User</a></div>
                </div>

            </div>


        </div>
    </div>

@endsection