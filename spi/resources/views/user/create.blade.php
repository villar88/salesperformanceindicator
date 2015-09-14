@extends('app')

@section('content')

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-md-12">
                <h2>Create New User</h2>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-body">

                        <div class="col-md-10 col-md-offset-1">

                            @include('_error')

                            {!! Form::open(['route' => ['users.store'], 'class' => 'form-horizontal']) !!}
                                @include('user._form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>


            </div>
        </div>

@endsection