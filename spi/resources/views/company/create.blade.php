@extends('app')

@section('content')

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2>Create New Company</h2>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-body">

                        <div class="col-md-10 col-md-offset-1">

                            @include('_error')

                            {!! Form::open(['route' => ['companies.store'], 'class' => 'form-horizontal']) !!}
                                @include('company._form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>


            </div>
        </div>

@endsection