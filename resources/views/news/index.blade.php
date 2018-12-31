@extends('layouts.app')

@section('content')
<style>
    .ml-10{
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
                            <a href="{{url("/news/create")}}"  class="btn btn-info  btn-sm ml-10 pull-right">
                                Add news
                            </a>
                            <button type="submit" name="delete" class="btn btn-danger btn-sm ml-10 pull-right">
                                Delete
                            </button>
                            <button type="submit" name="forceDelete" class="btn btn-danger btn-sm ml-10 pull-right">
                                Force Delete
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
                                            Edit</a>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="checkbox" name="id[]" value="{{$trash->id}}">
                                    </td>
                                </tr>
                            @endforeach
                            <button type="submit" name="restore" class="btn btn-warning btn-sm ml-10 pull-right">
                                Restore
                            </button>
                            <button type="submit" name="forceDelete" class="btn btn-danger btn-sm ml-10 pull-right">
                                Force Delete
                            </button>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
