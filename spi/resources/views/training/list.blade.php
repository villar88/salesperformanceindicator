@extends('app')

@section('content')
    <div class="container-fluid text-center">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h1 class="marg-top-30">Welcome to our training area!</h1>
			</div>
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                        @if( Auth::user()->role->id == 2)
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="description" style="font-size: x-large; font-weight: bold;">Welcome Video Member</p>
			</div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="embed-responsive embed-responsive-16by9">
						    <iframe width="560" height="315" src="https://www.youtube.com/embed/9z9ZKwMfZjc?rel=0" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
				</div>
			</div>
                        @endif
                        @if( Auth::user()->role->id == 3)
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<p class="description" style="font-size: x-large; font-weight: bold;">Welcome Video Manager</p>
			</div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="embed-responsive embed-responsive-16by9">
						    <iframe width="560" height="315" src="https://www.youtube.com/embed/Xg02eW82bVY?rel=0" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
				</div>
			</div>
                        @endif
                        @if( Auth::user()->role->id == 4 )
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <p class="description" style="font-size: x-large; font-weight: bold;">Welcome Video Owner</p>
			</div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="embed-responsive embed-responsive-16by9">
						    <iframe width="560" height="315" src="https://www.youtube.com/embed/iSzWthfNjpw?rel=0" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
				</div>
			</div>
                        @endif
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 vcenter">
				<p class="description" style="font-size: x-large; font-weight: bold;">Instructional Video # 2: Recruiter</p>
			</div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="embed-responsive embed-responsive-16by9">
						    <iframe width="560" height="315" src="https://www.youtube.com/embed/SdNGX9rtBLg?rel=0" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
				</div>
			</div>
                        
			
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 vcenter">
				<p class="description"  style="font-size: x-large; font-weight: bold;">Instructional Video # 3: Client Development Inside</p>
			</div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="embed-responsive embed-responsive-16by9">
						    <iframe width="560" height="315" src="https://www.youtube.com/embed/gbFyv29U5Pc?rel=0" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
				</div>
			</div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 vcenter">
				<p class="description" style="font-size: x-large; font-weight: bold;">Instructional Video # 4:Client Development Outside</p>
			</div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="embed-responsive embed-responsive-16by9">
						    <iframe width="560" height="315" src="https://www.youtube.com/embed/HiV4UbMEUDY?rel=0" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
				</div>
			</div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 vcenter">
				<p class="description" style="font-size: x-large; font-weight: bold;">Instructional Video # 5:Stats, Points, Ratios, Production</p>
			</div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="embed-responsive embed-responsive-16by9">
						    <iframe width="560" height="315" src="https://www.youtube.com/embed/9uySrhiajns?rel=0" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
				</div>
			</div>
                        @if( Auth::user()->role->id == 3 || Auth::user()->role->id == 4)
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 vcenter">
				<p class="description" style="font-size: x-large; font-weight: bold;">Instructional Video # 6: Management Users and Reports</p>
			</div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="embed-responsive embed-responsive-16by9">
						    <iframe width="560" height="315" src="https://www.youtube.com/embed/rL0yulk5eBA?rel=0" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
				</div>
			</div>
                        @endif
                        <br><br><br>
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
		</div>
    </div>

@endsection