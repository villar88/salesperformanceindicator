<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Metrics Solution</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="{{ asset('/images/modLogo.png') }}" /></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
                    @if (! Auth::guest() )
                        @if( Auth::user()->role->id == 1 )
                            <li class="{{ ( Request::is('users/*') || Request::is('users') ) ? 'active' : '' }}"><a href="{{ url('/') }}">Manage Users</a></li>
                            <li class="{{ ( Request::is('companies/*') || Request::is('companies') || Request::is('companyUsers/*') || Request::is('companyUsers')) ? 'active' : '' }}"><a href="{{ url('/companies') }}">Manage Companies</a></li>
                        @elseif( Auth::user()->role->id == 4 || Auth::user()->role->id == 3 )
                            <li class="{{ ( Request::is('companyUsers/*') || Request::is('companyUsers') ) ? 'active' : '' }}"><a href="{{ url('/') }}">Manage Users</a></li>
                            <li class="{{ ( Request::is('goalSettings/*') || Request::is('goalSettings') ) ? 'active' : '' }}"><a href="{{ url('/goalSettings') }}">Goal Setting</a></li>
                            <li class="{{ ( Request::is('myStats/*') || Request::is('myStats') ) ? 'active' : '' }}"><a href="{{ url('/myStats') }}">My Stats</a></li>
                            <li class="{{ ( Request::is('prodSales/*') || Request::is('prodSales') ) ? 'active' : '' }}"><a href="{{ url('/prodSales') }}">Production | Sales Revenue</a></li>
                            <li class="{{ ( Request::is('myRatio/*') || Request::is('myRatio') ) ? 'active' : '' }}"><a href="{{ url('/myRatio') }}">My Ratio</a></li>
                        @elseif( Auth::user()->role->id == 2 )
                            <li class="{{ ( Request::is('myStats/*') || Request::is('myStats') ) ? 'active' : '' }}"><a href="{{ url('/myStats') }}">My Stats</a></li>
                            <li class="{{ ( Request::is('prodSales/*') || Request::is('prodSales') ) ? 'active' : '' }}"><a href="{{ url('/prodSales') }}">Production | Sales Revenue</a></li>
                            <li class="{{ ( Request::is('myRatio/*') || Request::is('myRatio') ) ? 'active' : '' }}"><a href="{{ url('/myRatio') }}">My Ratio</a></li>
                        @endif
                    @endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (! Auth::guest() )
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Logged in as {{ Auth::user()->first_name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/myprofile') }}">MyProfile</a></li>
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

    <div class="container-fluid">

        @yield('content')
        <footer>
            <div class="row">
                <div class="col-lg-12">

                    <ul class="list-unstyled">
                        <li class="pull-right"><a href="#top">Back to top</a></li>
                        <li>
                            <div class="footer-copyright">
                                <div class="container text-center">
                                    Sales Performance Indicator | &copy; 2014-2015 Good as Gold Training, All rights reserved.
                                    <a class="grey-text text-lighten-4 right" href="mailto:support@staffingandrecruiting.com">
                                        support@staffingandrecruiting.com | 219 663 9609</a>
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('/css/bootswatch.min.css')}}">

</body>
</html>
