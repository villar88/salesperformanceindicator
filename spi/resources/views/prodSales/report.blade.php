@extends('app')

@section('content')
<?php
#    Output easy-to-read numbers
#    by james at bandit.co.nz

function bd_nice_number($n) {
    // is this a number?
    if (!is_numeric($n))
        return false;

    // now filter it;
    if ($n > 1000000)
        return round(($n / 1000000), 1) . 'M';
    else if ($n > 1000)
        return round(($n / 1000), 1) . 'K';

    return number_format($n);
}
?>
<script type="text/javascript">
    function tal(event) {
        $('#directHiredatatable').hide();
        $('#directHireAnnualdatatable').hide();
        $('#tempGMPdatatable').hide();
        $('#gmpAnnualdatatable').hide();
        $('#directHire').highcharts({
            data: {
                table: 'directHiredatatable'
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
                    if (a > 1000000) {
                        numero = Math.round((a / 1000000)) + 'M';
                    } else {
                        if (this.point.y > 1000) {
                            numero = Math.round((a / 1000)) + 'K';
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
        $('#directHireAnnual').highcharts({
            data: {
                table: 'directHireAnnualdatatable'
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
                    if (a > 1000000) {
                        numero = Math.round((a / 1000000)) + 'M';
                    } else {
                        if (this.point.y > 1000) {
                            numero = Math.round((a / 1000)) + 'K';
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
        $('#tempGMP').highcharts({
            data: {
                table: 'tempGMPdatatable'
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
                    if (a > 1000000) {
                        numero = Math.round((a / 1000000)) + 'M';
                    } else {
                        if (this.point.y > 1000) {
                            numero = Math.round((a / 1000)) + 'K';
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
        $('#gmpAnnual').highcharts({
            data: {
                table: 'gmpAnnualdatatable'
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
                    if (a > 1000000) {
                        numero = Math.round((a / 1000000)) + 'M';
                    } else {
                        if (this.point.y > 1000) {
                            numero = Math.round((a / 1000)) + 'K';
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

        //Points Daily
        $('#pointDaily').highcharts({
            data: {
                table: 'pointDailydatatable'
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
        $('#pointMonthly').highcharts({
            data: {
                table: 'pointMonthlydatatable'
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
    }
    if (document.addEventListener) {
        document.addEventListener("DOMContentLoaded", tal);

    } else if (document.attachEvent) {
        document.attachEvent('DOMContentLoaded', tal);
    }
</script>
<div class="page-header" id="banner">
    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-6">
            <h2>Production | Sales Revenue {!! empty( $user->first_name ) ? '' : ' - <span style="color:blue;">' . $user->first_name . ' ' . $user -> last_name .'</span>' !!}  </h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1">
                    <h3>Points Daily</h3>
                    <div id="pointDaily" style="min-width: 310px; height: 400px; margin: 10px; text-align: center;"></div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1">
                    <h3>Points Monthly</h3>
                    <div id="pointMonthly" style="min-width: 310px; height: 400px; margin: 10px; text-align: center;"></div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1">
                    <h3>DIRECT HIRE PRODUCTION | SALES Monthly</h3>
                    <div id="directHire" style="min-width: 310px; height: 400px; margin: 10px; text-align: center;"></div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1">
                    <h3>DIRECT HIRE PRODUCTION | SALES Annually</h3>
                    <div id="directHireAnnual" style="min-width: 310px; height: 400px; margin: 10px; text-align: center;" ></div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1">
                    <h3>TEMP or CONTRACT GROSS MARGIN OF PROFIT (GMP) Monthly</h3>
                    <div id="tempGMP" style="min-width: 310px; height: 400px; margin: 10px; text-align: center;" ></div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1">
                    <h3>TEMP or CONTRACT GROSS MARGIN OF PROFIT (GMP) Annual</h3>
                    <div id="gmpAnnual" style="min-width: 310px; height: 400px; margin: 10px; text-align: center;" ></div>
                </div>
            </div>
        </div>
    </div>
</div>



<table id="directHiredatatable">
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
            <td>{{ $directHireTarget->jan }}</td>
            <td>{{ empty( $directHire['jan'] ) ? 0 : $directHire['jan']  }}</td>
        </tr>
        <tr>
            <th>Feb</th>
            <td>{{ $directHireTarget->feb }}</td>
            <td>{{ empty( $directHire['feb'] ) ? 0 : $directHire['feb']  }}</td>
        </tr>
        <tr>
            <th>Mar</th>
            <td>{{ $directHireTarget->mar }}</td>
            <td>{{ empty( $directHire['mar'] ) ? 0 : $directHire['mar']  }}</td>
        </tr>
        <tr>
            <th>Apr</th>
            <td>{{ $directHireTarget->apr }}</td>
            <td>{{ empty( $directHire['apr'] ) ? 0 : $directHire['apr']  }}</td>
        </tr>
        <tr>
            <th>May</th>
            <td>{{ $directHireTarget->may }}</td>
            <td>{{ empty( $directHire['may'] ) ? 0 : $directHire['may']  }}</td>
        </tr>
        <tr>
            <th>Jun</th>
            <td>{{ $directHireTarget->jun }}</td>
            <td>{{ empty( $directHire['jun'] ) ? 0 : $directHire['jun']  }}</td>
        </tr>
        <tr>
            <th>Jul</th>
            <td>{{ $directHireTarget->jul }}</td>
            <td>{{ empty( $directHire['jul'] ) ? 0 : $directHire['jul']  }}</td>
        </tr>
        <tr>
            <th>Aug</th>
            <td>{{ $directHireTarget->aug }}</td>
            <td>{{ empty( $directHire['aug'] ) ? 0 : $directHire['aug']  }}</td>
        </tr>
        <tr>
            <th>Sep</th>
            <td>{{ $directHireTarget->sep }}</td>
            <td>{{ empty( $directHire['sep'] ) ? 0 : $directHire['sep']  }}</td>
        </tr>
        <tr>
            <th>Oct</th>
            <td>{{ $directHireTarget->oct }}</td>
            <td>{{ empty( $directHire['oct'] ) ? 0 : $directHire['oct']  }}</td>
        </tr>
        <tr>
            <th>Nov</th>
            <td>{{ $directHireTarget->nov }}</td>
            <td>{{ empty( $directHire['nov'] ) ? 0 : $directHire['nov']  }}</td>
        </tr>
        <tr>
            <th>Dec</th>
            <td>{{ $directHireTarget->dec }}</td>
            <td>{{ empty( $directHire['dec'] ) ? 0 : $directHire['dec']  }}</td>
        </tr>
        <tr>
            <th>Annual</th>
            <td>{{ $directHireTarget->annual }}</td>
            <td>{{ empty( $directHire['annual'] ) ? 0 : $directHire['annual']  }}</td>
        </tr>
    </tbody>
</table>

<table id="directHireAnnualdatatable">
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
                <td><?php echo '' . ( empty($directHireAnnual[$i]) ? ( $thisYear == $i ? $directHireTarget->annual : 0 ) : $directHireTarget->annual ); ?></td>
                <td><?php echo '' . ( empty($directHireAnnual[$i]) ? 0.0 : $directHireAnnual[$i] ); ?></td>
            </tr>
            <?php
        }
        ?>

    </tbody>
</table> 

<table id="tempGMPdatatable">
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
            <td>{{ $directHireTarget->jan }}</td>
            <td>{{ empty( $gmp['jan'] ) ? 0 : $gmp['jan']  }}</td>
        </tr>
        <tr>
            <th>Feb</th>
            <td>{{ $directHireTarget->feb }}</td>
            <td>{{ empty( $gmp['feb'] ) ? 0 : $gmp['feb']  }}</td>
        </tr>
        <tr>
            <th>Mar</th>
            <td>{{ $directHireTarget->mar }}</td>
            <td>{{ empty( $gmp['mar'] ) ? 0 : $gmp['mar']  }}</td>
        </tr>
        <tr>
            <th>Apr</th>
            <td>{{ $directHireTarget->apr }}</td>
            <td>{{ empty( $gmp['apr'] ) ? 0 : $gmp['apr']  }}</td>
        </tr>
        <tr>
            <th>May</th>
            <td>{{ $directHireTarget->may }}</td>
            <td>{{ empty( $gmp['may'] ) ? 0 : $gmp['may']  }}</td>
        </tr>
        <tr>
            <th>Jun</th>
            <td>{{ $directHireTarget->jun }}</td>
            <td>{{ empty( $gmp['jun'] ) ? 0 : $gmp['jun']  }}</td>
        </tr>
        <tr>
            <th>Jul</th>
            <td>{{ $directHireTarget->jul }}</td>
            <td>{{ empty( $gmp['jul'] ) ? 0 : $gmp['jul']  }}</td>
        </tr>
        <tr>
            <th>Aug</th>
            <td>{{ $directHireTarget->aug }}</td>
            <td>{{ empty( $gmp['aug'] ) ? 0 : $gmp['aug']  }}</td>
        </tr>
        <tr>
            <th>Sep</th>
            <td>{{ $directHireTarget->sep }}</td>
            <td>{{ empty( $gmp['sep'] ) ? 0 : $gmp['sep']  }}</td>
        </tr>
        <tr>
            <th>Oct</th>
            <td>{{ $directHireTarget->oct }}</td>
            <td>{{ empty( $gmp['oct'] ) ? 0 : $gmp['oct']  }}</td>
        </tr>
        <tr>
            <th>Nov</th>
            <td>{{ $directHireTarget->nov }}</td>
            <td>{{ empty( $gmp['nov'] ) ? 0 : $gmp['nov']  }}</td>
        </tr>
        <tr>
            <th>Dec</th>
            <td>{{ $directHireTarget->dec }}</td>
            <td>{{ empty( $gmp['dec'] ) ? 0 : $gmp['dec']  }}</td>
        </tr>
        <tr>
            <th>Annual</th>
            <td>{{ $directHireTarget->annual }}</td>
            <td>{{ empty( $gmp['annual'] ) ? 0 : $gmp['annual']  }}</td>
        </tr>
    </tbody>
</table>

<table id="gmpAnnualdatatable">
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
                <td><?php echo '' . ( empty($gmpAnnual[$i]) ? ( $thisYear == $i ? $directHireTarget->annual : 0 ) : $directHireTarget->annual ); ?></td>
                <td><?php echo '' . ( empty($gmpAnnual[$i]) ? 0.0 : $gmpAnnual[$i] ); ?></td>
            </tr>
            <?php
        }
        ?>

    </tbody>
</table> 
<table id="pointDailydatatable" style="display: none;">
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
            <td>{{ (!array_key_exists ( 'Monday', $pointDaily )) ? 0 : $pointDaily['Monday']  }}</td>
        </tr>
        <tr>
            <th>Tue</th>
            <td>{{ 140 }}</td>
            <td>{{ (!array_key_exists ( 'Tuesday', $pointDaily )) ? 0 : $pointDaily['Tuesday']  }}</td>
        </tr>
        <tr>
            <th>Wed</th>
            <td>{{ 140 }}</td>
            <td>{{ (!array_key_exists ( 'Wednesday', $pointDaily )) ? 0 : $pointDaily['Wednesday']  }}</td>
        </tr>
        <tr>
            <th>Thu</th>
            <td>{{ 140 }}</td>
            <td>{{ (!array_key_exists ( 'Thursday', $pointDaily )) ? 0 : $pointDaily['Thursday']  }}</td>
        </tr>
        <tr>
            <th>Fri</th>
            <td>{{ 140 }}</td>
            <td>{{ (!array_key_exists ( 'Friday', $pointDaily )) ? 0 : $pointDaily['Friday']  }}</td>
        </tr>
        <tr>
            <th>weekly</th>
            <td>{{ 140*5 }}</td>
            <td>{{ empty( $pointDaily['weekly'] ) ? 0 : $pointDaily['weekly']  }}</td>
        </tr>
    </tbody>
</table>


<table id="pointMonthlydatatable" style="display: none;">
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
            <td>{{ (!array_key_exists ( 'jan', $pointMonthly )) ? 0 : $pointMonthly['jan']  }}</td>
        </tr>
        <tr>
            <th>Feb</th>
            <td>{{ 140*20 }}</td>
            <td>{{ (!array_key_exists ( 'feb', $pointMonthly )) ? 0 : $pointMonthly['feb']  }}</td>
        </tr>
        <tr>
            <th>Mar</th>
            <td>{{ 140*20 }}</td>
            <td>{{ (!array_key_exists ( 'mar', $pointMonthly )) ? 0 : $pointMonthly['mar']  }}</td>
        </tr>
        <tr>
            <th>Apr</th>
            <td>{{ 140*20 }}</td>
            <td>{{ (!array_key_exists ( 'apr', $pointMonthly )) ? 0 : $pointMonthly['apr']  }}</td>
        </tr>
        <tr>
            <th>May</th>
            <td>{{ 140*20 }}</td>
            <td>{{ (!array_key_exists ( 'may', $pointMonthly )) ? 0 : $pointMonthly['may']  }}</td>
        </tr>
        <tr>
            <th>Jun</th>
            <td>{{ 140*20 }}</td>
            <td>{{ (!array_key_exists ( 'jun', $pointMonthly )) ? 0 : $pointMonthly['jun']  }}</td>
        </tr>
        <tr>
            <th>Jul</th>
            <td>{{ 140*20 }}</td>
            <td>{{ (!array_key_exists ( 'jul', $pointMonthly )) ? 0 : $pointMonthly['jul']  }}</td>
        </tr>
        <tr>
            <th>Aug</th>
            <td>{{ 140*20 }}</td>
            <td>{{ (!array_key_exists ( 'aug', $pointMonthly )) ? 0 : $pointMonthly['aug']  }}</td>
        </tr>
        <tr>
            <th>Sep</th>
            <td>{{ 140*20 }}</td>
            <td>{{ (!array_key_exists ( 'sep', $pointMonthly )) ? 0 : $pointMonthly['sep']  }}</td>
        </tr>
        <tr>
            <th>Oct</th>
            <td>{{ 140*20 }}</td>
            <td>{{ (!array_key_exists ( 'oct', $pointMonthly )) ? 0 : $pointMonthly['oct']  }}</td>
        </tr>
        <tr>
            <th>Nov</th>
            <td>{{ 140*20 }}</td>
            <td>{{ (!array_key_exists ( 'nov', $pointMonthly )) ? 0 : $pointMonthly['nov']  }}</td>
        </tr>
        <tr>
            <th>Dec</th>
            <td>{{ 140*20 }}</td>
            <td>{{ (!array_key_exists ( 'dec', $pointMonthly )) ? 0 : $pointMonthly['dec']  }}</td>
        </tr>
        <tr>
            <th>Annual</th>
            <td>{{ 140*20*12 }}</td>
            <td>{{ empty( $pointMonthly['annual'] ) ? 0 : $pointMonthly['annual']  }}</td>
        </tr>
    </tbody>
</table>
@endsection

@section('footer')

@endsection