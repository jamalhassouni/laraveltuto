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

</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <table>
            <tr>
                <th>Title</th>
                <th>Desc</th>
                <th>Add By</th>
                <th>status</th>
                <th>action</th>
            </tr>
            @foreach($all_news as $news)
                <tr>
                    <td>{{$news->title}}</td>
                    <td>{{$news->desc}}</td>
                    <td>{{$news->add_by}}</td>
                    <td>{{$news->status}}</td>
                    <td>{{$news->id}}</td>
                </tr>
            @endforeach
        </table>
        {!! $all_news->render() !!}
    </div>
</div>
</body>
</html>
