@extends('app')

@section('content')

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2>You have scored {{ empty( $today_total->total ) ? '0' : $today_total->total }} points so far today ( {{ empty($today_total->total) ? '0' : $today_total->date }} ). <br>Your goal is {{ $today_target->target }}.</h2>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            @if( !empty($message) )
                <div class="alert alert-dismissible {{ $isErr ? 'alert-danger' : 'alert-success' }}">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {!!$message!!}
                </div>
            @endif

            <ul class="nav nav-tabs">
                @foreach( $task_types as $task_type )
                    <li class="{{ ( $activeTab == $task_type->id ) ? 'active' : ''  }}">
                        <a href="#{{ $task_type->id }}" data-toggle="tab">{{ $task_type->name }}</a>
                    </li>
                @endforeach
                <li class="{{ ( $activeTab == 'sales' ) ? 'active' : ''  }}">
                    <a href="#sales" data-toggle="tab">Sales</a>
                </li>
            </ul>
            <br/>
            <div id="myTabContent" class="tab-content">

                @foreach( $task_types as $task_type )
                    <div class="tab-pane fade {{ ( $activeTab == $task_type->id ) ? 'active in' : ''  }}" id="{{ $task_type->id }}">
                        <div class="row ">
                            @foreach( $task_type->getTasks() as $task )
                                <div class="col-lg-4">
                                    <div class="bs-component">
                                        <div class="panel panel-default">
                                            <div class="panel-body"  style="height: 250px;">
                                                <div class="col-lg-3">
                                                    <img src="{{ asset('/images/'.$task->icon) }}">
                                                </div>
                                                <div class="col-lg-9">
                                                    <h4>{{ $task->name }} {!! $task->getTodayPoints( ) !!} </h4>
                                                    <span href="#" class="btn btn-primary btn-xs">{{ $task->value }} Points</span>
                                                    <p><small>{{ $task->description }}</small></p>
                                                    <form class="form-horizontal" role="form" method="post" action="{{ url('/myStats/add') }}">
                                                        <div class="form-group">
                                                            <div class="col-lg-10 col-lg-offset-2">
                                                                <div class="input-group">
                                                                    {!! Form::text('point', null, ['class' => 'form-control']) !!}
                                                            <span class="input-group-btn">
                                                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                                {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                                                                {!! Form::hidden('task_id', $task->id) !!}
                                                                {!! Form::hidden('task_type_id', $task_type->id) !!}
                                                            </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="tab-pane fade {{ ( $activeTab == 'sales' ) ? 'active in' : ''  }}" id="sales">
                    <div class="row ">
                        @foreach( $sales as $sale )
                            <div class="col-lg-4">
                                <div class="bs-component">
                                    <div class="panel panel-default">
                                        <div class="panel-body"  style="height: 250px;">
                                            <div class="col-lg-3">
                                                <img src="{{ asset('/images/'.$sale->icon ) }}">
                                            </div>
                                            <div class="col-lg-9">
                                                <h4>{{ $sale->name }} {!! $sale->getTodaySales( ) !!} </h4>
                                                <p><small>{{ $sale->description }}</small></p>
                                                <form class="form-horizontal" role="form" method="post" action="{{ url('/myStats/addSales') }}">
                                                    <div class="form-group">
                                                        <div class="col-lg-10 col-lg-offset-2">
                                                            <div class="input-group">
                                                                {!! Form::text('sales', null, ['class' => 'form-control']) !!}
                                                            <span class="input-group-btn">
                                                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                                {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                                                                {!! Form::hidden('sale_id', $sale->id) !!}
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection