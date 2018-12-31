@extends('layouts.app')

@section('content')
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
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" style="padding-bottom: 18px;">
                        {{$title}}

                        <div class="pull-right"></div>
                        <a href="{{url("/news")}}" class="btn btn-info  btn-sm ml-10 pull-right">
                            back
                        </a>
                    </div>

                    <div class="panel-body">

                        @include('messages')
                        <div class="error">
                            <div class="alert_error"></div>
                            <ul></ul>
                        </div>

                        {{Form::open(['url'=>url('news'),'files'=>true,'id'=>'news'])}}
                        <div class="form-group">
                            {{Form::label('title','Title')}}
                            {{Form::text('title',old('title'),['placeholder'=>'Title news','class'=>'form-control input-sm','id'=>'title'])}}

                        </div>
                        <div class="form-group">
                            {{Form::label('desc','Description')}}
                            {{Form::text('desc',old('desc'),['placeholder'=>'Description news','class'=>'form-control input-sm','id'=>'desc'])}}

                        </div>
                        <div class="form-group">
                            {{Form::label('photo','Photo ')}}
                            {{Form::file('photo',['class'=>'form-control input-sm','id'=>'photo'])}}

                        </div>
                        <div class="form-group">
                            {{Form::label('files','Files ')}}
                            {{Form::file('files[]',['class'=>'form-control input-sm','id'=>'files','multiple'=>'yes'])}}

                        </div>
                        <div class="form-group">
                            {{Form::label('content','Content')}}
                            {{Form::textarea('content',old('content'),['placeholder'=>'Content news','class'=>'form-control input-sm','id'=>'content'])}}

                        </div>
                        <div class="form-group">
                            {{Form::label('status','Status')}}
                            {{Form::select('status',['active'=>'active','pending'=>'pending','inactive'=>'inactive'],old('status'),['placeholder'=>'Select Status','class'=>'form-control input-sm','id'=>'status'])}}

                        </div>
                        <div class="form-group">
                            {{Form::submit('save',['class'=>'btn btn-success','id'=>'Aadd_news'])}}

                        </div>
                        {{Form::close()}}


                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
