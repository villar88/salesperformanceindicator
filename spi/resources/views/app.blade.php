<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Metrics Solution</title>

        <link href="https://salesperformanceindicator.com/app/css/app.css" rel="stylesheet">

        <link rel="stylesheet" href="https://salesperformanceindicator.com/app/css/bootstrap.css">
        <link rel="stylesheet" href="https://salesperformanceindicator.com/app/css/fixes.css">
        <link rel="stylesheet" href="https://salesperformanceindicator.com/app/css/bootswatch.min.css">
        <link rel="stylesheet" href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>
        <script src="https://salesperformanceindicator.com/app/js/highcharts.js"></script>
        <script src="https://salesperformanceindicator.com/app/js/exporting.js"></script>
        <script src="https://salesperformanceindicator.com/app/js/data.js"></script>
        <script src="https://salesperformanceindicator.com/app/js/export-csv.js"></script>

        <!-- Scripts -->

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
$(document).ready(function () {
    $('#godown').height($("#ss_fixed_nav").height());
    window.onresize = function () {
        $('#godown').height($("#ss_fixed_nav").height());
    }
});
        </script>
        <script>

            function ajaxSubmit(frm)
            {
                form_data = $(frm).serialize();
                $(frm).find(':input:not(:disabled)').prop('disabled', true);

                action_url = frm.action;

                $.post(action_url, form_data)
                        .done(function (data) {
                            if (data != "") {
                                alert(data);
                            }
                            $(frm).find(':input').prop('disabled', false);
                            frm.reset();
                        });
                return false;
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <nav class="navbar-default navbar-fixed-top" id="ss_fixed_nav">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle Navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="{{ url('/')}}">
                                    <img class="hidden-xs hidden-sm img-responsive" src="https://salesperformanceindicator.com/app/images/modLogo.png" alt="logo description" />
                                    <img class="hidden-xs visible-sm img-responsive" src="https://salesperformanceindicator.com/app/images/modLogo-half.png" alt="logo description" />
                                    <img class="visible-xs img-responsive" src="https://salesperformanceindicator.com/app/images/modLogo-small.png" alt="logo description" />
                                </a>
                            </div>

                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                @if (Auth::guest() )
                                <ul class="nav navbar-nav navbar-right">
							<li><img class="img-responsive" src="https://salesperformanceindicator.com/app/images/presented-edited.png" />&nbsp;</li>
                               </ul>
                                @endif
                                <ul class="nav navbar-nav">
                                    @if (! Auth::guest() )
                                    @if( Auth::user()->role->id == 1 )
                                    <li class="{{ ( Request::is('users/*') || Request::is('users') ) ? 'active' : '' }}"><a href="{{ url('/') }}">Manage Users</a></li>
                                    <li class="{{ ( Request::is('companies/*') || Request::is('companies') || Request::is('companyUsers/*') || Request::is('companyUsers')) ? 'active' : '' }}"><a href="{{ url('/companies') }}">Manage Companies</a></li>
                                    <li class="{{ ( Request::is('reports/*') || Request::is('reports') ) ? 'active' : '' }}"><a href="{{ url('/reports') }}">Reports</a></li>
                                    @elseif(Auth::user()->role->id == 3 )
                                    <li class="{{ ( Request::is('companyUsers/*') || Request::is('companyUsers') ) ? 'active' : '' }}"><a href="{{ url('/') }}">Manage Users</a></li>
                                    <li class="{{ ( Request::is('goalSettings/*') || Request::is('goalSettings') ) ? 'active' : '' }}"><a href="{{ url('/goalSettings') }}">Goal Setting</a></li>
                                    <li class="{{ ( Request::is('myStats/*') || Request::is('myStats') ) ? 'active' : '' }}"><a href="{{ url('/myStats') }}">My Stats</a></li>
                                    <li class="{{ ( Request::is('prodSales/*') || Request::is('prodSales') ) ? 'active' : '' }}"><a href="{{ url('/prodSales') }}">Production | Sales Revenue</a></li>
                                    <li class="{{ ( Request::is('myRatio/*') || Request::is('myRatio') ) ? 'active' : '' }}"><a href="{{ url('/myRatio') }}">My Ratio</a></li>
                                    <li class="{{ ( Request::is('training/*') || Request::is('training') ) ? 'active' : '' }}"><a href="{{ url('/training') }}">Training</a></li>
                                    @elseif( Auth::user()->role->id == 2 )
                                    <li class="{{ ( Request::is('myStats/*') || Request::is('myStats') ) ? 'active' : '' }}"><a href="{{ url('/myStats') }}">My Stats</a></li>
                                    <li class="{{ ( Request::is('prodSales/*') || Request::is('prodSales') ) ? 'active' : '' }}"><a href="{{ url('/prodSales') }}">Production | Sales Revenue</a></li>
                                    <li class="{{ ( Request::is('myRatio/*') || Request::is('myRatio') ) ? 'active' : '' }}"><a href="{{ url('/myRatio') }}">My Ratio</a></li>
                                    <li class="{{ ( Request::is('training/*') || Request::is('training') ) ? 'active' : '' }}"><a href="{{ url('/training') }}">Training</a></li>
                                    @elseif( Auth::user()->role->id == 4)
                                    <li class="{{ ( Request::is('companyUsers/*') || Request::is('companyUsers') ) ? 'active' : '' }}"><a href="{{ url('/') }}">Manage Users</a></li>
                                    <li class="{{ ( Request::is('goalSettings/*') || Request::is('goalSettings') ) ? 'active' : '' }}"><a href="{{ url('/goalSettings') }}">Goal Setting</a></li>
                                    <li class="{{ ( Request::is('myStats/*') || Request::is('myStats') ) ? 'active' : '' }}"><a href="{{ url('/myStats') }}">My Stats</a></li>
                                    <li class="{{ ( Request::is('prodSales/*') || Request::is('prodSales') ) ? 'active' : '' }}"><a href="{{ url('/prodSales') }}">Production | Sales Revenue</a></li>
                                    <li class="{{ ( Request::is('myRatio/*') || Request::is('myRatio') ) ? 'active' : '' }}"><a href="{{ url('/myRatio') }}">My Ratio</a></li>
                                    <li class="{{ ( Request::is('licenses/shoppingcart*') || Request::is('myLicences') ) ? 'active' : '' }}"><a href="{{ url('/licenses/shoppingcart') }}">Order Licenses</a></li>
                                    <li class="{{ ( Request::is('training/*') || Request::is('training') ) ? 'active' : '' }}"><a href="{{ url('/training') }}">Training</a></li>
                                    <li class="{{ ( Request::is('licenses/list*') || Request::is('myLicences') ) ? 'active' : '' }}"><a href="{{ url('/licenses/list/'.Auth::user()->company->id) }}">Manage Licenses</a></li>
                                    @endif
                                    @endif
                                </ul>


                                <ul class="nav navbar-nav navbar-right">
                                    @if (Session::has('support') )
                                    <li class="active">
                                        <a href="#" style="color: yellow; font-weight: bold;">Support Standpoint</a>
                                    </li>
                                    @endif
                                    @if (! Auth::guest() )
                                    @if (Session::has('support') )
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Logged in as {{ Auth::user()->first_name }} by Admin <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ url('/myprofile') }}">MyProfile</a></li>
                                            <li><a href="{{ url('/users/exitSupport') }}">Exit from Support Standpoint</a></li>
                                        </ul>
                                    </li>
                                    @else
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Logged in as {{ Auth::user()->first_name }} <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ url('/myprofile') }}">MyProfile</a></li>
                                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                                        </ul>
                                    </li>
                                    @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                        
                    </nav>
                    <div id="godown"></div>
                </div>
            </div>
        </div>
        
<div class="container-fluid" id="main-content">
            @yield('content')
</div>
        <div class="container-fluid">
            <footer>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center back-to-top">
                        <a class="btn btn-default" href="#top">Back to top</a>
                    </div>
                    <br /><br /><br />
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="list-unstyled">
                            <li>
                                <div class="footer-copyright">
                                    <div class="container text-center">
                                        Sales Performance Indicator | &copy; 2015 Good as Gold Training, All rights reserved.<br />
                                        <a class="grey-text text-lighten-4 right" href="mailto:support@staffingandrecruiting.com">support@staffingandrecruiting.com | 219 663 9609</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </footer>
        </div>    
        <!-- Scripts -->
        @yield('footer')
    </body>
</html>