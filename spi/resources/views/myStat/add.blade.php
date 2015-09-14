@extends('app')

@section('content')
    <br/>
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-7">
                <h3>You have scored {{ empty( $today_total->total ) ? '0' : number_format($today_total->total) }} points so far today ( {{ empty($today_total->total) ? '0' : $today_total->date }} ). <br>Your minimum daily goal is {{ $today_target }}.</h3>
            </div>
			<div class="col-lg-5"><br><img src="{{ asset('/images/stop.png') }}"> <a href="{{ url('/training') }}">View the Training Videos before entering your stats for the first time
</a></div>
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
            @if( isset($location) )
            <script type="text/javascript">
                window.onload = function(){
                    $('<?php echo $location; ?>').focus();
                 }
            </script>
            @endif

            <ul class="nav nav-tabs">
                @foreach( $task_types as $task_type )
                    <li class="{{ ( $activeTab == $task_type->id ) ? 'active' : ''  }}">
                        <a href="#{{ $task_type->id }}" data-toggle="tab">{{ $task_type->name }} </a>
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
                                                <div class="col-lg-3 text-center">
                                                    <img src="{{ asset('/images/'.$task->icon) }}">
                                                </div>
                                                <div class="col-lg-8 col-lg-offset-1">
                                                    <h4>{{ $task->name }} <nobr>({{ $task->getTodayPoints() }})</nobr></h4>
                                                    <span href="#" class="btn btn-primary btn-xs">{{ $task->value }} Points</span>
                                                    <p><small>{{ $task->description }}</small></p>
                                                    <form class="form-horizontal" role="form" method="post" action="{{ url('/myStats/add') }}">
                                                        <div class="form-group">
                                                            <div class="col-lg-10 col-lg-offset-2">
                                                                <div class="input-group">
                                                                    {!! Form::text('point', null, ['class' => 'form-control','id'=>'point_'.$task->id]) !!}
                                                                        <span class="input-group-btn">
                                                                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                                            {!! Form::submit('Submit', ['class' => 'btn btn-success','onClick' => 'if(!confirm("Do you want to add "+$(point).val()+" '.$task->name.'  to your daily total?")){$(point).val("");return false; };']) !!}
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
                            @foreach( $saleTypes as $saleType )
                                <div class="col-lg-4">
                                    <div class="bs-component">
                                        <div class="panel panel-default">
                                            <div class="panel-body"  style="height: 250px;">
                                                <div class="col-lg-3">
                                                    <img src="{{ asset('/images/'.$saleType->icon ) }}">
                                                </div>
                                                <div class="col-lg-9">
                                                    <h4>{{ $saleType->name }} {!! $saleType->getTodaySales( ) !!} </h4>
                                                    <p><small>{{ $saleType->description }}</small></p>
                                                    <form class="form-horizontal" role="form" method="post" action="{{ url('/myStats/addSales') }}">
                                                        <div class="form-group">
                                                            <div class="col-lg-10 col-lg-offset-2">
                                                                <div class="input-group">
                                                                    {!! Form::text('sales', null, ['class' => 'form-control']) !!}
                                                            <span class="input-group-btn">
                                                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                                {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                                                                {!! Form::hidden('saleType_id', $saleType->id) !!}
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