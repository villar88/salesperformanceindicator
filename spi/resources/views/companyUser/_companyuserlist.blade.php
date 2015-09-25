<?php
#    Output easy-to-read numbers
#    by james at bandit.co.nz

function find_max($n){
    // is this a number?
    if ($n<=700){
        return 700;
    }
    else{
        if ($n<=1000){
            return 1000;
        }else{
            if ($n<=1200){
                return 1200;
            }else{
                if ($n<=1200){
                    return 1200;
                }else{
                    if ($n<=1500){
                        return 1500;
                    }else{
                        if ($n<=2000){
                            return 2000;
                        }else{
                            if ($n<=2500){
                                return 2500;
                            }else{
                                if ($n<=3000){
                                    return 3000;
                                }else{
                                    if ($n<=4000){
                                        return 4000;
                                    }else{
                                        if ($n<=5000){
                                            return 5000;
                                        }else{
                                            if ($n<=7000){
                                                return 7000;
                                            }else{
                                                if ($n<=10000){
                                                    return 10000;
                                                }else{
                                                    if ($n<=15000){
                                                        return 15000;
                                                    }else{
                                                        if ($n<=20000){
                                                            return 20000;
                                                        }else{
                                                            if ($n<=30000){
                                                                return 30000;
                                                            }else{
                                                                if ($n<=50000){
                                                                    return 50000;
                                                                }else{
                                                                    if ($n<=100000){
                                                                        return 100000;
                                                                    }else{
                                                                        if ($n<=200000){
                                                                            return 200000;
                                                                        }else{
                                                                            if ($n<=300000){
                                                                                return 300000;
                                                                            }else{
                                                                                if ($n<=400000){
                                                                                    return 400000;
                                                                                }else{
                                                                                    if ($n<=500000){
                                                                                        return 500000;
                                                                                    }else{
                                                                                        if ($n<=1000000){
                                                                                            return 1000000;
                                                                                        }else{
                                                                                            if ($n<=1500000){
                                                                                                return 1500000;
                                                                                            }else{
                                                                                                if ($n<=2000000){
                                                                                                    return 2000000;
                                                                                                }else{
                                                                                                    if ($n<=2500000){
                                                                                                        return 2500000;
                                                                                                    }else{
                                                                                                        if ($n<=3000000){
                                                                                                            return 3000000;
                                                                                                        }else{
                                                                                                            if ($n<=4000000){
                                                                                                                return 4000000;
                                                                                                            }else{
                                                                                                                if ($n<=5000000){
                                                                                                                    return 5000000;
                                                                                                                }else{
                                                                                                                    if ($n<=7000000){
                                                                                                                        return 7000000;
                                                                                                                    }else{
                                                                                                                        if ($n<=10000000){
                                                                                                                            return 10000000;
                                                                                                                        }else{
                                                                                                                            if ($n<=15000000){
                                                                                                                                return 15000000;
                                                                                                                            }else{
                                                                                                                                if ($n<=20000000){
                                                                                                                                    return 20000000;
                                                                                                                                }else{
                                                                                                                                    if ($n<=30000000){
                                                                                                                                        return 30000000;
                                                                                                                                    }else{
                                                                                                                                        if ($n<=50000000){
                                                                                                                                            return 50000000;
                                                                                                                                        }else{
                                                                                                                                            if ($n<=100000000){
                                                                                                                                                return 100000000;
                                                                                                                                            }else{
                                                                                                                                                return 500000000;
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
?>
<div class="row">
    <ul class="nav nav-tabs">
        <li class="{{ ( $activeTab == 'user' ) ? 'active' : ''  }}">
            <a href="#users" data-toggle="tab">Users</a>
        </li>
        <li class="{{ ( $activeTab == 'report' ) ? 'active' : ''  }}">
            <a href="#reports" data-toggle="tab">Management Reports</a>
        </li>
    </ul>
    <br/>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade {{ ( $activeTab == 'users' ) ? 'active in' : ''  }}" id="users">
            <div class="bs-component">
                <script type="text/javascript">

                    function setRequest(arg)
                    {
                        $("#request").val(arg);
                    }
                </script>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><form id="form_search" class="form-horizontal" role="form" method="POST" action="{{ url('/companyUsers/search') }}">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <input type="hidden" id="request" name="request" value="" />
                            <fieldset>
                                <div class="input-group">
                                    <input name="keyword" type="text" class="form-control" value="{{ $keyword }}" placeholder="Please enter Email, First or Last Name of the User"/>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary" value="Search" onclick="setRequest('search')"><span class="glyphicon glyphicon-search"></span></button>
                                        <button type="submit" class="btn btn-default" value="Show_All"  onclick="setRequest('showAll')">Show All</button>
                                    </span>
                                </div>

                            </fieldset>
                        </form></div>
                    
                </div>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h3>Users</h3>
                    </div>
                    <!--...@include('_message')-->
                    @if (Session::has('message') )
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <span>{{ Session::get('message') }}</span>
                    </div>
                    @endif
                    <div class="panel-body">


                        @if( \Illuminate\Support\Facades\Auth::user()->role_id == 4 || \Illuminate\Support\Facades\Auth::user()->role_id == 3 )
                        @if(DB::table('licenses')->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id)->where('status','ACTIVE')->where('user_id',0)->count()>0)
                        <a href="{{ url('/companyUsers/create') }}" class="btn btn-primary pull-right">Add User</a>
                        @else
                        @if( \Illuminate\Support\Facades\Auth::user()->role_id == 4 )
                        <a href="{{ url('/companyUsers/test') }}" class="btn btn-primary pull-right">Purchase Licenses</a>
                        @endif
                        @endif
                        @endif  


                        <!-- Table -->
                        <table class="table table-condensed" style="border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr data-toggle="collapse" data-target="#demo{{$user->id}}" class="accordion-toggle">
                                    <td>{{strtoupper($user->first_name.' '.$user->last_name)}}</td>
                                    <td style="text-align: right;">
                                        <a title="View Details"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a> |
                                        @if( \Illuminate\Support\Facades\Auth::user()->role_id == 4)
                                        @if( $user->status == 'INACTIVE' )
                                        <a href="{{ url('/companyUsers/activate/'.$user->id) }}" title="Active"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a> |
                                        @else
                                        <a href="{{ url('/companyUsers/destroy/'.$user->id) }}" onclick="return  confirm('Owners within the Sales Performance Indicator software have the ability to deactivate a user.  Your cancellation will take effect on your next billing date.  Refunds will not be provided for deactivation during a billing cycle.\n\nAre you sure?');" title="Inactive"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a> |
                                        @endif
                                        @endif
                                        <a href="{{ url('/companyUsers/'.$user->id) }}" title="Edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> |
                                        <a href="{{ url('/companyUsers/reset/'.$user->id) }}" onclick="return  confirm('Are you sure want to clean all data for the user {{$user->last_name}}, {{$user->first_name}}?');" title="Reset" ><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span></a> |
                                        <a href="{{ url('/companyUsers/sendEmail/'.$user->id) }}" onclick="return  confirm(' Do you want to send the username and password to {{$user->last_name}}, {{$user->first_name}} ?');" title="Send Username and Password" ><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo{{$user->id}}"> 
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 600px;"></th>
                                                        <th style="width: 100px;"></th>
                                                        <th style="width: 700px;"></th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <tr>
                                                        <th style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-7 col-sm-6">
                                                        <h4>{{strtoupper($user->first_name.' '.$user->last_name)}} POINTS</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Points Daily</h4>
                                                                    <div id="pointDaily{{$user->id}}" style="min-width: 500px; height: 350px;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Points Monthly</h4>
                                                                    <div id="pointMonthly{{$user->id}}" style="min-width: 500px; height: 350px;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Direct hire production | Sales Monthly</h4>
                                                                    <div id="directHire{{$user->id}}" style="min-width: 500px; height: 350px;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Direct hire production | Sales Annually</h4>
                                                                    <div id="directHireAnnual{{$user->id}}" style="min-width: 500px; height: 350px;" ></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Temp or contract gross margin of profit (GMP) Monthly</h4>
                                                                    <div id="tempGMP{{$user->id}}" style="min-width: 500px; height: 350px;" ></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Temp or contract gross margin of profit (GMP) Annual</h4>
                                                                    <div id="gmpAnnual{{$user->id}}" style="min-width: 500px; height: 350px;" ></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </th>
                                                <th></th>
                                                <th style="text-align: right;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-7 col-sm-6">
                                                        <h4 style="text-align: left;margin-bottom: 40px;"></h4>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Todays Points</th>
                                                                        <th>Avg Points Per Day</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="text-align: center !important;">{{empty( $today_total[$user->cont]->total ) ? 0 : $today_total[$user->cont]->total}}</td>
                                                                        <td style="text-align: center !important;">{{empty( $avg[$user->cont] ) ? 0 : $avg[$user->cont]}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <h4 style="text-align: left;">Recruiting </h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 800px;"></th>
                                                                        <th>Today's Ratio</th>
                                                                        <th>Ongoing Ratio</th
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Recruiting Presentation to Recruiting Hit</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_1 }} / {{ $recruiting[$user->cont]->recruit_2 }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_3 }} / {{ $recruiting[$user->cont]->recruit_4 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Recruiting Hit to Candidate Interviews</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_5 }} / {{ $recruiting[$user->cont]->recruit_6 }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_7 }} / {{ $recruiting[$user->cont]->recruit_8 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Recruiting Hit to Interview Reactivated Candidate</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_9 }} / {{ $recruiting[$user->cont]->recruit_10 }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_11 }} / {{ $recruiting[$user->cont]->recruit_12 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Interviewed Candidate to Send Out</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_13 }} / {{ $recruiting[$user->cont]->recruit_14 }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_15 }} / {{ $recruiting[$user->cont]->recruit_16 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Interview Reactivated Candidate to Send Out</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_17 }} / {{ $recruiting[$user->cont]->recruit_18  }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_19 }} / {{ $recruiting[$user->cont]->recruit_20  }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sent Out to Fill or Placement</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_21 }} / {{ $recruiting[$user->cont]->recruit_22 }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruiting[$user->cont]->recruit_23 }} / {{ $recruiting[$user->cont]->recruit_24 }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <h4 style="text-align: left;">Client Development - Inside  </h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 800px;"></th>
                                                                        <th>Today's Ratio</th>
                                                                        <th>Ongoing Ratio</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Marketing Call to Job Order, Contract or Temp Assignment</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_1 }} / {{ $clientDev[$user->cont]->clientDev_2 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_3 }} / {{ $clientDev[$user->cont]->clientDev_4 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>MPC Presentation to Job Order, Contract or Temp Assignment</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_5 }} / {{ $clientDev[$user->cont]->clientDev_6 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_7 }} / {{ $clientDev[$user->cont]->clientDev_8 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Job Order, Contract or Temp Assignment to Fill or Placement by Self</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_9 }} / {{ $clientDev[$user->cont]->clientDev_10 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_11 }} / {{ $clientDev[$user->cont]->clientDev_12 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Job Order, Contract or Temp Assignment to Fill or Placement by Others</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_13 }} / {{ $clientDev[$user->cont]->clientDev_14 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_15 }} / {{ $clientDev[$user->cont]->clientDev_16}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Submittal to Send Out</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_17 }} / {{ $clientDev[$user->cont]->clientDev_18 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_19 }} / {{ $clientDev[$user->cont]->clientDev_20 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Send Out to Fill or Placement by Self</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_21 }} / {{ $clientDev[$user->cont]->clientDev_22 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_23 }} / {{ $clientDev[$user->cont]->clientDev_24 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sent Out to Fill or Placement by Others</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_25 }} / {{ $clientDev[$user->cont]->clientDev_26 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDev[$user->cont]->clientDev_27 }} / {{ $clientDev[$user->cont]->clientDev_28 }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <h4 style="text-align: left;">Client Development - Outside  </h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 800px;"></th>
                                                                        <th>Today's Ratio</th>
                                                                        <th>Ongoing Ratio</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Complete Face-to-Face Appointment to Job Order, Contract or Temp Assignment</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_1}} / {{$clientDevOut[$user->cont]->clientDevOut_2 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_3}} / {{$clientDevOut[$user->cont]->clientDevOut_4 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Marketing Call to Job Order, Contract or Temp Assignment</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_5}} / {{$clientDevOut[$user->cont]->clientDevOut_6 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_7}} / {{$clientDevOut[$user->cont]->clientDevOut_8 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>MPC Presentation to Job Order, Contract or Temp Assignment</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_9}} / {{$clientDevOut[$user->cont]->clientDevOut_10 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_11}} / {{$clientDevOut[$user->cont]->clientDevOut_12 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Job Order, Contract or Temp Assignment to Fill or Placement by Self</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_13}} / {{$clientDevOut[$user->cont]->clientDevOut_14 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_15}} / {{$clientDevOut[$user->cont]->clientDevOut_16 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Job Order, Contract or Temp Assignment to Fill or Placement by Others</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_17}} / {{$clientDevOut[$user->cont]->clientDevOut_18 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_19}} / {{$clientDevOut[$user->cont]->clientDevOut_20 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sent Out to Fill or Placement by Others</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_21}} / {{$clientDevOut[$user->cont]->clientDevOut_22 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOut[$user->cont]->clientDevOut_23}} / {{$clientDevOut[$user->cont]->clientDevOut_24 }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                </th>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div> </td>
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
            </div>
        </div>
        <div class="tab-pane fade {{ ( $activeTab == 'report' ) ? 'active in' : ''  }}" id="reports">
                <div class="row ">
                    <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 600px;"></th>
                                                        <th style="width: 100px;"></th>
                                                        <th style="width: 700px;"></th>
                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <tr>
                                                        <th style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-7 col-sm-6">
                                                        <h4><b>All USERS POINTS</b></h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Points Daily</h4>
                                                                    <div id="pointDailyAll" style="min-width: 500px; height: 350px;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Points Monthly</h4>
                                                                    <div id="pointMonthlyAll" style="min-width: 500px; height: 350px;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Direct hire production | Sales Monthly</h4>
                                                                    <div id="directHireAll" style="min-width: 500px; height: 350px;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Direct hire production | Sales Annually</h4>
                                                                    <div id="directHireAnnualAll" style="min-width: 500px; height: 350px;" ></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Temp or contract gross margin of profit (GMP) Monthly</h4>
                                                                    <div id="tempGMPAll" style="min-width: 500px; height: 350px;" ></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="panel panel-default" style="width: 580px;">
                                                            <div class="panel-body">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <h4>Temp or contract gross margin of profit (GMP) Annual</h4>
                                                                    <div id="gmpAnnualAll" style="min-width: 500px; height: 350px;" ></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </th>
                                                <th></th>
                                                <th style="text-align: right;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-7 col-sm-6">
                                                        <h4 style="text-align: left;margin-bottom: 40px;"></h4>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Todays Points</th>
                                                                        <th>Avg Points Per Day</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="text-align: center !important;">{{empty( $todayTotalAll->total ) ? 0 : $todayTotalAll->total}}</td>
                                                                        <td style="text-align: center !important;">{{empty( $avgAll ) ? 0 : $avgAll}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <h4 style="text-align: left;">Recruiting </h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 800px;"></th>
                                                                        <th>Today's Ratio</th>
                                                                        <th>Ongoing Ratio</th
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Recruiting Presentation to Recruiting Hit</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_1 }} / {{ $recruitingAll->recruit_2 }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_3 }} / {{ $recruitingAll->recruit_4 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Recruiting Hit to Candidate Interviews</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_5 }} / {{ $recruitingAll->recruit_6 }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_7 }} / {{ $recruitingAll->recruit_8 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Recruiting Hit to Interview Reactivated Candidate</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_9 }} / {{ $recruitingAll->recruit_10 }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_11 }} / {{ $recruitingAll->recruit_12 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Interviewed Candidate to Send Out</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_13 }} / {{ $recruitingAll->recruit_14 }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_15 }} / {{ $recruitingAll->recruit_16 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Interview Reactivated Candidate to Send Out</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_17 }} / {{ $recruitingAll->recruit_18  }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_19 }} / {{ $recruitingAll->recruit_20  }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sent Out to Fill or Placement</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_21 }} / {{ $recruitingAll->recruit_22 }}</td>
                                                                        <td style="text-align: center !important;">{{ $recruitingAll->recruit_23 }} / {{ $recruitingAll->recruit_24 }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <h4 style="text-align: left;">Client Development - Inside  </h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 800px;"></th>
                                                                        <th>Today's Ratio</th>
                                                                        <th>Ongoing Ratio</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Marketing Call to Job Order, Contract or Temp Assignment</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_1 }} / {{ $clientDevAll->clientDev_2 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_3 }} / {{ $clientDevAll->clientDev_4 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>MPC Presentation to Job Order, Contract or Temp Assignment</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_5 }} / {{ $clientDevAll->clientDev_6 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_7 }} / {{ $clientDevAll->clientDev_8 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Job Order, Contract or Temp Assignment to Fill or Placement by Self</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_9 }} / {{ $clientDevAll->clientDev_10 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_11 }} / {{ $clientDevAll->clientDev_12 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Job Order, Contract or Temp Assignment to Fill or Placement by Others</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_13 }} / {{ $clientDevAll->clientDev_14 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_15 }} / {{ $clientDevAll->clientDev_16}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Submittal to Send Out</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_17 }} / {{ $clientDevAll->clientDev_18 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_19 }} / {{ $clientDevAll->clientDev_20 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Send Out to Fill or Placement by Self</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_21 }} / {{ $clientDevAll->clientDev_22 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_23 }} / {{ $clientDevAll->clientDev_24 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sent Out to Fill or Placement by Others</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_25 }} / {{ $clientDevAll->clientDev_26 }}</td>
                                                                        <td style="text-align: center !important;">{{ $clientDevAll->clientDev_27 }} / {{ $clientDevAll->clientDev_28 }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="col-md-10 col-md-offset-1">
                                                            <h4 style="text-align: left;">Client Development - Outside  </h4>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 800px;"></th>
                                                                        <th>Today's Ratio</th>
                                                                        <th>Ongoing Ratio</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Complete Face-to-Face Appointment to Job Order, Contract or Temp Assignment</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_1}} / {{$clientDevOutAll->clientDevOut_2 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_3}} / {{$clientDevOutAll->clientDevOut_4 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Marketing Call to Job Order, Contract or Temp Assignment</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_5}} / {{$clientDevOutAll->clientDevOut_6 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_7}} / {{$clientDevOutAll->clientDevOut_8 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>MPC Presentation to Job Order, Contract or Temp Assignment</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_9}} / {{$clientDevOutAll->clientDevOut_10 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_11}} / {{$clientDevOutAll->clientDevOut_12 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Job Order, Contract or Temp Assignment to Fill or Placement by Self</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_13}} / {{$clientDevOutAll->clientDevOut_14 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_15}} / {{$clientDevOutAll->clientDevOut_16 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Job Order, Contract or Temp Assignment to Fill or Placement by Others</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_17}} / {{$clientDevOutAll->clientDevOut_18 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_19}} / {{$clientDevOutAll->clientDevOut_20 }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sent Out to Fill or Placement by Others</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_21}} / {{$clientDevOutAll->clientDevOut_22 }}</td>
                                                                        <td style="text-align: center !important;">{{$clientDevOutAll->clientDevOut_23}} / {{$clientDevOutAll->clientDevOut_24 }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                </th>
                                                </tr>
                                                </tbody>
                                            </table>
                </div>
            </div>
    </div>
</div>
<?php foreach ($users as $user) { ?>
    @if( isset($directHireTarget[$user->cont]) )

    <table id="pointDailydatatable{{ $user->id }}" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Mon</th>
                <td>{{ 140 }}</td>
                <td>{{ (!array_key_exists ( 'Monday', $pointDaily[$user->cont] )) ? 0 : $pointDaily[$user->cont]['Monday']  }}</td>
            </tr>
            <tr>
                <th>Tue</th>
                <td>{{ 140 }}</td>
                <td>{{ (!array_key_exists ( 'Tuesday', $pointDaily[$user->cont] )) ? 0 : $pointDaily[$user->cont]['Tuesday']  }}</td>
            </tr>
            <tr>
                <th>Wed</th>
                <td>{{ 140 }}</td>
                <td>{{ (!array_key_exists ( 'Wednesday', $pointDaily[$user->cont] )) ? 0 : $pointDaily[$user->cont]['Wednesday']  }}</td>
            </tr>
            <tr>
                <th>Thu</th>
                <td>{{ 140 }}</td>
                <td>{{ (!array_key_exists ( 'Thursday', $pointDaily[$user->cont] )) ? 0 : $pointDaily[$user->cont]['Thursday']  }}</td>
            </tr>
            <tr>
                <th>Fri</th>
                <td>{{ 140 }}</td>
                <td>{{ (!array_key_exists ( 'Friday', $pointDaily[$user->cont] )) ? 0 : $pointDaily[$user->cont]['Friday']  }}</td>
            </tr>
            <tr>
                <th>weekly</th>
                <td>{{ 140*5 }}</td>
                <td>{{ empty( $pointDaily[$user->cont]['weekly'] ) ? 0 : $pointDaily[$user->cont]['weekly']  }}</td>
            </tr>
        </tbody>
    </table>


    <table id="pointMonthlydatatable{{ $user->id }}" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Jan</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'jan', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['jan']  }}</td>
            </tr>
            <tr>
                <th>Feb</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'feb', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['feb']  }}</td>
            </tr>
            <tr>
                <th>Mar</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'mar', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['mar']  }}</td>
            </tr>
            <tr>
                <th>Apr</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'apr', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['apr']  }}</td>
            </tr>
            <tr>
                <th>May</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'may', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['may']  }}</td>
            </tr>
            <tr>
                <th>Jun</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'jun', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['jun']  }}</td>
            </tr>
            <tr>
                <th>Jul</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'jul', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['jul']  }}</td>
            </tr>
            <tr>
                <th>Aug</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'aug', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['aug']  }}</td>
            </tr>
            <tr>
                <th>Sep</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'sep', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['sep']  }}</td>
            </tr>
            <tr>
                <th>Oct</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'oct', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['oct']  }}</td>
            </tr>
            <tr>
                <th>Nov</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'nov', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['nov']  }}</td>
            </tr>
            <tr>
                <th>Dec</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'dec', $pointMonthly[$user->cont] )) ? 0 : $pointMonthly[$user->cont]['dec']  }}</td>
            </tr>
            <tr>
                <th>Annual</th>
                <td>{{ 140*20*12 }}</td>
                <td>{{ empty( $pointMonthly[$user->cont]['annual'] ) ? 0 : $pointMonthly[$user->cont]['annual']  }}</td>
            </tr>
        </tbody>
    </table>

    <table id="directHiredatatable{{ $user->id }}" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Jan</th>
                <td>{{ $directHireTarget[$user->cont]->jan }}</td>
                <td>{{ empty( $directHire[$user->cont]['jan'] ) ? 0 : $directHire[$user->cont]['jan']  }}</td>
            </tr>
            <tr>
                <th>Feb</th>
                <td>{{ $directHireTarget[$user->cont]->feb }}</td>
                <td>{{ empty( $directHire[$user->cont]['feb'] ) ? 0 : $directHire[$user->cont]['feb']  }}</td>
            </tr>
            <tr>
                <th>Mar</th>
                <td>{{ $directHireTarget[$user->cont]->mar }}</td>
                <td>{{ empty( $directHire[$user->cont]['mar'] ) ? 0 : $directHire[$user->cont]['mar']  }}</td>
            </tr>
            <tr>
                <th>Apr</th>
                <td>{{ $directHireTarget[$user->cont]->apr }}</td>
                <td>{{ empty( $directHire[$user->cont]['apr'] ) ? 0 : $directHire[$user->cont]['apr']  }}</td>
            </tr>
            <tr>
                <th>May</th>
                <td>{{ $directHireTarget[$user->cont]->may }}</td>
                <td>{{ empty( $directHire[$user->cont]['may'] ) ? 0 : $directHire[$user->cont]['may']  }}</td>
            </tr>
            <tr>
                <th>Jun</th>
                <td>{{ $directHireTarget[$user->cont]->jun }}</td>
                <td>{{ empty( $directHire[$user->cont]['jun'] ) ? 0 : $directHire[$user->cont]['jun']  }}</td>
            </tr>
            <tr>
                <th>Jul</th>
                <td>{{ $directHireTarget[$user->cont]->jul }}</td>
                <td>{{ empty( $directHire[$user->cont]['jul'] ) ? 0 : $directHire[$user->cont]['jul']  }}</td>
            </tr>
            <tr>
                <th>Aug</th>
                <td>{{ $directHireTarget[$user->cont]->aug }}</td>
                <td>{{ empty( $directHire[$user->cont]['aug'] ) ? 0 : $directHire[$user->cont]['aug']  }}</td>
            </tr>
            <tr>
                <th>Sep</th>
                <td>{{ $directHireTarget[$user->cont]->sep }}</td>
                <td>{{ empty( $directHire[$user->cont]['sep'] ) ? 0 : $directHire[$user->cont]['sep']  }}</td>
            </tr>
            <tr>
                <th>Oct</th>
                <td>{{ $directHireTarget[$user->cont]->oct }}</td>
                <td>{{ empty( $directHire[$user->cont]['oct'] ) ? 0 : $directHire[$user->cont]['oct']  }}</td>
            </tr>
            <tr>
                <th>Nov</th>
                <td>{{ $directHireTarget[$user->cont]->nov }}</td>
                <td>{{ empty( $directHire[$user->cont]['nov'] ) ? 0 : $directHire[$user->cont]['nov']  }}</td>
            </tr>
            <tr>
                <th>Dec</th>
                <td>{{ $directHireTarget[$user->cont]->dec }}</td>
                <td>{{ empty( $directHire[$user->cont]['dec'] ) ? 0 : $directHire[$user->cont]['dec']  }}</td>
            </tr>
            <tr>
                <th>Annual</th>
                <td>{{ $directHireTarget[$user->cont]->annual }}</td>
                <td>{{ empty( $directHire[$user->cont]['annual'] ) ? 0 : $directHire[$user->cont]['annual']  }}</td>
            </tr>
        </tbody>
    </table>


    <table id="directHireAnnualdatatable{{ $user->id }}" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $thisYear = date('Y');

            for ($i = $thisYear; $i < $thisYear + 11; $i++) {
                ?>
                <tr>
                    <th><?php echo $i . '_'; ?></th>
                    <td><?php echo '' . ( empty($directHireAnnual[$user->cont][$i]) ? ( $thisYear == $i ? $directHireTarget[0]->annual : 0 ) : $directHireTarget[$user->cont]->annual ); ?></td>
                    <td><?php echo '' . ( empty($directHireAnnual[$user->cont][$i]) ? 0.0 : $directHireAnnual[$user->cont][$i] ); ?></td>
                </tr>
                <?php
            }
            ?>

        </tbody>
    </table> 

    <table id="tempGMPdatatable{{ $user->id }}" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Jan</th>
                <td>{{ $directHireTarget[$user->cont]->jan }}</td>
                <td>{{ empty( $gmp[$user->cont]['jan'] ) ? 0 : $gmp[$user->cont]['jan']  }}</td>
            </tr>
            <tr>
                <th>Feb</th>
                <td>{{ $directHireTarget[$user->cont]->feb }}</td>
                <td>{{ empty( $gmp[$user->cont]['feb'] ) ? 0 : $gmp[$user->cont]['feb']  }}</td>
            </tr>
            <tr>
                <th>Mar</th>
                <td>{{ $directHireTarget[$user->cont]->mar }}</td>
                <td>{{ empty( $gmp[$user->cont]['mar'] ) ? 0 : $gmp[$user->cont]['mar']  }}</td>
            </tr>
            <tr>
                <th>Apr</th>
                <td>{{ $directHireTarget[$user->cont]->apr }}</td>
                <td>{{ empty( $gmp[$user->cont]['apr'] ) ? 0 : $gmp[$user->cont]['apr']  }}</td>
            </tr>
            <tr>
                <th>May</th>
                <td>{{ $directHireTarget[$user->cont]->may }}</td>
                <td>{{ empty( $gmp[$user->cont]['may'] ) ? 0 : $gmp[$user->cont]['may']  }}</td>
            </tr>
            <tr>
                <th>Jun</th>
                <td>{{ $directHireTarget[$user->cont]->jun }}</td>
                <td>{{ empty( $gmp[$user->cont]['jun'] ) ? 0 : $gmp[$user->cont]['jun']  }}</td>
            </tr>
            <tr>
                <th>Jul</th>
                <td>{{ $directHireTarget[$user->cont]->jul }}</td>
                <td>{{ empty( $gmp[$user->cont]['jul'] ) ? 0 : $gmp[$user->cont]['jul']  }}</td>
            </tr>
            <tr>
                <th>Aug</th>
                <td>{{ $directHireTarget[$user->cont]->aug }}</td>
                <td>{{ empty( $gmp[$user->cont]['aug'] ) ? 0 : $gmp[$user->cont]['aug']  }}</td>
            </tr>
            <tr>
                <th>Sep</th>
                <td>{{ $directHireTarget[$user->cont]->sep }}</td>
                <td>{{ empty( $gmp[$user->cont]['sep'] ) ? 0 : $gmp[$user->cont]['sep']  }}</td>
            </tr>
            <tr>
                <th>Oct</th>
                <td>{{ $directHireTarget[$user->cont]->oct }}</td>
                <td>{{ empty( $gmp[$user->cont]['oct'] ) ? 0 : $gmp[$user->cont]['oct']  }}</td>
            </tr>
            <tr>
                <th>Nov</th>
                <td>{{ $directHireTarget[$user->cont]->nov }}</td>
                <td>{{ empty( $gmp[$user->cont]['nov'] ) ? 0 : $gmp[$user->cont]['nov']  }}</td>
            </tr>
            <tr>
                <th>Dec</th>
                <td>{{ $directHireTarget[$user->cont]->dec }}</td>
                <td>{{ empty( $gmp[$user->cont]['dec'] ) ? 0 : $gmp[$user->cont]['dec']  }}</td>
            </tr>
            <tr>
                <th>Annual</th>
                <td>{{ $directHireTarget[$user->cont]->annual }}</td>
                <td>{{ empty( $gmp[$user->cont]['annual'] ) ? 0 : $gmp[$user->cont]['annual']  }}</td>
            </tr>
        </tbody>
    </table>

    <table id="gmpAnnualdatatable{{ $user->id }}" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $thisYear = date('Y');

            for ($i = $thisYear; $i < $thisYear + 11; $i++) {
                ?>
                <tr>
                    <th><?php echo $i . '_'; ?></th>
                    <td><?php echo '' . ( empty($gmpAnnual[$user->cont][$i]) ? ( $thisYear == $i ? $directHireTarget[$user->cont]->annual : 0 ) : $directHireTarget[$user->cont]->annual ); ?></td>
                    <td><?php echo '' . ( empty($gmpAnnual[$user->cont][$i]) ? 0.0 : $gmpAnnual[$user->cont][$i] ); ?></td>
                </tr>
                <?php
            }
            ?>

        </tbody>
    </table> 
    @endif
<?php } 
// LISTA PARA LAS TABLAS DE TODOS LOS USUARIOS
?>
@if( isset($directHireTargetAll) )
<table id="pointDailyAlldatatable" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Mon</th>
                <td>{{ 140 }}</td>
                <td>{{ (!array_key_exists ( 'Monday', $pointDailyAll )) ? 0 : $pointDailyAll['Monday']  }}</td>
            </tr>
            <tr>
                <th>Tue</th>
                <td>{{ 140 }}</td>
                <td>{{ (!array_key_exists ( 'Tuesday', $pointDailyAll )) ? 0 : $pointDailyAll['Tuesday']  }}</td>
            </tr>
            <tr>
                <th>Wed</th>
                <td>{{ 140 }}</td>
                <td>{{ (!array_key_exists ( 'Wednesday', $pointDailyAll )) ? 0 : $pointDailyAll['Wednesday']  }}</td>
            </tr>
            <tr>
                <th>Thu</th>
                <td>{{ 140 }}</td>
                <td>{{ (!array_key_exists ( 'Thursday', $pointDailyAll )) ? 0 : $pointDailyAll['Thursday']  }}</td>
            </tr>
            <tr>
                <th>Fri</th>
                <td>{{ 140 }}</td>
                <td>{{ (!array_key_exists ( 'Friday', $pointDailyAll )) ? 0 : $pointDailyAll['Friday']  }}</td>
            </tr>
            <tr>
                <th>weekly</th>
                <td>{{ 140*5 }}</td>
                <td>{{ empty( $pointDailyAll['weekly'] ) ? 0 : $pointDailyAll['weekly']  }}</td>
            </tr>
        </tbody>
    </table>


    <table id="pointMonthlyAlldatatable" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Jan</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'jan', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['jan']  }}</td>
            </tr>
            <tr>
                <th>Feb</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'feb', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['feb']  }}</td>
            </tr>
            <tr>
                <th>Mar</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'mar', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['mar']  }}</td>
            </tr>
            <tr>
                <th>Apr</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'apr', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['apr']  }}</td>
            </tr>
            <tr>
                <th>May</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'may', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['may']  }}</td>
            </tr>
            <tr>
                <th>Jun</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'jun', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['jun']  }}</td>
            </tr>
            <tr>
                <th>Jul</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'jul', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['jul']  }}</td>
            </tr>
            <tr>
                <th>Aug</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'aug', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['aug']  }}</td>
            </tr>
            <tr>
                <th>Sep</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'sep', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['sep']  }}</td>
            </tr>
            <tr>
                <th>Oct</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'oct', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['oct']  }}</td>
            </tr>
            <tr>
                <th>Nov</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'nov', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['nov']  }}</td>
            </tr>
            <tr>
                <th>Dec</th>
                <td>{{ 140*20 }}</td>
                <td>{{ (!array_key_exists ( 'dec', $pointMonthlyAll )) ? 0 : $pointMonthlyAll['dec']  }}</td>
            </tr>
            <tr>
                <th>Annual</th>
                <td>{{ 140*20*12 }}</td>
                <td>{{ empty( $pointMonthlyAll['annual'] ) ? 0 : $pointMonthlyAll['annual']  }}</td>
            </tr>
        </tbody>
    </table>

    <table id="directHireAlldatatable" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Jan</th>
                <td>{{ $directHireTargetAll->jan }}</td>
                <td>{{ empty( $directHireAll['jan'] ) ? 0 : $directHireAll['jan']  }}</td>
            </tr>
            <tr>
                <th>Feb</th>
                <td>{{ $directHireTargetAll->feb }}</td>
                <td>{{ empty( $directHireAll['feb'] ) ? 0 : $directHireAll['feb']  }}</td>
            </tr>
            <tr>
                <th>Mar</th>
                <td>{{ $directHireTargetAll->mar }}</td>
                <td>{{ empty( $directHireAll['mar'] ) ? 0 : $directHireAll['mar']  }}</td>
            </tr>
            <tr>
                <th>Apr</th>
                <td>{{ $directHireTargetAll->apr }}</td>
                <td>{{ empty( $directHireAll['apr'] ) ? 0 : $directHireAll['apr']  }}</td>
            </tr>
            <tr>
                <th>May</th>
                <td>{{ $directHireTargetAll->may }}</td>
                <td>{{ empty( $directHireAll['may'] ) ? 0 : $directHireAll['may']  }}</td>
            </tr>
            <tr>
                <th>Jun</th>
                <td>{{ $directHireTargetAll->jun }}</td>
                <td>{{ empty( $directHireAll['jun'] ) ? 0 : $directHireAll['jun']  }}</td>
            </tr>
            <tr>
                <th>Jul</th>
                <td>{{ $directHireTargetAll->jul }}</td>
                <td>{{ empty( $directHireAll['jul'] ) ? 0 : $directHireAll['jul']  }}</td>
            </tr>
            <tr>
                <th>Aug</th>
                <td>{{ $directHireTargetAll->aug }}</td>
                <td>{{ empty( $directHireAll['aug'] ) ? 0 : $directHireAll['aug']  }}</td>
            </tr>
            <tr>
                <th>Sep</th>
                <td>{{ $directHireTargetAll->sep }}</td>
                <td>{{ empty( $directHireAll['sep'] ) ? 0 : $directHireAll['sep']  }}</td>
            </tr>
            <tr>
                <th>Oct</th>
                <td>{{ $directHireTargetAll->oct }}</td>
                <td>{{ empty( $directHireAll['oct'] ) ? 0 : $directHireAll['oct']  }}</td>
            </tr>
            <tr>
                <th>Nov</th>
                <td>{{ $directHireTargetAll->nov }}</td>
                <td>{{ empty( $directHireAll['nov'] ) ? 0 : $directHireAll['nov']  }}</td>
            </tr>
            <tr>
                <th>Dec</th>
                <td>{{ $directHireTargetAll->dec }}</td>
                <td>{{ empty( $directHireAll['dec'] ) ? 0 : $directHireAll['dec']  }}</td>
            </tr>
            <tr>
                <th>Annual</th>
                <td>{{ $directHireTargetAll->annual }}</td>
                <td>{{ empty( $directHireAll['annual'] ) ? 0 : $directHireAll['annual']  }}</td>
            </tr>
        </tbody>
    </table>


    <table id="directHireAnnualAlldatatable" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $thisYear = date('Y');

            for ($i = $thisYear; $i < $thisYear + 11; $i++) {
                ?>
                <tr>
                    <th><?php echo $i . '_'; ?></th>
                    <td><?php echo '' . ( empty($directHireAnnualAll[$i]) ? ( $thisYear == $i ? $directHireTargetAll->annual : 0 ) : $directHireTargetAll->annual ); ?></td>
                    <td><?php echo '' . ( empty($directHireAnnualAll[$i]) ? 0.0 : $directHireAnnualAll[$i] ); ?></td>
                </tr>
                <?php
            }
            ?>

        </tbody>
    </table> 

    <table id="tempGMPAlldatatable" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Jan</th>
                <td>{{ $directHireTargetAll->jan }}</td>
                <td>{{ empty( $gmpAll['jan'] ) ? 0 : $gmpAll['jan']  }}</td>
            </tr>
            <tr>
                <th>Feb</th>
                <td>{{ $directHireTargetAll->feb }}</td>
                <td>{{ empty( $gmpAll['feb'] ) ? 0 : $gmpAll['feb']  }}</td>
            </tr>
            <tr>
                <th>Mar</th>
                <td>{{ $directHireTargetAll->mar }}</td>
                <td>{{ empty( $gmpAll['mar'] ) ? 0 : $gmpAll['mar']  }}</td>
            </tr>
            <tr>
                <th>Apr</th>
                <td>{{ $directHireTargetAll->apr }}</td>
                <td>{{ empty( $gmpAll['apr'] ) ? 0 : $gmpAll['apr']  }}</td>
            </tr>
            <tr>
                <th>May</th>
                <td>{{ $directHireTargetAll->may }}</td>
                <td>{{ empty( $gmpAll['may'] ) ? 0 : $gmpAll['may']  }}</td>
            </tr>
            <tr>
                <th>Jun</th>
                <td>{{ $directHireTargetAll->jun }}</td>
                <td>{{ empty( $gmpAll['jun'] ) ? 0 : $gmpAll['jun']  }}</td>
            </tr>
            <tr>
                <th>Jul</th>
                <td>{{ $directHireTargetAll->jul }}</td>
                <td>{{ empty( $gmpAll['jul'] ) ? 0 : $gmpAll['jul']  }}</td>
            </tr>
            <tr>
                <th>Aug</th>
                <td>{{ $directHireTargetAll->aug }}</td>
                <td>{{ empty( $gmpAll['aug'] ) ? 0 : $gmpAll['aug']  }}</td>
            </tr>
            <tr>
                <th>Sep</th>
                <td>{{ $directHireTargetAll->sep }}</td>
                <td>{{ empty( $gmpAll['sep'] ) ? 0 : $gmpAll['sep']  }}</td>
            </tr>
            <tr>
                <th>Oct</th>
                <td>{{ $directHireTargetAll->oct }}</td>
                <td>{{ empty( $gmpAll['oct'] ) ? 0 : $gmpAll['oct']  }}</td>
            </tr>
            <tr>
                <th>Nov</th>
                <td>{{ $directHireTargetAll->nov }}</td>
                <td>{{ empty( $gmpAll['nov'] ) ? 0 : $gmpAll['nov']  }}</td>
            </tr>
            <tr>
                <th>Dec</th>
                <td>{{ $directHireTargetAll->dec }}</td>
                <td>{{ empty( $gmpAll['dec'] ) ? 0 : $gmpAll['dec']  }}</td>
            </tr>
            <tr>
                <th>Annual</th>
                <td>{{ $directHireTargetAll->annual }}</td>
                <td>{{ empty( $gmpAll['annual'] ) ? 0 : $gmpAll['annual']  }}</td>
            </tr>
        </tbody>
    </table>

    <table id="gmpAnnualAlldatatable" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>GOAL</th>
                <th>ACTUAL PERFORMANCE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $thisYear = date('Y');

            for ($i = $thisYear; $i < $thisYear + 11; $i++) {
                ?>
                <tr>
                    <th><?php echo $i . '_'; ?></th>
                    <td><?php echo '' . ( empty($gmpAnnualAll[$i]) ? ( $thisYear == $i ? $directHireTargetAll->annual : 0 ) : $directHireTargetAll->annual ); ?></td>
                    <td><?php echo '' . ( empty($gmpAnnualAll[$i]) ? 0.0 : $gmpAnnualAll[$i] ); ?></td>
                </tr>
                <?php
            }
            ?>

        </tbody>
    </table> 
    @endif
<script type="text/javascript">
            function tal(event){
            //DIRECT HIRE PRODUCTION | SALES Monthly
<?php foreach ($users as $user) { 
    $maxpointDaily= find_max(max($pointDaily[$user->cont]));
    $maxpointMonthly= find_max(max($pointMonthly[$user->cont]));
    $maxdirectHire= find_max(max($directHire[$user->cont]));
    $maxdirectHireAnnual= find_max(max($directHireAnnual[$user->cont]));
    $maxtempGMP= find_max(max($gmp[$user->cont]));
    $maxgmpAnnual= find_max(max($gmpAnnual[$user->cont]));
    ?>
                var pointDaily = '#pointDaily' +<?php echo $user->id; ?>;
                        var pointMonthly = '#pointMonthly' +<?php echo $user->id; ?>;
                        var directHire = '#directHire' +<?php echo $user->id; ?>;
                        var directHireAnnual = '#directHireAnnual' +<?php echo $user->id; ?>;
                        var tempGMP = '#tempGMP' +<?php echo $user->id; ?>;
                        var gmpAnnual = '#gmpAnnual' +<?php echo $user->id; ?>;
                        //Points Daily
                        
                        //variables maximas
                        var pointDailyRate =(0+<?php echo $maxpointDaily; ?>)/5;
                        var pointMonthlyRate =(0+<?php echo $maxpointMonthly; ?>)/10;
                        var directHireRate =(0+<?php echo $maxdirectHire; ?>)/10;
                        var directHireAnnualRate =(0+<?php echo $maxdirectHireAnnual; ?>)/15;
                        var tempGMPRate =(0+<?php echo $maxtempGMP; ?>)/10;
                        var gmpAnnualRate =(0+<?php echo $maxgmpAnnual; ?>)/15;
                        $(pointDaily).highcharts({
                data: {
                table: 'pointDailydatatable' +<?php echo $user->id; ?>
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                        tickPositions: [0, 50, pointDailyRate, pointDailyRate*2, pointDailyRate*3, pointDailyRate*4, pointDailyRate*5],
                                allowDecimals: false,
                                title: {
                                text: ''
                                }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                                return '<b>' + this.series.name + '</b><br/>' +
                                a.toString() + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
                        //Points Monthly
                        $(pointMonthly).highcharts({
                data: {
                table: 'pointMonthlydatatable' +<?php echo $user->id; ?>
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                        tickPositions: [0, 500, pointMonthlyRate, pointMonthlyRate*2, pointMonthlyRate*3, pointMonthlyRate*4, pointMonthlyRate*5, pointMonthlyRate*6, pointMonthlyRate*7, pointMonthlyRate*8, pointMonthlyRate*9, pointMonthlyRate*10],
                                allowDecimals: false,
                                title: {
                                text: ''
                                },
                                labels: {
                                    formatter: function () {
                                        return this.value;
                                    }
                                }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                        var numero = '';
                        numero = a.toString();
                        return '<b>' + this.series.name + '</b><br/>' +
                                numero + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
                        //DIRECT HIRE PRODUCTION | SALES Mounthly
                        $(directHire).highcharts({
                data: {
                table: 'directHiredatatable' +<?php echo $user->id; ?>
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                        tickPositions: [0, 5000, directHireRate, directHireRate*2, directHireRate*3, directHireRate*4, directHireRate*5, directHireRate*6, directHireRate*7, directHireRate*8, directHireRate*9, directHireRate*10],
                                allowDecimals: false,
                                title: {
                                text: ''
                                }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                                var numero = '';
                                if (a > 1000000){
                        numero = Math.round((a / 1000000)) + 'M';
                        } else{
                        if (this.point.y > 1000){
                        numero = Math.round((a / 1000)) + 'K';
                        } else{
                        numero = a.toString();
                        }
                        }
                        return '<b>' + this.series.name + '</b><br/>' +
                                numero + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
                        //DIRECT HIRE PRODUCTION | SALES Annually
                        $(directHireAnnual).highcharts({
                data: {
                table: 'directHireAnnualdatatable' +<?php echo $user->id; ?>
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                            tickPositions: [0, directHireAnnualRate, directHireAnnualRate*2, directHireAnnualRate*3, directHireAnnualRate*4, directHireAnnualRate*5, directHireAnnualRate*6, directHireAnnualRate*7, directHireAnnualRate*8, directHireAnnualRate*9, directHireAnnualRate*10, directHireAnnualRate*11, directHireAnnualRate*12, directHireAnnualRate*13, directHireAnnualRate*14,directHireAnnualRate*15],
                            allowDecimals: false,
                            title: {
                                text: ''
                            },
                            labels: {
                                formatter: function () {
                                    var a = parseFloat(this.value);
                                    var numero = '';
                                    if (a >= 1000000) {
                                        numero = Math.round((a / 1000000)) + 'M';
                                    } else {
                                        if (a > 1000) {
                                            numero = Math.round((a / 1000)) + 'K';
                                        }
                                    }
                                    return numero;
                                }
                            }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                                var numero = '';
                                if (a > 1000000){
                        numero = Math.round((a / 1000000)) + 'M';
                        } else{
                        if (this.point.y > 1000){
                        numero = Math.round((a / 1000)) + 'K';
                        } else{
                        numero = a.toString();
                        }
                        }
                        return '<b>' + this.series.name + '</b><br/>' +
                                numero + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
                        //TEMP or CONTRACT GROSS MARGIN OF PROFIT (GMP) Monthly
                        $(tempGMP).highcharts({
                data: {
                table: 'tempGMPdatatable' +<?php echo $user->id; ?>
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                        tickPositions: [0, 5000, tempGMPRate, tempGMPRate*2, tempGMPRate*3, tempGMPRate*4, tempGMPRate*5, tempGMPRate*6, tempGMPRate*7, tempGMPRate*8, tempGMPRate*9, tempGMPRate*10],
                                allowDecimals: false,
                                title: {
                                text: ''
                                }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                                var numero = '';
                                if (a > 1000000){
                        numero = Math.round((a / 1000000)) + 'M';
                        } else{
                        if (this.point.y > 1000){
                        numero = Math.round((a / 1000)) + 'K';
                        } else{
                        numero = a.toString();
                        }
                        }
                        return '<b>' + this.series.name + '</b><br/>' +
                                numero + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
                        //DIRECT HIRE PRODUCTION | SALES Annually
                        $(gmpAnnual).highcharts({
                data: {
                table: 'gmpAnnualdatatable' +<?php echo $user->id; ?>
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                            tickPositions: [0, gmpAnnualRate, gmpAnnualRate*2, gmpAnnualRate*3, gmpAnnualRate*4, gmpAnnualRate*5, gmpAnnualRate*6, gmpAnnualRate*7, gmpAnnualRate*8, gmpAnnualRate*9, gmpAnnualRate*10, gmpAnnualRate*11, gmpAnnualRate*12, gmpAnnualRate*13, gmpAnnualRate*14,gmpAnnualRate*15],
                            allowDecimals: false,
                            title: {
                                text: ''
                            },
                            labels: {
                                formatter: function () {
                                    var a = parseFloat(this.value);
                                    var numero = '';
                                    if (a >= 1000000) {
                                        numero = Math.round((a / 1000000)) + 'M';
                                    } else {
                                        if (a > 1000) {
                                            numero = Math.round((a / 1000)) + 'K';
                                        }
                                    }
                                    return numero;
                                }
                            }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                                var numero = '';
                                if (a > 1000000){
                        numero = Math.round((a / 1000000)) + 'M';
                        } else{
                        if (this.point.y > 1000){
                        numero = Math.round((a / 1000)) + 'K';
                        } else{
                        numero = a.toString();
                        }
                        }
                        return '<b>' + this.series.name + '</b><br/>' +
                                numero + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
<?php } ?>
//PARA LAS GRAFICAS ALL USERS
                        var pointDailyAll = '#pointDailyAll';
                        var pointMonthlyAll = '#pointMonthlyAll';
                        var directHireAll = '#directHireAll';
                        var directHireAnnualAll = '#directHireAnnualAll';
                        var tempGMPAll = '#tempGMPAll';
                        var gmpAnnualAll = '#gmpAnnualAll';
                        //Points Daily
                        $(pointDailyAll).highcharts({
                data: {
                table: 'pointDailyAlldatatable'
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                        tickPositions: [0, 50, 100, 150, 200, 250, 300],
                                allowDecimals: false,
                                title: {
                                text: ''
                                }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                                return '<b>' + this.series.name + '</b><br/>' +
                                a.toString() + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
                        //Points Monthly
                        $(pointMonthlyAll).highcharts({
                data: {
                table: 'pointMonthlyAlldatatable'
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                        tickPositions: [0, 500, 1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000],
                                allowDecimals: false,
                                title: {
                                text: ''
                                },
                                labels: {
                                    formatter: function () {
                                        return this.value;
                                    }
                                }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                        var numero = '';
                        numero = a.toString();
                        return '<b>' + this.series.name + '</b><br/>' +
                                numero + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
                        //DIRECT HIRE PRODUCTION | SALES Mounthly
                        $(directHireAll).highcharts({
                data: {
                table: 'directHireAlldatatable'
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                        tickPositions: [0, 5000, 10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000, 90000, 100000],
                                allowDecimals: false,
                                title: {
                                text: ''
                                }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                                var numero = '';
                                if (a > 1000000){
                        numero = Math.round((a / 1000000)) + 'M';
                        } else{
                        if (this.point.y > 1000){
                        numero = Math.round((a / 1000)) + 'K';
                        } else{
                        numero = a.toString();
                        }
                        }
                        return '<b>' + this.series.name + '</b><br/>' +
                                numero + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
                        //DIRECT HIRE PRODUCTION | SALES Annually
                        $(directHireAnnualAll).highcharts({
                data: {
                table: 'directHireAnnualAlldatatable'
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                            tickPositions: [0, 100000, 150000, 200000, 250000, 300000, 350000, 400000, 450000, 500000, 600000, 700000, 800000, 900000, 1000000],
                            allowDecimals: false,
                            title: {
                                text: ''
                            },
                            labels: {
                                formatter: function () {
                                    var a = parseFloat(this.value);
                                    var numero = '';
                                    if (a >= 1000000) {
                                        numero = Math.round((a / 1000000)) + 'M';
                                    } else {
                                        if (a > 1000) {
                                            numero = Math.round((a / 1000)) + 'K';
                                        }
                                    }
                                    return numero;
                                }
                            }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                                var numero = '';
                                if (a > 1000000){
                        numero = Math.round((a / 1000000)) + 'M';
                        } else{
                        if (this.point.y > 1000){
                        numero = Math.round((a / 1000)) + 'K';
                        } else{
                        numero = a.toString();
                        }
                        }
                        return '<b>' + this.series.name + '</b><br/>' +
                                numero + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
                        //TEMP or CONTRACT GROSS MARGIN OF PROFIT (GMP) Monthly
                        $(tempGMPAll).highcharts({
                data: {
                table: 'tempGMPAlldatatable'
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                        tickPositions: [0, 5000, 10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000, 90000, 100000],
                                allowDecimals: false,
                                title: {
                                text: ''
                                }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                                var numero = '';
                                if (a > 1000000){
                        numero = Math.round((a / 1000000)) + 'M';
                        } else{
                        if (this.point.y > 1000){
                        numero = Math.round((a / 1000)) + 'K';
                        } else{
                        numero = a.toString();
                        }
                        }
                        return '<b>' + this.series.name + '</b><br/>' +
                                numero + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
                        //DIRECT HIRE PRODUCTION | SALES Annually
                        $(gmpAnnualAll).highcharts({
                data: {
                table: 'gmpAnnualAlldatatable'
                },
                        chart: {
                        type: 'column'
                        },
                        title: {
                        text: ''
                        },
                        yAxis: {
                            tickPositions: [0, 100000, 150000, 200000, 250000, 300000, 350000, 400000, 450000, 500000, 600000, 700000, 800000, 900000, 1000000],
                            allowDecimals: false,
                            title: {
                                text: ''
                            },
                            labels: {
                                formatter: function () {
                                    var a = parseFloat(this.value);
                                    var numero = '';
                                    if (a >= 1000000) {
                                        numero = Math.round((a / 1000000)) + 'M';
                                    } else {
                                        if (a > 1000) {
                                            numero = Math.round((a / 1000)) + 'K';
                                        }
                                    }
                                    return numero;
                                }
                            }
                        },
                        tooltip: {
                        formatter: function () {
                        var a = parseFloat(this.point.y);
                                var numero = '';
                                if (a > 1000000){
                        numero = Math.round((a / 1000000)) + 'M';
                        } else{
                        if (this.point.y > 1000){
                        numero = Math.round((a / 1000)) + 'K';
                        } else{
                        numero = a.toString();
                        }
                        }
                        return '<b>' + this.series.name + '</b><br/>' +
                                numero + ' ' + this.point.name.toLowerCase();
                        }
                        },
                        credits: {
                        enabled: false
                        }
                });
            }
    if (document.addEventListener) {
    document.addEventListener("DOMContentLoaded", tal);
    } else if (document.attachEvent) {
    document.attachEvent('DOMContentLoaded', tal);
    }
</script>
