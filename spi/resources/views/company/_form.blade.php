<fieldset>
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
            <label for="name" class="control-label label-vcenter">Company Name*</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
            {!! Form::text('name', null, ['class' => 'form-control vcenter']) !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
            <label for="email" class="control-label label-vcenter">Email*</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
            {!! Form::text('email', null, ['class' => 'form-control vcenter']) !!}
        </div>
    </div>
    @if (Request::is('companies/create' ) )
    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
            <label for="password" class="control-label label-vcenter">Password*</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
            <input type="password" name="password" class="form-control vcenter" />
        </div>
    </div>
    {!! Form::hidden('updated_by', Auth::user()->id) !!}
    {!! Form::hidden('created_by', Auth::user()->id) !!}
    {!! Form::hidden('type_request', 0) !!}
    @else
    <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
            <label for="new_password" class="control-label label-vcenter">New Password</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
            <input type="password" name="new_password" class="form-control vcenter" placeholder="Leave blank or unchanged if you don't want to modify the password" />
        </div>
    </div>
    {!! Form::hidden('updated_by', Auth::user()->id) !!}
    {!! Form::hidden('type_request', 1) !!}
    {!! Form::hidden('user_id', $company->user_id) !!}
    {!! Form::hidden('company_id', $company->id) !!}
    @endif
    <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
            <label for="confirm_password" class="control-label label-vcenter">Confirm Password</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
            <input type="password" name="confirm_password" class="form-control vcenter" />
        </div>
    </div>
    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
            <label for="first_name" class="control-label label-vcenter">First Name*</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
            {!! Form::text('first_name', null, ['class' => 'form-control vcenter']) !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
            <label for="last_name" class="control-label label-vcenter">Last Name*</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
            {!! Form::text('last_name', null, ['class' => 'form-control vcenter']) !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
            <label for="contact_number" class="control-label label-vcenter">Contact Number</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
            {!! Form::text('contact_number', null, ['class' => 'form-control vcenter']) !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('address1') ? 'has-error' : '' }}">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
            <label for="address1" class="control-label label-vcenter">Address 1</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
            {!! Form::text('address1', null, ['class' => 'form-control vcenter']) !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('address2') ? 'has-error' : '' }}">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
            <label for="address2" class="control-label label-vcenter">Address 2</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 vcenter">
            {!! Form::text('address2', null, ['class' => 'form-control vcenter']) !!}
        </div>
    </div>
    @if ( Request::is('companies/create' ) )
    <div class="form-group">
        <div class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4">
            <a href="{{ url('/companies') }}" class="btn btn-default pull-right">Cancel</a>
            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    @else
    <div class="form-group">
        <div class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4">
            <a href="{{ url('/companies') }}" class="btn btn-default pull-right">Cancel</a>
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    @endif


</fieldset>