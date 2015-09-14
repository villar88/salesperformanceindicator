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

                
                @include('companyUser/_companyuserlist');
            </div>
        </div>


@endsection