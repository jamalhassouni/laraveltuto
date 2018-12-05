@extends('index')
@section('content')

    <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-1 col-md-offset-2">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Add News

                </h3>
            </div>

            <div class="panel-body">
                {{Form::open(['url'=>url('insert/news')])}}
                {{Form::label('title','Title')}}
                {{Form::text('title',old('title'),['placeholder'=>'Title news','class'=>'form-control input-sm','id'=>'title'])}}
                {{Form::label('desc','Description')}}
                {{Form::text('desc',old('desc'),['placeholder'=>'Description news','class'=>'form-control input-sm','id'=>'desc'])}}
                {{Form::label('add_by','Add By ')}}
                {{Form::text('add_by',old('add_by'),['placeholder'=>'Add by','class'=>'form-control input-sm','id'=>'add_by'])}}
                {{Form::label('content','Content')}}
                {{Form::textarea('content',old('content'),['placeholder'=>'Content news','class'=>'form-control input-sm','id'=>'content'])}}
                {{Form::label('status','Status')}}
                {{Form::select('status',['active'=>'active','pending'=>'pending','inactive'=>'inactive'],old('status'),['placeholder'=>'Select Status','class'=>'form-control input-sm','id'=>'status'])}}
                {{Form::submit('submit',['class'=>'btn btn-info btn-block'])}}
                {{Form::close()}}

            </div>
        </div>

    </div>
    <div class="clearfix"></div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Desc</th>
            <th>Add By</th>
            <th>status</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <form method="post" action="{{url('del/news/')}}">
            @foreach($all_news as $news)
                <tr>
                    <td>{{$news->id}}</td>
                    <td>{{$news->title}}</td>
                    <td>{{$news->desc}}</td>
                    <td>{{$news->add_by}}</td>
                    <td>{{$news->status}}</td>
                    <td class="text-center">
                        <a class='col-md-6 btn btn-info btn-xs' href="#">
                            <span class="glyphicon glyphicon-edit"></span> Edit</a>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="checkbox" name="id[]" value="{{$news->id}}">
                    </td>
                </tr>
            @endforeach
            <button type="submit" name="delete" class="btn btn-danger btn-sm ml-10 pull-right">
                Delete <span class="glyphicon glyphicon-trash"></span>
            </button>
            <button type="submit" name="forceDelete" class="btn btn-danger btn-sm ml-10 pull-right">
                Force Delete <span class="glyphicon glyphicon-remove"></span>
            </button>

        </form>
    </table>
    <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-1 col-md-offset-2">
        {!! $all_news->render() !!}
    </div>
    <div class="clearfix"></div>
    <hr>
    <h3 class="text-center">Trashed Data</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Desc</th>
            <th>Add By</th>
            <th>status</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <form method="post" action="{{url('del/news/')}}">
            @foreach($trashed as $trash)
                <tr>
                    <td>{{$trash->id}}</td>
                    <td>{{$trash->title}}</td>
                    <td>{{$trash->desc}}</td>
                    <td>{{$trash->add_by}}</td>
                    <td>{{$trash->status}}</td>
                    <td class="text-center">
                        <a class='col-md-6 btn btn-info btn-xs' href="#">
                            <span class="glyphicon glyphicon-edit"></span> Edit</a>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="checkbox" name="id[]" value="{{$trash->id}}">
                    </td>
                </tr>
            @endforeach
            <button type="submit" name="restore" class="btn btn-warning btn-sm ml-10 pull-right">
                Restore <span class="glyphicon glyphicon-repeat"></span>
            </button>
            <button type="submit" name="forceDelete" class="btn btn-danger btn-sm ml-10 pull-right">
                Force Delete <span class="glyphicon glyphicon-remove"></span>
            </button>
        </form>
    </table>

@endsection