@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('errors'))
    <div class="alert alert-danger">
        <ul>
            @foreach (Session::get('errors') as $error)
                <li>{{ $error }}</li>
            @endforeach
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