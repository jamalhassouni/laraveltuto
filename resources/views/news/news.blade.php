@extends('layouts.app')

@section('content')
<style>
    .ml-10{
        margin-left: 10px;
    }
</style>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).on('click', '#add_news', function () {
            let news = $('#news');
            let form = news.serialize();
            let url = news.attr('action');
            let err = $('.alert_error');
            let error_ul = $('.error ul');
            $.ajax({
                url: url,
                dataType: 'json',
                data: form,
                type: 'post',
                beforeSend: function () {
                    err.empty();
                    error_ul.empty();
                }, success: function (data) {
                    if (data.status === true) {
                        $('.list_news tbody').append(data.result);
                        news[0].reset();
                    }
                }, error: function (data_error, exception) {
                    if (exception === "error") {

                        err.addClass('alert alert-danger');
                        err.html(data_error.responseJSON.message);
                        let error_list = '';
                        $.each(data_error.responseJSON.errors, function (index, value) {
                            error_list += `<li>${value}</li>`;

                        });
                        error_ul.html(error_list);
                        //alert(data_error.responseJSON.message);
                    }
                }
            });
            return false;
        })
    </script>
    <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-1 col-md-offset-2">
        @include('messages')
        <div class="error">
            <div class="alert_error"></div>
            <ul></ul>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Add News

                </h3>
            </div>

            <div class="panel-body">
                {{Form::open(['url'=>url('insert/news'),'id'=>'news'])}}
                {{Form::label('title','Title')}}
                {{Form::text('title',old('title'),['placeholder'=>'Title news','class'=>'form-control input-sm','id'=>'title'])}}
                <br>
                {{Form::label('desc','Description')}}
                {{Form::text('desc',old('desc'),['placeholder'=>'Description news','class'=>'form-control input-sm','id'=>'desc'])}}
                <br>
                {{Form::label('user_id','Add By ')}}
                {{Form::text('user_id',old('user_id'),['placeholder'=>'Add by','class'=>'form-control input-sm','id'=>'user_id'])}}
                <br>
                {{Form::label('content','Content')}}
                {{Form::textarea('content',old('content'),['placeholder'=>'Content news','class'=>'form-control input-sm','id'=>'content'])}}
                <br>
                {{Form::label('status','Status')}}
                {{Form::select('status',['active'=>'active','pending'=>'pending','inactive'=>'inactive'],old('status'),['placeholder'=>'Select Status','class'=>'form-control input-sm','id'=>'status'])}}
                <br>
                {{Form::submit('submit',['class'=>'btn btn-info btn-block','id'=>'add_news'])}}
                {{Form::close()}}

            </div>
        </div>

    </div>
    <div class="clearfix"></div>
    <form method="post" action="{{url('del/news/')}}">
        <table class="table table-striped list_news">
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
            <tbody>
            @foreach($all_news as $news)
               @include('news.row_news')
            @endforeach
            <button type="submit" name="delete" class="btn btn-danger btn-sm ml-10 pull-right">
                Delete <span class="glyphicon glyphicon-trash"></span>
            </button>
            <button type="submit" name="forceDelete" class="btn btn-danger btn-sm ml-10 pull-right">
                Force Delete <span class="glyphicon glyphicon-remove"></span>
            </button>
            </tbody>
        </table>

    </form>

    <div class="clearfix"></div>
    <hr>
    <h3 class="text-center">Trashed Data</h3>
    <form method="post" action="{{url('del/news/')}}">
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
            @foreach($trashed as $trash)
                <tr>
                    <td>{{$trash->id}}</td>
                    <td>{{$trash->title}}</td>
                    <td>{{$trash->desc}}</td>
                    <td>{{$trash->user_id()->first()->name}}</td>
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
        </table>
    </form>

@endsection
