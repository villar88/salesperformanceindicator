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
<link rel="StyleSheet" href="https://salesperformanceindicator.com/testTemplates/fixes.css" type="text/css">


            <div class="page-header" id="banner">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="gs-new-h2">Goal Setting</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading"><h3 class="gs-new-h3">Filter</h3></div>
                        <div class="panel-body gs-new-search-body">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/goalSettings/search') }}">
                                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                    <input type="hidden" id="request" name="request" value="" />
                                    <fieldset>

                                        <div class="input-group hidden-xs">
                                            <input name="keyword" type="text" class="form-control" value="{{ $keyword }}" placeholder="Please enter Email, First or Last Name of the User" />
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary gs-new-button-search" value="Search" onclick="setRequest('search')">Search</button>
                                                <button type="submit" class="btn btn-success gs-new-button-export" value="Excel"  onclick="setRequest('excel')">Export to Excel</button>
                                            </span>
                                        </div>
                                        <div class="input-group hidden-sm hidden-md hidden-lg">
                                                <input name="keyword" type="text" class="form-control" value="{{ $keyword }}" placeholder="Please enter Email, First or Last Name of the User" />
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary gs-new-button-search" value="Search" onclick="setRequest('search')">Search</button>
                                                    <button type="submit" class="btn btn-success gs-new-button-export" value="Excel"  onclick="setRequest('excel')">Export to Excel</button>
                                                </span>

                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="gs-new-h3">Daily Goals for each Month</h3>
                        </div>
                        <div class="panel-body">
                            @include('_message')
                            <!-- Table -->
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/goalSettings/updateAll') }}" onsubmit="checkValues();" id="goalForm">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
                                <div class="responsive">
                                    <div class="outer-container">
                                        <table class="gs-new-table pos-absolute">
                                            <tr>
                                                <th class="fixed-main-th-big">Name</th>
                                                <th class="fixed-main-th-small">Annual</th>
                                                <th class="vertical-table-separator top-bordered"></th>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="table-hor-separator"></td>
                                                <td class="empty-fix"></td>
                                            </tr>
                                            @foreach ($users as $user)
                                            <tr>
                                                <td class="fixed-main-th-big"><a href="{{ url('/goalSettings/edit/'.$user->goalManagement->id) }}" class="gs-new-user-link"> {{ (strlen($user->first_name.' '.$user->last_name)>10)?substr(($user->first_name.' '.$user->last_name), 0 , 18) : $user->first_name.' '.$user->last_name }}</a></td>
                                                <td class="fixed-main-th-small"><input onblur="calcAnnual( 'annual' , '{{$user->id}}' ,'{{$user->goalManagement->id}}' )" value="{{number_format($user->goalManagement->annual, 2, '.', ',')}}" id="annual{{$user->id}}" type="text" class="gs-new-input" style="width: 85px;"/> </td>
                                                <td class="vertical-table-separator"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="table-hor-separator"></td>
                                                <td class="empty-fix"></td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        <div class="inner-container">
                                            <table class="gs-new-table">
                                                <tr class="gs-new-table-row-moving">
                                                    <th>January</th>
                                                    <th>Ferbruary</th>
                                                    <th>March</th>
                                                    <th>April</th>
                                                    <th>May</th>
                                                    <th>June</th>
                                                    <th>July</th>
                                                    <th>August</th>
                                                    <th>September</th>
                                                    <th>October</th>
                                                    <th>November</th>
                                                    <th>December</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="12" class="table-hor-separator-mov"></td>
                                                </tr>
                                                @foreach ($users as $user)
                                                    <tr class="gs-new-table-row-moving">
                                                        <td class="fixed-td-small">
                                                            <!--<input type="text" value="888888888" class="gs-new-input">-->
                                                            <input onblur="cleanup('jan', '{{$user->id}}','{{number_format($user->goalManagement->jan, 2, '.', ',')}}','{{$user->goalManagement->id}}' )" type="text" name="jan[{{$user->id}}]" id="jan{{$user->id}}" value="{{number_format($user->goalManagement->jan, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                        <td>
                                                            <input onblur="cleanup('feb', '{{$user->id}}','{{number_format($user->goalManagement->feb, 2, '.', ',')}}','{{$user->goalManagement->id}}' )" type="text" name="feb[{{$user->id}}]" id="feb{{$user->id}}" value="{{number_format($user->goalManagement->feb, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                        <td>
                                                            <input onblur="cleanup('mar', '{{$user->id}}','{{number_format($user->goalManagement->mar, 2, '.', ',')}}','{{$user->goalManagement->id}}' )" type="text" name="mar[{{$user->id}}]" id="mar{{$user->id}}" value="{{number_format($user->goalManagement->mar, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                        <td>
                                                            <input onblur="cleanup('apr', '{{$user->id}}','{{number_format($user->goalManagement->apr, 2, '.', ',')}}' ,'{{$user->goalManagement->id}}')" type="text" name="apr[{{$user->id}}]" id="apr{{$user->id}}" value="{{number_format($user->goalManagement->apr, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                        <td>
                                                            <input onblur="cleanup('may', '{{$user->id}}','{{number_format($user->goalManagement->may, 2, '.', ',')}}','{{$user->goalManagement->id}}' )" type="text" name="may[{{$user->id}}]" id="may{{$user->id}}" value="{{number_format($user->goalManagement->may, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                        <td>
                                                            <input onblur="cleanup('jun', '{{$user->id}}','{{number_format($user->goalManagement->jun, 2, '.', ',')}}','{{$user->goalManagement->id}}' )" type="text" name="jun[{{$user->id}}]" id="jun{{$user->id}}" value="{{number_format($user->goalManagement->jun, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                        <td>
                                                            <input onblur="cleanup('jul', '{{$user->id}}','{{number_format($user->goalManagement->jul, 2, '.', ',')}}','{{$user->goalManagement->id}}' )" type="text" name="jul[{{$user->id}}]" id="jul{{$user->id}}" value="{{number_format($user->goalManagement->jul, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                        <td>
                                                            <input onblur="cleanup('aug', '{{$user->id}}','{{number_format($user->goalManagement->aug, 2, '.', ',')}}','{{$user->goalManagement->id}}' )" type="text" name="aug[{{$user->id}}]" id="aug{{$user->id}}" value="{{number_format($user->goalManagement->aug, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                        <td>
                                                            <input onblur="cleanup('sep', '{{$user->id}}','{{number_format($user->goalManagement->sep, 2, '.', ',')}}','{{$user->goalManagement->id}}' )" type="text" name="sep[{{$user->id}}]" id="sep{{$user->id}}" value="{{number_format($user->goalManagement->sep, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                        <td>
                                                            <input onblur="cleanup('oct', '{{$user->id}}','{{number_format($user->goalManagement->oct, 2, '.', ',')}}','{{$user->goalManagement->id}}' )" type="text" name="oct[{{$user->id}}]" id="oct{{$user->id}}" value="{{number_format($user->goalManagement->oct, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                        <td>
                                                            <input onblur="cleanup('nov', '{{$user->id}}','{{number_format($user->goalManagement->nov, 2, '.', ',')}}' ,'{{$user->goalManagement->id}}')" type="text" name="nov[{{$user->id}}]" id="nov{{$user->id}}" value="{{number_format($user->goalManagement->nov, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                        <td>
                                                            <input onblur="cleanup('dec', '{{$user->id}}','{{number_format($user->goalManagement->dec, 2, '.', ',')}}','{{$user->goalManagement->id}}' )" type="text" name="dec[{{$user->id}}]" id="dec{{$user->id}}" value="{{number_format($user->goalManagement->dec, 2, '.', ',')}}" class="gs-new-input"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="12" class="table-hor-separator-mov"></td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-2 col-md-offset-5"></div>
                        </div>
                    </div>
                </div>
            </div>
            
<script type="application/javascript">
    
    function calcAnnual( nkey, nid , id_goals ){
        
        var pro = parseFloat( cleanMoney( document.getElementById('annual'+nid).value )) / 12;
         
        var amountRequest = parseFloat( cleanMoney( document.getElementById('annual'+nid).value ));
         
        pro = parseFloat( (pro+'').replace(/,/g, ""))
                .toFixed(2)
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")  ; 
         
        document.getElementById('jan' + nid).value = pro;
        document.getElementById('feb' + nid).value = pro;
        document.getElementById('mar' + nid).value = pro;
        document.getElementById('apr' + nid).value = pro;
        document.getElementById('may' + nid).value = pro;
        document.getElementById('jun' + nid).value = pro;
        document.getElementById('jul' + nid).value = pro;
        document.getElementById('aug' + nid).value = pro;
        document.getElementById('sep' + nid).value = pro;
        document.getElementById('oct' + nid).value = pro;
        document.getElementById('nov' + nid).value = pro;
        document.getElementById('dec' + nid).value = pro; 
        
        document.getElementById('annual'+nid).value = parseFloat( document.getElementById('annual'+nid).value.replace(/,/g, ""))
                .toFixed(2)
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")  ; 
                
        $.ajax({
            url: '{{ url('updateGoals')}}',
            type: "get",
            data: {'id_goals_managers':id_goals, '_token': $('input[name=_token]').val(),month: nkey,amount: amountRequest},
            success: function(data){
              //alert(data); TODO: gestionar monto total
            }
          }); 
    }
    
    function setRequest(arg)
            {
            $("#request").val(arg);
            }

    function cleanup( nkey, nid, oldVal ,id_goals)
    {
        //console.log( nkey+' '+nid+' '+oldVal ); 
        //console.log( document.getElementById(nkey+nid).value  );
        
        if(document.getElementById(nkey + nid).value != ''){
            try {

                if(document.getElementById(nkey+nid).value == ''){
                    document.getElementById(nkey+nid).value = 0;
                }

                document.getElementById('annual'+nid).value = parseFloat(computeAnnual( nid ).replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")  ;

                document.getElementById(nkey+nid).value = parseFloat(numberWithCommas( cleanMoney(document.getElementById(nkey+nid).value) ).replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")  ;


                var amountRequest = parseFloat( cleanMoney( document.getElementById(nkey + nid).value) );

                $.ajax({
                  url: '{{ url('updateGoals')}}',
                  type: "get",
                  data: {'id_goals_managers':id_goals, '_token': $('input[name=_token]').val(),month: nkey,amount: amountRequest},
                  success: function(data){
                    //alert(data); TODO: gestionar monto total
                  }
                }); 

            }catch (err){
                //alert( err )
            }
        }
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
        parseFloat( cleanMoney( document.getElementById('dec' + nid).value) ) );
    }catch (err){alert( err )}
    }

</script>

@endsection