@if( $message != '' )
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <span>{{ $message }}</span>
    </div>
@endif