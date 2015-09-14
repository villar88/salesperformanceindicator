@extends('app')

@section('content')
    <style>


        .table input[type="text"] {
            font-size: 12px !important;
            width: 80px !important;
        }

        .userCol
        {
            min-width: 150px;
            font-size: 10px !important;
        }

    </style>

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h2>Goal Setting</h2>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <script type="text/javascript">

                    function setRequest(arg)
                    {
                        $("#request").val(arg);
                    }


                </script>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><h3>Filter</h3></div>
                    <div class="panel-body">
                        <div class="col-md-10 col-md-offset-1">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/goalSettings/search') }}">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <input type="hidden" id="request" name="request" value="" />
                                <fieldset>

                                    <div class="input-group">
                                        <input name="keyword" type="text" class="form-control" value="{{ $keyword }}"/>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary" value="Search" onclick="setRequest('search')">Search</button>
                                        <button type="submit" class="btn btn-default" value="Show_All"  onclick="setRequest('showAll')">Show All</button>
                                        <button type="submit" class="btn btn-success" value="Excel"  onclick="setRequest('excel')">Export to Excel</button>
                                    </span>
                                    </div>
                                    <span>Please enter Email, First or Last Name of the User.</span>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h3>Daily Goals for each Month</h3>
                    </div>
                    <div class="panel-body">
                        @include('_message')
                        <!-- Table -->
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/goalSettings/updateAll') }}" onsubmit="checkValues();" id="goalForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="responsive">
                            <table class="table" >
                            <thead>
                            <tr>
                                <th></th>
                                <th class="userCol">User</th>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>May</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Aug</th>
                                <th>Sept</th>
                                <th>Oct</th>
                                <th>Nov</th>
                                <th>Dec</th>
                                <th>Annual</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach ($users as $user)
                                <tr>
                                    <td><input type="checkbox" id="_id{{$user->id}}"  name="_id[{{$user->id}}]"  value="{{$user->id}}"/></td>
                                    <!--...--><td><a href="{{ url('/goalSettings/edit/'.$user->goalManagement->id) }}">{{$user->first_name}} {{$user->last_name}}</a></td>
                                    <td><input onblur="cleanup( 'jan', '{{$user->id}}','{{number_format($user->goalManagement->jan, 2, '.', ',')}}' )" type="text" name="jan[{{$user->id}}]" id="jan{{$user->id}}" value="{{number_format($user->goalManagement->jan, 2, '.', ',')}}"/></td>
                                    <td><input onblur="cleanup( 'feb', '{{$user->id}}','{{number_format($user->goalManagement->feb, 2, '.', ',')}}' )" type="text" name="feb[{{$user->id}}]" id="feb{{$user->id}}" value="{{number_format($user->goalManagement->feb, 2, '.', ',')}}"/></td>
                                    <td><input onblur="cleanup( 'mar', '{{$user->id}}','{{number_format($user->goalManagement->mar, 2, '.', ',')}}' )" type="text" name="mar[{{$user->id}}]" id="mar{{$user->id}}" value="{{number_format($user->goalManagement->mar, 2, '.', ',')}}"/></td>
                                    <td><input onblur="cleanup( 'apr', '{{$user->id}}','{{number_format($user->goalManagement->apr, 2, '.', ',')}}' )" type="text" name="apr[{{$user->id}}]" id="apr{{$user->id}}" value="{{number_format($user->goalManagement->apr, 2, '.', ',')}}"/></td>
                                    <td><input onblur="cleanup( 'may', '{{$user->id}}','{{number_format($user->goalManagement->may, 2, '.', ',')}}' )" type="text" name="may[{{$user->id}}]" id="may{{$user->id}}" value="{{number_format($user->goalManagement->may, 2, '.', ',')}}"/></td>
                                    <td><input onblur="cleanup( 'jun', '{{$user->id}}','{{number_format($user->goalManagement->jun, 2, '.', ',')}}' )" type="text" name="jun[{{$user->id}}]" id="jun{{$user->id}}" value="{{number_format($user->goalManagement->jun, 2, '.', ',')}}"/></td>
                                    <td><input onblur="cleanup( 'jul', '{{$user->id}}','{{number_format($user->goalManagement->jul, 2, '.', ',')}}' )" type="text" name="jul[{{$user->id}}]" id="jul{{$user->id}}" value="{{number_format($user->goalManagement->jul, 2, '.', ',')}}"/></td>
                                    <td><input onblur="cleanup( 'aug', '{{$user->id}}','{{number_format($user->goalManagement->aug, 2, '.', ',')}}' )" type="text" name="aug[{{$user->id}}]" id="aug{{$user->id}}" value="{{number_format($user->goalManagement->aug, 2, '.', ',')}}"/></td>
                                    <td><input onblur="cleanup( 'sep', '{{$user->id}}','{{number_format($user->goalManagement->sep, 2, '.', ',')}}' )" type="text" name="sep[{{$user->id}}]" id="sep{{$user->id}}" value="{{number_format($user->goalManagement->sep, 2, '.', ',')}}"/></td>
                                    <td><input onblur="cleanup( 'oct', '{{$user->id}}','{{number_format($user->goalManagement->oct, 2, '.', ',')}}' )" type="text" name="oct[{{$user->id}}]" id="oct{{$user->id}}" value="{{number_format($user->goalManagement->oct, 2, '.', ',')}}"/></td>
                                    <td><input onblur="cleanup( 'nov', '{{$user->id}}','{{number_format($user->goalManagement->nov, 2, '.', ',')}}' )" type="text" name="nov[{{$user->id}}]" id="nov{{$user->id}}" value="{{number_format($user->goalManagement->nov, 2, '.', ',')}}"/></td>
                                    <td><input onblur="cleanup( 'dec', '{{$user->id}}','{{number_format($user->goalManagement->dec, 2, '.', ',')}}' )" type="text" name="dec[{{$user->id}}]" id="dec{{$user->id}}" value="{{number_format($user->goalManagement->dec, 2, '.', ',')}}"/></td>
                                    <td><input type="text" name="annual[{{$user->id}}]" id="annual{{$user->id}}" value="{{number_format($user->goalManagement->annual, 2, '.', ',')}}" disabled="disabled"/></td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                                </div>
                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-11">
                                    <button type="submit" class="btn btn-primary">Update Checked</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-2 col-md-offset-5"><?php echo $users->render(); ?></div>
                    </div>

                </div>


            </div>
        </div>

    <script type="application/javascript">

        function cleanup( nkey, nid, oldVal )
        {
            try {
            if( document.getElementById(nkey+nid).value != oldVal ){
                document.getElementById('_id'+nid).checked=true;
                document.getElementById('annual'+nid).value = computeAnnual( nid );
                document.getElementById(nkey+nid).value = numberWithCommas( cleanMoney(document.getElementById(nkey+nid).value) );

            }
            }catch (err){alert( err )}
        }

        function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }

        function cleanMoney( ncurr )
        {
            return ncurr.replace(/[ ]*,[ ]*|[ ]+/g, '');
        }

        function computeAnnual( nid )
        {
            try {
                return numberWithCommas(
                        parseFloat( cleanMoney( document.getElementById('jan' + nid).value) ) +
                        parseFloat( cleanMoney( document.getElementById('feb' + nid).value) ) +
                        parseFloat( cleanMoney( document.getElementById('mar' + nid).value) ) +
                        parseFloat( cleanMoney( document.getElementById('apr' + nid).value) ) +
                        parseFloat( cleanMoney( document.getElementById('may' + nid).value) ) +
                        parseFloat( cleanMoney( document.getElementById('jun' + nid).value) ) +
                        parseFloat( cleanMoney( document.getElementById('jul' + nid).value) ) +
                        parseFloat( cleanMoney( document.getElementById('aug' + nid).value) ) +
                        parseFloat( cleanMoney( document.getElementById('sep' + nid).value) ) +
                        parseFloat( cleanMoney( document.getElementById('oct' + nid).value) ) +
                        parseFloat( cleanMoney( document.getElementById('nov' + nid).value) ) +
                        parseFloat( cleanMoney( document.getElementById('dec' + nid).value) ) )
            }catch (err){alert( err )}
        }

    </script>

@endsection