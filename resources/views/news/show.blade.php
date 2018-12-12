@extends('layouts.app')

@section('content')
    <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-1 col-md-offset-2">
        @include('messages')
        <div class="error">
            <div class="alert_error"></div>
            <ul></ul>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{$news->title}}</h3>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <p> desc : {{$news->desc}}</p>
                </div>
                <div class="panel-body">
                    <span>by : {{$news->user_id()->first()->name}}</span>
                    <br>
                    {{$news->content}}
                </div>
                <div class="panel-footer"></div>
            </div>
            <div class="panel-body">
                {{Form::open(['url'=>url('news/'.$news->id),'id'=>'news'])}}

                {{Form::label('comment','Comment')}}
                {{Form::textarea('comment',old('comment'),['placeholder'=>'Add Comment','class'=>'form-control input-sm','id'=>'comment'])}}
                <br>
                {{Form::submit('submit',['class'=>'btn btn-info btn-block','id'=>'add_news'])}}
                {{Form::close()}}
               <hr>
                @foreach($news->comments()->get() as $comment)
                    <p><span class="text-danger">Add By:</span> {{$comment->user_id()->first()->name}}</p>
                    <p> {{$comment->comment}}</p>
               @endforeach
            </div>
        </div>

    </div>
    <div class="clearfix"></div>




@endsection
