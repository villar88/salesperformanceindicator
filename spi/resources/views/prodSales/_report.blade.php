@extends('app')

@section('content')

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">

                @if( empty($user) )
                    <h2>My Statistics</h2>
                @else
                    <h2>{{ $user->first_name  }} {{ $user->last_name  }} Statistics</h2>
                @endif
            </div>
        </div>
    </div>
    <div class="row">


        <div class="col-md-10 col-md-offset-1">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab">Recruiting</a>
                </li>
                <li class="">
                    <a href="#tab2" data-toggle="tab">Direct Hire Production | Sales</a>
                </li>
                <li class="">
                    <a href="#tab3" data-toggle="tab">TEMP or CONTRACT GROSS MARGIN OF PROFIT (GMP)</a>
                </li>
            </ul>

            <br/>
            <div id="myTabContent" class="tab-content">



                <div class="tab-pane fade active in" id="tab1">
                    <div class="row ">

                        <div class="col-md-12 ">
                            <div id="recruiting"></div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade " id="tab2">
                    <div class="row ">
                        <div class="col-md-12 ">
                            <h3>Daily</h3>
                            <div id="directHire"></div>

                            <h3>Monthly</h3>
                            <div id="directHireAnnual"></div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade " id="tab3">
                    <div class="row ">

                        <h3>Daily</h3>
                        <div class="col-md-12 ">
                            <div id="gmp"></div>
                        </div>

                        <h3>Monthly</h3>
                        <div id="gmpAnnual"></div>
                    </div>
                </div>

            </div>
    </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>

    <script>
        google.load('visualization', '1', {packages: ['corechart']});
        google.setOnLoadCallback(drawRecruitingGoalChart);
        google.setOnLoadCallback(drawDirectHireChart);
        google.setOnLoadCallback(drawGMPChart);
        google.setOnLoadCallback(drawDirectHireChartAnnual);
        google.setOnLoadCallback(drawGMPChartAnnual);

        function drawRecruitingGoalChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'X');
            data.addColumn('number', 'Recruiter\'s Performance');
            data.addColumn('number', 'Recruiter\'s Goal');
            var options = {
                width: 1500,
                height: 563,
                hAxis: {
                    title: 'Month ({{ date('M') }})',
                    textStyle:{color: 'black', fontSize: '10'}
                },
                vAxis: {
                    title: 'Points'
                },
                colors: ['#AB0D06', '#007329'],
                pointSize: 5
            };

            data.addRows([
                <?php
                    $isFirst = true;
                    $offset = 0;
                    for( $i = 1; $i <= date('t'); $i++ )
                    {
                        if(!$isFirst) { echo ','; }
                        if( $offset < count( $recruitingData )  && $i - intval( $recruitingData[$offset]->day ) == 0 ) {
                            echo '[\''. $recruitingData[$offset]->day .'\','. $recruitingData[$offset]->dailyTotal .', '. $recruitingGoal->target .']';
                            $offset++;
                        }
                        else
                        {
                            echo '[\''. ( $i > 9 ? $i : '0'.$i ) .'\', 0, '. $recruitingGoal->target .']';
                        }
                        $isFirst = false;
                    }

                ?>
            ]);

            var chart = new google.visualization.LineChart(document.getElementById('recruiting'));
            chart.draw(data, options);
        }

        function drawGMPChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'X');
            data.addColumn('number', 'Recruiter\'s Performance');
            data.addColumn('number', 'Recruiter\'s Goal');

            var options = {
                width: 1500,
                height: 563,
                hAxis: {
                    title: 'Month ({{ date('M') }})',
                    textStyle:{color: 'black', fontSize: '10'}
                },
                vAxis: {
                    title: 'Sales'
                },
                colors: ['#AB0D06', '#007329'],
                pointSize: 5
            };

            data.addRows([
                <?php
                    $isFirst = true;
                    $offset = 0;
                    for( $i = 1; $i <= date('t'); $i++ )
                    {
                        if(!$isFirst) { echo ','; }
                        if( $offset < count( $gmp )  && $i - intval( $gmp[$offset]->day ) == 0 ) {
                            echo '[\''. $gmp[$offset]->day .'\','. $gmp[$offset]->dailyTotal .', '. $gmpTarget->target .']';
                            $offset++;
                        }
                        else
                        {
                            echo '[\''. ( $i > 9 ? $i : '0'.$i ) .'\', 0, '. $gmpTarget->target .']';
                        }
                        $isFirst = false;
                    }
                ?>
            ]);

            var chart = new google.visualization.LineChart(document.getElementById('gmp'));
            chart.draw(data, options);
        }

        function drawDirectHireChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'X');
            data.addColumn('number', 'Recruiter\'s Performance');
            data.addColumn('number', 'Recruiter\'s Goal');

            var options = {
                width: 1500,
                height: 563,
                hAxis: {
                    title: 'Month ({{ date('M') }})',
                    textStyle:{color: 'black', fontSize: '10'}
                },
                vAxis: {
                    title: 'Sales'
                },
                colors: ['#AB0D06', '#007329'],
                pointSize: 5
            };

            data.addRows([
                <?php

                    $isFirst = true;
                    $offset = 0;
                    for( $i = 1; $i <= date('t'); $i++ )
                    {
                        if(!$isFirst) { echo ','; }
                        if( $offset < count( $directHire )  && $i - intval( $directHire[$offset]->day ) == 0 ) {
                            echo '[\''. $directHire[$offset]->day .'\','. $directHire[$offset]->dailyTotal .', '. $directHireTarget->target .']';
                            $offset++;
                        }
                        else
                        {
                            echo '[\''. ( $i > 9 ? $i : '0'.$i ) .'\', 0, '. $directHireTarget->target .']';
                        }
                        $isFirst = false;
                    }
                ?>
            ]);

            var chart = new google.visualization.LineChart(document.getElementById('directHire'));
            chart.draw(data, options);
        }

        <?php
            function getNextMonth($month)
            {
                if ($month == 'January') return 'February';
                if ($month == 'February') return 'March';
                if ($month == 'March') return 'April';
                if ($month == 'April') return 'May';
                if ($month == 'May') return 'June';
                if ($month == 'June') return 'July';
                if ($month == 'July') return 'August';
                if ($month == 'August') return 'September';
                if ($month == 'September') return 'October';
                if ($month == 'October') return 'November';
                if ($month == 'November') return 'December';
                if ($month == 'December') return 'January';
            }
        ?>

        function drawDirectHireChartAnnual() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'X');
            data.addColumn('number', 'Recruiter\'s Performance');
            data.addColumn('number', 'Recruiter\'s Goal');

            var options = {
                width: 1500,
                height: 563,
                hAxis: {
                    title: 'Annual',
                    textStyle:{color: 'black', fontSize: '10'}
                },
                vAxis: {
                    title: 'Sales'
                },
                colors: ['#AB0D06', '#007329'],
                pointSize: 5
            };

            data.addRows([
                <?php
                    $isFirst = true;
                    $thisMonth = '';
                    $offset = 0;
                    for( $i = 0; $i < 12; $i++ )
                    {
                        if(!$isFirst) echo ',';
                        if( $thisMonth == $directHireAnnual[$offset]->month || $thisMonth == '' )
                        {
                            echo '[\''. $directHireAnnual[$offset]->month .'\','. $directHireAnnual[$offset]->monthlyTotal .', '. $directHireTarget->target .']';
                            if( $thisMonth == '' ) $thisMonth = $directHireAnnual[$offset]->month;
                            $offset++;
                        }
                        else
                        {
                            echo '[\''. $thisMonth .'\','. 0 .', '. $directHireTarget->target .']';
                        }
                        $isFirst = false;
                        $thisMonth = getNextMonth( $thisMonth );
                    }
                ?>
            ]);

            var chart = new google.visualization.LineChart(document.getElementById('directHireAnnual'));
            chart.draw(data, options);
        }


        function drawGMPChartAnnual() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'X');
            data.addColumn('number', 'Recruiter\'s Performance');
            data.addColumn('number', 'Recruiter\'s Goal');

            var options = {
                width: 1500,
                height: 563,
                hAxis: {
                    title: 'Annual',
                    textStyle:{color: 'black', fontSize: '10'}
                },
                vAxis: {
                    title: 'Sales'
                },
                colors: ['#AB0D06', '#007329'],
                pointSize: 5
            };

            data.addRows([
                <?php
                    $isFirst = true;
                    $thisMonth = '';
                    $offset = 0;
                    for( $i = 0; $i < 12; $i++ )
                    {
                        if(!$isFirst) echo ',';

                        if( $thisMonth == $gmpAnnual[$offset]->month  || $thisMonth == '' )
                        {
                            echo '[\''. $gmpAnnual[$offset]->month .'\','. $gmpAnnual[$offset]->monthlyTotal .', '. $gmpTarget->target .']';
                            if( $thisMonth == '' ) $thisMonth = $gmpAnnual[$offset]->month;
                            $offset++;
                        }
                        else
                        {
                            echo '[\''. $thisMonth .'\','. 0 .', '. $gmpAnnual[$offset]->target .']';
                        }
                        $isFirst = false;
                        $thisMonth = getNextMonth( $thisMonth );
                    }
                ?>
            ]);

            var chart = new google.visualization.LineChart(document.getElementById('gmpAnnual'));
            chart.draw(data, options);
        }
    </script>
@endsection