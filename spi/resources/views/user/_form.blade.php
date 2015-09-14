<fieldset>

    <script type="text/javascript">
        function setAction(arg)
        {
            if ($('select[name=role_id]').val() == 2) {
                $('select[name=manager_id]').prop('disabled', false);
            }
            else {
                $('select[name=manager_id]').prop('disabled', true);
            }
        }
        function tal(event) {
            $('select[name=company_id]').change(function () {
                $.get("{{ url('dropdown')}}",
                        {option: $(this).val()},
                function (data) {
                    $('select[name=manager_id]').empty();
                    $.each(data, function (key, element) {
                        $('select[name=manager_id]').append("<option value='" + key + "'>" + element + "</option>");
                    });
                });
            });
        }
        if (document.addEventListener) {
            document.addEventListener("DOMContentLoaded", tal);

        } else if (document.attachEvent) {
            document.attachEvent('DOMContentLoaded', tal);
        }
    </script>
    @if ( Request::is('users/create' ) )
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('email', 'Email*', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('email', null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        {!! Form::label('password', 'Password*', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::password('password', ['class' => 'form-control']) !!}</div>
    </div>

    @else
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('email', 'Email*', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('email', null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
        {!! Form::label('new_password', 'New Password', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'Leave blank or unchanged if you don\'t want to modify the password']) !!}</div>
    </div>

    @endif

    <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
        {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::password('confirm_password', ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
        {!! Form::label('first_name', 'First Name*', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('first_name', null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
        {!! Form::label('last_name', 'Last Name*', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('last_name', null, ['class' => 'form-control']) !!}</div>
    </div>


    <div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
        {!! Form::label('role_id', 'Role', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">
            {!! Form::select('role_id', \App\Role::whereIn('id', array(2, 3, 4))->lists('name', 'id') , null, ['class' => 'form-control','onchange' => 'setAction("2");'] ) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }}">
        {!! Form::label('company_id', 'Company', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::select('company_id',array('default' => '------') + \App\Company::where('status','ACTIVE')->orderBy('name')->lists('name', 'id') , null, ['class' => 'form-control'] ) !!}</div>
    </div>

    @if ( !Request::is('users/create' ))
    <?php
    $id_role_update = \App\User::where('id', Request::segment(2))->lists('role_id');
    $id_company_update = \App\User::where('id', Request::segment(2))->lists('company_id');
    ?>
    @if ($id_role_update[0]==2)
    <div class="form-group {{ $errors->has('manager_id') ? 'has-error' : '' }}">
        {!! Form::label('manager_id', 'Manager', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">
            {!! Form::select('manager_id', \App\User::where('role_id',3)->where('company_id',$id_company_update)->orderBy('first_name')->lists('first_name', 'id') , null, ['class' => 'form-control'] ) !!}
        </div>
    </div>
    @else
    <div class="form-group {{ $errors->has('manager_id') ? 'has-error' : '' }}">
        {!! Form::label('manager_id', 'Manager', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">
            {!! Form::select('manager_id', \App\User::where('role_id',3)->where('company_id',$id_company_update)->orderBy('first_name')->lists('first_name', 'id') , null, ['class' => 'form-control','disabled' => 'disabled'] ) !!}
        </div>
    </div>
    @endif
    @else
    <div class="form-group {{ $errors->has('manager_id') ? 'has-error' : '' }}">
        {!! Form::label('manager_id', 'Manager', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">
            {!! Form::select('manager_id',array('default' => 'Select a Company') , 'default', ['class' => 'form-control','disabled' => 'disabled'] ) !!}
        </div>
    </div>
    @endif


    <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
        {!! Form::label('contact_number', 'Contact Number', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('contact_number', null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('address1') ? 'has-error' : '' }}">
        {!! Form::label('address1', 'Address 1', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('address1', null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group {{ $errors->has('address2') ? 'has-error' : '' }}">
        {!! Form::label('address2', 'Address 2', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('address2', null, ['class' => 'form-control']) !!}</div>
    </div>

    @if ( !Request::is('users/create' ) )
    <div class="form-group">
        {!! Form::label('created_by', 'Created By', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9"><input class="form-control" type="text" disabled="disabled" value=" {{ \App\User::findOrFail( $user->created_by )->first_name }} {{ \App\User::findOrFail( $user->created_by )->last_name }}"></div>
    </div>

    <div class="form-group">
        {!! Form::label('created_at', 'Created At', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('created_at', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}</div>
    </div>

    <div class="form-group">
        {!! Form::label('updated_by', 'Updated by', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9"><input class="form-control" type="text" disabled="disabled" value=" {{ \App\User::findOrFail( $user->updated_by )->first_name }} {{ \App\User::findOrFail( $user->updated_by )->last_name }}"></div>
    </div>

    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At', ['class' => 'col-lg-3 control-label']) !!}
        <div class="col-lg-9">{!! Form::text('updated_at', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}</div>
    </div>
    {!! Form::hidden('updated_by', Auth::user()->id) !!}
    @else
    {!! Form::hidden('updated_by', Auth::user()->id) !!}
    {!! Form::hidden('created_by', Auth::user()->id) !!}
    @endif

    {!! Form::hidden('status', 'ACTIVE') !!}

    <div class="form-group">
        <div class="col-lg-9 col-lg-offset-3">
            <a href="{{ url('/') }}" class="btn btn-default pull-right">Cancel</a>
            <input class="btn btn-primary" type="submit" value="Submit">
        </div>
    </div>

</fieldset>