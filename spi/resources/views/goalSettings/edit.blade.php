@extends('app')

@section('content')

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2>Modify Goals for {{ $user->last_name }}, {{$user->first_name}}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        @include('_error')
                        {!! Form::model($goalSetting, ['route' => ['goalSettings.update', $goalSetting->id], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}

                            <div class="form-group {{ $errors->has('jan') ? 'has-error' : '' }}">
                                {!! Form::label('jan', 'January*', ['class' => 'col-lg-2 control-label']) !!}
                                <div class="col-lg-2">{!! Form::text('jan', null, ['class' => 'form-control']) !!}</div>
                            </div>
                            <div class="form-group {{ $errors->has('feb') ? 'has-error' : '' }}">
                                {!! Form::label('feb', 'February*', ['class' => 'col-lg-2 control-label']) !!}
                                <div class="col-lg-2">{!! Form::text('feb', null, ['class' => 'form-control']) !!}</div>
                            </div>
                            <div class="form-group {{ $errors->has('mar') ? 'has-error' : '' }}">
                                {!! Form::label('mar', 'March*', ['class' => 'col-lg-2 control-label']) !!}
                                <div class="col-lg-2">{!! Form::text('mar', null, ['class' => 'form-control']) !!}</div>
                            </div>
                            <div class="form-group {{ $errors->has('apr') ? 'has-error' : '' }}">
                                {!! Form::label('apr', 'April*', ['class' => 'col-lg-2 control-label']) !!}
                                <div class="col-lg-2">{!! Form::text('apr', null, ['class' => 'form-control']) !!}</div>
                            </div>
                            <div class="form-group {{ $errors->has('may') ? 'has-error' : '' }}">
                                {!! Form::label('may', 'May*', ['class' => 'col-lg-2 control-label']) !!}
                                <div class="col-lg-2">{!! Form::text('may', null, ['class' => 'form-control']) !!}</div>
                            </div>
                            <div class="form-group {{ $errors->has('jun') ? 'has-error' : '' }}">
                                {!! Form::label('jun', 'June*', ['class' => 'col-lg-2 control-label']) !!}
                                <div class="col-lg-2">{!! Form::text('jun', null, ['class' => 'form-control']) !!}</div>
                            </div>
                            <div class="form-group {{ $errors->has('jul') ? 'has-error' : '' }}">
                                {!! Form::label('jul', 'July*', ['class' => 'col-lg-2 control-label']) !!}
                                <div class="col-lg-2">{!! Form::text('jul', null, ['class' => 'form-control']) !!}</div>
                            </div>
                            <div class="form-group {{ $errors->has('aug') ? 'has-error' : '' }}">
                                {!! Form::label('aug', 'August*', ['class' => 'col-lg-2 control-label']) !!}
                                <div class="col-lg-2">{!! Form::text('aug', null, ['class' => 'form-control']) !!}</div>
                            </div>
                            <div class="form-group {{ $errors->has('sep') ? 'has-error' : '' }}">
                                {!! Form::label('sep', 'September*', ['class' => 'col-lg-2 control-label']) !!}
                                <div class="col-lg-2">{!! Form::text('sep', null, ['class' => 'form-control']) !!}</div>
                            </div>
                        <div class="form-group {{ $errors->has('oct') ? 'has-error' : '' }}">
                            {!! Form::label('oct', 'October*', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-2">{!! Form::text('oct', null, ['class' => 'form-control']) !!}</div>
                        </div>
                        <div class="form-group {{ $errors->has('nov') ? 'has-error' : '' }}">
                            {!! Form::label('nov', 'November*', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-2">{!! Form::text('nov', null, ['class' => 'form-control']) !!}</div>
                        </div>
                        <div class="form-group {{ $errors->has('dec') ? 'has-error' : '' }}">
                            {!! Form::label('dec', 'December*', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-2">{!! Form::text('dec', null, ['class' => 'form-control']) !!}</div>
                        </div>

                        <div class="form-group {{ $errors->has('direct_hire') ? 'has-error' : '' }}">
                            {!! Form::label('direct_hire', 'Direct Hire*', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-2">{!! Form::text('direct_hire', null, ['class' => 'form-control']) !!}</div>
                        </div>

                        <div class="form-group {{ $errors->has('gmp') ? 'has-error' : '' }}">
                            {!! Form::label('dec', 'GMP*', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-2">{!! Form::text('gmp', null, ['class' => 'form-control']) !!}</div>
                        </div>


                        {!! Form::hidden('updated_by', Auth::user()->id) !!}

                        <div class="form-group">
                            <div class="col-lg-3 col-lg-offset-2">
                                <a href="{{ url('/goalSettings') }}" class="btn btn-default pull-right">Cancel</a>
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection