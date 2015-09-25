@extends('app')

@section('content')

<div class="page-header" id="banner">
    <div class="row">
        <div class="col-md-12">
            <h2>Reports</h2>
        </div>
    </div>
</div>
<script type="text/javascript">

    function setRequest(arg)
    {
        $("#request").val(arg);
    }


</script>
<div class="row">

    <div class="col-md-10 col-md-offset-1">

        @if( !empty($message) )
        <div class="alert alert-dismissible {{ $isErr ? 'alert-danger' : 'alert-success' }}">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {!!$message!!}
        </div>
        @endif

        <ul class="nav nav-tabs">
            <li class="{{ ( $activeTab == 'sales' ) ? 'active' : ''  }}">
                <a href="#users" data-toggle="tab">User Reports</a>
            </li>
            <li class="{{ ( $activeTab == 'other' ) ? 'active' : ''  }}">
                <a href="#other" data-toggle="tab">Other Reports</a>
            </li>
        </ul>
        <br/>
        <div id="myTabContent" class="tab-content">



            <div class="tab-pane fade {{ ( $activeTab == 'users' ) ? 'active in' : ''  }}" id="users">
                <div class="bs-component">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading"><h3>Filters</h3></div>
                        <div class="panel-body">
                            <div class="col-md-10 col-md-offset-1">
                                <form id="form_search" class="form-horizontal" role="form" method="POST" action="{{ url('/reports/search') }}">
                                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                    <input type="hidden" id="request" name="request" value="" />
                                    <fieldset>

                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <h5>Users per organization</h5>
                                                                    {!! Form::radio('user_filter','1',true,['class' => 'radio']) !!}
                                                                    {!! Form::select('companies',array('default' => 'All Companies') + \App\Company::lists('name', 'id') , $companies, ['class' => 'form-control','style'=>'width: 300px'] ) !!}
                                                                    <hr>
                                                                    {!! Form::select('status', array('ALL' => 'ALL','ACTIVE' =>'ACTIVE','INACTIVE' =>'INACTIVE'),'ALL',['class' => 'form-control','style'=>'width: 300px']); !!}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <h5>Users by Activation/Cancellation Date</h5>
                                                                    {!! Form::radio('user_filter','2',false,['class' => 'radio']) !!}
                                                                    {!! Form::select('status_date', array('ALL' => 'ALL','ACTIVATION' =>'ACTIVATION','CANCELLATION' =>'CANCELLATION'),$status,['class' => 'form-control','style'=>'width: 300px']) !!}
                                                                    <hr>
                                                                    <div class='input-group date' id='datetimepicker1' style="width: 280px;">
                                                                        <input type='text' class="form-control" style="width: 260px;" name="from_date" id="from_date" placeholder="FROM DATE"  />
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-calendar" ></span>
                                                                        </span>
                                                                    </div>

                                                                    <div class='input-group date' id='datetimepicker2' style="width: 280px;">
                                                                        <input type='text' class="form-control" style="width: 260px;" name="to_date" id="to_date" placeholder="TO DATE" />
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-calendar" ></span>
                                                                        </span>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <script>
                                                        function tal(event) {
                                                            $('#datetimepicker1').datetimepicker({
                                                                format: 'YYYY-MM-DD'
                                                            });

                                                            $('#datetimepicker2').datetimepicker({
                                                                format: 'YYYY-MM-DD'
                                                            });
                                                            $('#from_date').keypress(function (event) {
                                                                event.preventDefault();
                                                            });
                                                            $('#to_date').keypress(function (event) {
                                                                event.preventDefault();
                                                            });
                                                            function validateDates()
                                                            {
                                                                var from_date = $.trim($('#from_date').val());
                                                                var to_date = $.trim($('#to_date').val());
                                                                if (from_date === '') {
                                                                    alert('FROM DATE is empty.');
                                                                    return false;
                                                                }

                                                                if (to_date === '') {
                                                                    alert('TO DATE is empty.');
                                                                    return false;
                                                                }
                                                                return true;
                                                            }
                                                            $('#form_search').submit(function () {
                                                                if ($('input:radio[name=user_filter]:checked').val() == 2) {
                                                                    if ($('select[name=status_date]').val() == "ACTIVATION") {
                                                                        return validateDates();
                                                                    }
                                                                    if ($('select[name=status_date]').val() == "CANCELLATION") {
                                                                        return validateDates();
                                                                    }
                                                                    if ($('select[name=status_date]').val() == "ALL") {
                                                                        return true;
                                                                    }
                                                                }

                                                            });
                                                        }
                                                        if (document.addEventListener) {
                                                            document.addEventListener("DOMContentLoaded", tal);

                                                        } else if (document.attachEvent) {
                                                            document.attachEvent('DOMContentLoaded', tal);
                                                        }
                                                    </script>
                                                </div>
                                                <button type="submit" class="btn btn-primary" value="Search" onclick="setRequest('search')">Search</button>
                                                <button type="submit" class="btn btn-default" value="Show_All"  onclick="setRequest('showAll')">Show All</button>
                                            </span>
                                        </div>

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
                        <div class="panel-body">

                            <!-- Table -->
                            <form name="prueba" id="prueba" class="form-horizontal" role="form" method="POST" action="{{ url('/reports/search') }}">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <input type="hidden" id="request" name="request" value="" />
                                <table class="table table-small hidden-sm hidden-md hidden-lg">
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <table class="table-small-bordered">
                                                    <tr>
                                                        <td class="col-xs-5">First Name</td>
                                                        <td class="col-xs-7 text-right td-vcenter">{{$user->first_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-xs-5">Last Name</td>
                                                        <td class="col-xs-7 text-right td-vcenter">{{$user->last_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-xs-5">Email</td>
                                                        <td class="col-xs-7 text-right td-vcenter">{{$user->getEmailDisp()}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-xs-5">User Group</td>
                                                        <td class="col-xs-7 text-right td-vcenter">{{$user->role->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-xs-5">Company Name</td>
                                                        <td class="col-xs-7 text-right td-vcenter">{{$user->company->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-xs-5">Status</td>
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
                                                        <td class="col-xs-5">Date Actived</td>
                                                        <td class="col-xs-7 text-right td-vcenter">{{date('Y-m-d',strtotime($user->active_date)) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-xs-5">Date Cancelled</td>
                                                        <td class="col-xs-7 text-right td-vcenter">{{date('Y-m-d',strtotime($user->inactive_date)) }}</td>
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
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>User Group</th>
                                            <th>Company Name</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>Date Updated</th>
                                            <th>Date Actived</th>
                                            <th>Date Cancelled</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->first_name}}</td>
                                            <td>{{$user->last_name}}</td>
                                            <td>{{$user->getEmailDisp()}}</td>
                                            <td>{{$user->role->name}}</td>
                                            <td>{{$user->company->name}}</td>
                                            <td>{{$user->status}}</td>
                                            <td>{{$user->created_at->format('Y-m-d')}}</td>
                                            <td>{{$user->updated_at->format('Y-m-d')}}</td>
                                            <td>{{date('Y-m-d',strtotime($user->active_date)) }}</td>
                                            <td>{{date('Y-m-d',strtotime($user->inactive_date)) }}</td>
                                        </tr>
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
                            <div class="col-md-11 "><button type="submit" class="btn btn-primary" value="Search">Exportar</button></div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="tab-pane fade {{ ( $activeTab == 'other' ) ? 'active in' : ''  }}" id="other">
                <div class="row ">
                </div>
            </div>

        </div>
    </div>
</div>

@endsection