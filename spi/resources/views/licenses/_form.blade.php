<fieldset>

    

    @if ( !Request::is('licenses/create/'.$company->id ) )
        <div class="form-group {{ $errors->has('life') ? 'has-error' : '' }}">
        {!! Form::label('life', 'Life of License*', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">{!! Form::select('life', array('0' => 'Lifetime','1' =>'1 Month','2' =>'2 Months','3' =>'3 Months','4' =>'4 Months','5' =>'5 Months','6' =>'6 Months','7' =>'One Year','8' =>'Two Years','9' =>'Five Years'),$license->life,['class' => 'form-control']); !!}</div>
        </div>
        <div class="form-group">
            {!! Form::label('created_by', 'Created By', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">{!! Form::label('created_by', $company->getAuditUser( $license->created_by  ), ['class' => 'control-label']) !!}</div>
        </div>

        <div class="form-group">
            {!! Form::label('created_at', 'Created At', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10"><label class="control-label">{{$license->created_at}}</label></div>
        </div>

        <div class="form-group">
            {!! Form::label('updated_at', 'Updated At', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10"><label class="control-label">{{$license->updated_at}}</label></div>
        </div>
    @else
        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
        {!! Form::label('quantity', 'Life of License*', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            <select class="form-control"  id="quantity" name="quantity" size="1" data-on="Component.Select">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		</select>
        </div>
        </div>
        <input type="hidden" id="company_id" name="company_id" value="{{$company->id}}" />
    @endif

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            <a href="{{ url('/licenses/list/'.$company->id) }}" class="btn btn-default pull-right">Cancel</a>
            @if ( Request::is('licenses/create/'.$company->id ) )
                {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
            @else
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
            @endif
        </div>
    </div>

</fieldset>