@extends('app')

@section('content')

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2>Modify User {{ $user->last_name }}, {{$user->first_name}}</h2>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-10 col-md-offset-1">
                            @include('_error')
                            {!! Form::model($user, ['route' => ['companyUsers.update', $user->id], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                                @include('companyUser._form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection