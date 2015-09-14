<fieldset>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('email', 'Email*', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9"><label class="control-label">{{$user->email}}</label></div>
    </div>

    <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
        {!! Form::label('new_password', 'New Password', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'Leave blank or unchanged if you don\'t want to modify the password']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
        {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::password('confirm_password', ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
        {!! Form::label('first_name', 'First Name*', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('first_name', $user->first_name, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
        {!! Form::label('last_name', 'Last Name*', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('last_name', $user->last_name, ['class' => 'form-control']) !!}</div>
    </div>


    <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
        {!! Form::label('contact_number', 'Contact Number', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('contact_number', $user->contact_number, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('address1') ? 'has-error' : '' }}">
        {!! Form::label('address1', 'Address 1', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('address1', $user->address1, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('address2') ? 'has-error' : '' }}">
        {!! Form::label('address2', 'Address 2', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('address2', $user->address2, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }}">
        {!! Form::label('company_id', 'Company', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9"><label class="control-label">{{$user->company->name}}</label></div>
    </div>

    {!! Form::hidden('updated_by', Auth::user()->id) !!}

    <div class="form-group">
        <div class="col-lg-9 col-lg-offset-3">
            <a href="{{ url('/') }}" class="btn btn-default pull-right">Cancel</a>
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

</fieldset>