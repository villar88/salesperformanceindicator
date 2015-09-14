@extends('app')

@section('content')
    <style>
        th{
            text-align: center !important;
        }

    </style>
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2>My Ratio </h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        <h3>Recruiting </h3>
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
                                    <td>Recruiting Presentation to Recruiting Hit</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_1 }} / {{ $recruiting->recruit_2 }}</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_3 }} / {{ $recruiting->recruit_4 }}</td>
                                </tr>
                                <tr>
                                    <td>Recruiting Hit to Candidate Interviews</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_5 }} / {{ $recruiting->recruit_6 }}</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_7 }} / {{ $recruiting->recruit_8 }}</td>
                                </tr>
                                <tr>
                                    <td>Recruiting Hit to Interview Reactivated Candidate</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_9 }} / {{ $recruiting->recruit_10 }}</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_11 }} / {{ $recruiting->recruit_12 }}</td>
                                </tr>
                                <tr>
                                    <td>Interviewed Candidate to Send Out</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_13 }} / {{ $recruiting->recruit_14 }}</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_15 }} / {{ $recruiting->recruit_16 }}</td>
                                </tr>
                                <tr>
                                    <td>Interview Reactivated Candidate to Send Out</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_17 }} / {{ $recruiting->recruit_18  }}</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_19 }} / {{ $recruiting->recruit_20  }}</td>
                                </tr>
                                <tr>
                                    <td>Sent Out to Fill or Placement</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_21 }} / {{ $recruiting->recruit_22 }}</td>
                                    <td style="text-align: center !important;">{{ $recruiting->recruit_23 }} / {{ $recruiting->recruit_24 }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        <h3>Client Development - Inside  </h3>
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
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_1 }} / {{ $clientDev->clientDev_2 }}</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_3 }} / {{ $clientDev->clientDev_4 }}</td>
                            </tr>
                            <tr>
                                <td>MPC Presentation to Job Order, Contract or Temp Assignment</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_5 }} / {{ $clientDev->clientDev_6 }}</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_7 }} / {{ $clientDev->clientDev_8 }}</td>
                            </tr>
                            <tr>
                                <td>Job Order, Contract or Temp Assignment to Fill or Placement by Self</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_9 }} / {{ $clientDev->clientDev_10 }}</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_11 }} / {{ $clientDev->clientDev_12 }}</td>
                            </tr>
                            <tr>
                                <td>Job Order, Contract or Temp Assignment to Fill or Placement by Others</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_13 }} / {{ $clientDev->clientDev_14 }}</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_15 }} / {{ $clientDev->clientDev_16}}</td>
                            </tr>
                            <tr>
                                <td>Submittal to Send Out</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_17 }} / {{ $clientDev->clientDev_18 }}</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_19 }} / {{ $clientDev->clientDev_20 }}</td>
                            </tr>
                            <tr>
                                <td>Send Out to Fill or Placement by Self</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_21 }} / {{ $clientDev->clientDev_22 }}</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_23 }} / {{ $clientDev->clientDev_24 }}</td>
                            </tr>
                            <tr>
                                <td>Sent Out to Fill or Placement by Others</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_25 }} / {{ $clientDev->clientDev_26 }}</td>
                                <td style="text-align: center !important;">{{ $clientDev->clientDev_27 }} / {{ $clientDev->clientDev_28 }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        <h3>Client Development - Outside  </h3>
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
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_1}} / {{$clientDevOut->clientDevOut_2 }}</td>
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_3}} / {{$clientDevOut->clientDevOut_4 }}</td>
                            </tr>
                            <tr>
                                <td>Marketing Call to Job Order, Contract or Temp Assignment</td>
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_5}} / {{$clientDevOut->clientDevOut_6 }}</td>
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_7}} / {{$clientDevOut->clientDevOut_8 }}</td>
                            </tr>
                            <tr>
                                <td>MPC Presentation to Job Order, Contract or Temp Assignment</td>
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_9}} / {{$clientDevOut->clientDevOut_10 }}</td>
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_11}} / {{$clientDevOut->clientDevOut_12 }}</td>
                            </tr>
                            <tr>
                                <td>Job Order, Contract or Temp Assignment to Fill or Placement by Self</td>
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_13}} / {{$clientDevOut->clientDevOut_14 }}</td>
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_15}} / {{$clientDevOut->clientDevOut_16 }}</td>
                            </tr>
                            <tr>
                                <td>Job Order, Contract or Temp Assignment to Fill or Placement by Others</td>
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_17}} / {{$clientDevOut->clientDevOut_18 }}</td>
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_19}} / {{$clientDevOut->clientDevOut_20 }}</td>
                            </tr>
                            <tr>
                                <td>Sent Out to Fill or Placement by Others</td>
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_21}} / {{$clientDevOut->clientDevOut_22 }}</td>
                                <td style="text-align: center !important;">{{$clientDevOut->clientDevOut_23}} / {{$clientDevOut->clientDevOut_24 }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
