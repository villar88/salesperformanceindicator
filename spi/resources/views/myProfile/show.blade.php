@extends('app')

@section('content')

<div class="page-header" id="banner">
                <div class="row">
					<div class="col-md-12">
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
                            @include('_message')

                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/myProfile/update') }}">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                @include('myProfile._form')
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>

@endsection