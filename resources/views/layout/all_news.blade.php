<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>All News</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
        .centered-form {
            margin-top: 60px;
        }

        .centered-form .panel {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
        }

        .ml-10 {
            margin-left: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-1 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add News

                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="{{url('insert/news')}}">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="text" name="title" id="title" class="form-control input-sm"
                                           placeholder="Title">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="desc">Description</label>
                                    <input type="text" name="desc" id="desc" class="form-control input-sm"
                                           placeholder="Description">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea rows="10" id="content" name="content" class="form-control input-sm"></textarea>

                        </div>


                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control input-sm">
                                        <option value="active">active</option>
                                        <option value="pending">pending</option>
                                        <option value="inactive">inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="add_by">Add By</label>
                                    <input type="text" name="add_by" id="add_by" class="form-control input-sm"
                                           placeholder="Add By">
                                </div>
                            </div>
                        </div>

                        <input type="submit" value="Submit" class="btn btn-info btn-block">

                    </form>
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
    </div>
</div>
</body>
</html>
