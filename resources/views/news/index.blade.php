@extends('layouts.app')

@section('content')
    <style>
        .ml-10 {
            margin-left: 10px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>

                    <div class="panel-body">
                        @include('messages')
                        <div class="clearfix"></div>
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
                                {!! Form::open(['url'=>'/news/'.$news->id,'method'=>'delete']) !!}
                                @include('news.row_news')
                                {!! Form::close() !!}
                            @endforeach
                            <a href="{{url("/news/create")}}" class="btn btn-primary  btn-sm ml-10 pull-right">
                                Add news
                            </a>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
