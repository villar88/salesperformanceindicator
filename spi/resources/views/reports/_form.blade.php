<fieldset>

    @if ( Request::is('users/create' ) )
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! Form::label('email', 'Email*', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">{!! Form::text('email', null, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            {!! Form::label('password', 'Password*', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">{!! Form::password('password', ['class' => 'form-control']) !!}</div>
        </div>

    @else
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! Form::label('email', 'Email*', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">{!! Form::text('email', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}</div>
        </div>

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
            {!! Form::select('role_id', \App\Role::lists('name', 'id') , null, ['class' => 'form-control'] ) !!}
        </div>
    </div>

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

    <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }}">
        {!! Form::label('company_id', 'Company', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">{!! Form::select('company_id', \App\Company::lists('name', 'id') , null, ['class' => 'form-control'] ) !!}</div>
    </div>

        @if ( !Request::is('users/create' ) )
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
            <a href="{{ url('/') }}" class="btn btn-default pull-right">Cancel</a>
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

</fieldset>