@extends('prelogin')

@section('content')
<div class="row">
    <div class="hidden-xs col-sm-2 col-md-3 col-lg-3"></div>
    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 vcenter">
                            <label class="control-label label-vcenter">E-Mail Address</label>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 vcenter">
                            <label class="control-label label-vcenter">Password</label>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group" >
                        <div class="col-md-4"></div>
                        <div class="col-md-7" >
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="form-group"> 
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="hidden-xs col-sm-2 col-md-3 col-lg-3"></div>
</div>
@endsection
