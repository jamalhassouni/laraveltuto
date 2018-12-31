@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br>
@if(session()->has('message'))
    <hr>
    <div class="alert alert-success">
        {{session()->get('message')}}
    </div>
    <hr/>
@endif

@if(session()->has('success'))
    <hr>
    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
    <hr/>
@endif