@if($errors->has())
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Oh snap!</strong> Please change a few things up and try submitting again.
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif