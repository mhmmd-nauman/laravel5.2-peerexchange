@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ Session::get('error') }}</li>
        </ul>
    </div>
@endif

@if (Session::has('message'))
    <div class="alert alert-info">
        <ul>
            <li>{{ Session::get('message') }}</li>
        </ul>
    </div>
@endif