@extends('app')

@section('content')

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2>Modify License of  {{ $company->name }}</h2>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">

                    <div class="panel-body">

                        <div class="col-md-10 col-md-offset-1">

                            @include('_error')

                            {!! Form::model($license, ['route' => ['licenses.update', $license->id], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
                            @include('licenses._form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>


            </div>
        </div>

@endsection