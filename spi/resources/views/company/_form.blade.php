<fieldset>

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
            <label for="name" class="control-label label-vcenter">Company Name*</label>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 vcenter">
            <input class="form-control vcenter" name="name" type="text" id="name">
        </div>
    </div>


    @if ( !Request::is('companies/create' ) )
        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
                <label for="created_by" class="control-label label-vcenter">Created By</label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 vcenter">
                <label class="control-label label-vcenter">{{$company->getAuditUser( $company->updated_by  )}}</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
                <label for="created_at" class="control-label label-vcenter">Created At</label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 vcenter">
                <label class="control-label label-vcenter">{{$company->created_at}}</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
                <label for="updated_by" class="control-label label-vcenter">Updated by</label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 vcenter">
                <label class="control-label label-vcenter">{{$company->getAuditUser( $company->updated_by  )}}</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 vcenter">
                <label for="updated_at" class="control-label label-vcenter">Updated At</label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 vcenter">
                <label class="control-label label-vcenter">{{$company->created_at}}</label>
            </div>
        </div>
    @else
        {!! Form::hidden('updated_by', Auth::user()->id) !!}
    @endif
    {!! Form::hidden('updated_by', Auth::user()->id) !!}

    <div class="form-group">
        <div class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4">
            <a href="{{ url('/companies') }}" class="btn btn-default pull-right">Cancel</a>
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

</fieldset>