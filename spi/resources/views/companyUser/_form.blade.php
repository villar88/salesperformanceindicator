<fieldset>

    <script type="text/javascript">
                    function setAction(arg)
                    {
                        if($('select[name=role_id]').val()==2){
                            $('select[name=manager_id]').prop( 'disabled', false );
                        }
                        else{
                            $('select[name=manager_id]').prop( 'disabled', true );
                        }
                    }
    </script>
   @if ( Request::is('companyUsers/create/*') || Request::is('companyUsers/create' ))
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! Form::label('email', 'Email*', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">{!! Form::text('email', null, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            {!! Form::label('password', 'Password*', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">{!! Form::password('password', ['class' => 'form-control']) !!}</div>
        </div>

    @else
        @if( Auth::user()->role->id == 4 )
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('email', 'Email*', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">{!! Form::text('email', null, ['class' => 'form-control']) !!}</div>
            </div>
        @else
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('email', 'Email*', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">{!! Form::text('email', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}</div>
            </div>
        @endif
        <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
            {!! Form::label('new_password', 'New Password', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">{!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'Leave blank or unchanged if you don\'t want to modify the password']) !!}</div>
        </div>

    @endif

    <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
        {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">{!! Form::password('confirm_password', ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
        {!! Form::label('first_name', 'First Name*', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">{!! Form::text('first_name', null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
        {!! Form::label('last_name', 'Last Name*', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">{!! Form::text('last_name', null, ['class' => 'form-control']) !!}</div>
    </div>


    <div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
        {!! Form::label('role_id', 'Role', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            @if( Auth::user()->role->id == 1 )
                {!! Form::select('role_id', \App\Role::lists('name', 'id') , null, ['class' => 'form-control','onchange' => 'setAction("2");'] ) !!}
            @elseif( Auth::user()->role->id == 4 )
            <select class="form-control" id="role_id" name="role_id" onchange="setAction('2')">
                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Member</option>
                    <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Manager</option>
                </select>
            @elseif( Auth::user()->role->id == 3 )
                <div class="col-lg-10">
                    <label class="control-label">Member</label>
                    {!! Form::hidden('role_id', 2, ['class' => 'form-control']) !!}
                </div>
            @endif

        </div>
    </div>
    @if ( !(Request::is('companyUsers/create/*') || Request::is('companyUsers/create' )))
        @if( Auth::user()->role->id == 4 )
        <div class="form-group {{ $errors->has('manager_id') ? 'has-error' : '' }}">
            {!! Form::label('manager_id', 'Manager Boss', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                <?php
                    $ids_update[]=\App\User::where('id',Request::segment(2))->lists('company_id');
                    $ids_update[]=\App\User::where('id',Request::segment(2))->lists('role_id');
                ?>
                
                    @if ($ids_update[1][0]==2)
                         {!! Form::select('manager_id', \App\User::where('role_id',3)->where('company_id',$ids_update[0][0])->orderBy('first_name')->lists('first_name', 'id') , null, ['class' => 'form-control'] ) !!}
                    @else
                         {!! Form::select('manager_id', \App\User::where('role_id',3)->where('company_id',$ids_update[0][0])->orderBy('first_name')->lists('first_name', 'id') , null, ['class' => 'form-control','disabled' => 'disabled'] ) !!}
                    @endif
            </div>
        </div>
        @endif
    @else
         @if( Auth::user()->role->id == 4 )
            <div class="form-group {{ $errors->has('manager_id') ? 'has-error' : '' }}">
                {!! Form::label('manager_id', 'Manager', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                             {!! Form::select('manager_id', \App\User::where('role_id',3)->where('company_id',Auth::user()->company->id)->orderBy('first_name')->lists('first_name', 'id') , null, ['class' => 'form-control'] ) !!}
                </div>
            </div>
         @else
            <div class="form-group {{ $errors->has('manager_id') ? 'has-error' : '' }}">
                {!! Form::label('manager_id', 'Manager', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                             {!! Form::select('manager_id', \App\User::where('role_id',3)->where('company_id',Auth::user()->company->id)->orderBy('first_name')->lists('first_name', 'id') , Auth::user()->id, ['class' => 'form-control','disabled' => 'disabled'] ) !!}
                </div>
            </div>
         @endif
    @endif
        <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
            {!! Form::label('contact_number', 'Contact Number', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">{!! Form::text('contact_number', null, ['class' => 'form-control']) !!}</div>
        </div>

    <div class="form-group {{ $errors->has('address1') ? 'has-error' : '' }}">
        {!! Form::label('address1', 'Address 1', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">{!! Form::text('address1', null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('address2') ? 'has-error' : '' }}">
        {!! Form::label('address2', 'Address 2', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">{!! Form::text('address2', null, ['class' => 'form-control']) !!}</div>
    </div>

    @if ( !Request::is('companyUsers/create' ))
    <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }}">
        {!! Form::label('company_id', 'Company', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            <label class="control-label">{{$user->company->name}}</label>
            {!! Form::hidden('company_id', $user->company->id, ['class' => 'form-control']) !!}
        </div>
    </div>
    @else
        <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }}">
        {!! Form::label('company_id', 'Company', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            <label class="control-label">{{Auth::user()->company->name}}</label>
            {!! Form::hidden('company_id', Auth::user()->company->id, ['class' => 'form-control']) !!}
        </div>
    </div>
    @endif
        @if ( !(Request::is('companyUsers/create/*') || Request::is('companyUsers/create' )))
            <div class="form-group">
                {!! Form::label('created_by', 'Created By', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10"><input class="form-control" type="text" disabled="disabled" value=" {{ \App\User::findOrFail( $user->created_by )->first_name }} {{ \App\User::findOrFail( $user->created_by )->last_name }}"></div>
            </div>

            <div class="form-group">
                {!! Form::label('created_at', 'Created At', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">{!! Form::text('created_at', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}</div>
            </div>

            <div class="form-group">
                {!! Form::label('updated_by', 'Updated by', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10"><input class="form-control" type="text" disabled="disabled" value=" {{ \App\User::findOrFail( $user->updated_by )->first_name }} {{ \App\User::findOrFail( $user->updated_by )->last_name }}"></div>
            </div>

            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">{!! Form::text('updated_at', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}</div>
            </div>
        {!! Form::hidden('updated_by', Auth::user()->id) !!}
    @else
        {!! Form::hidden('updated_by', Auth::user()->id) !!}
        {!! Form::hidden('created_by', Auth::user()->id) !!}
    @endif

    {!! Form::hidden('status', 'ACTIVE') !!}

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            @if( Auth::user()->role->id == 1 )
                <a href="{{ url('companies/'.$user->company_id) }}" class="btn btn-default pull-right">Cancel</a>
            @else
                <a href="{{ url('/') }}" class="btn btn-default pull-right">Cancel</a>
            @endif
        {!! Form::submit('Submit', ['class' => 'btn btn-primary','onclick' => '$("input[name=email]").prop("disabled", false );']) !!}
        </div>
    </div>

</fieldset>