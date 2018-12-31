<tr>
    <td>{{$news->id}}</td>
    <td>{{$news->title}}</td>
    <td>{{$news->desc}}</td>
    <td>{{$news->user_id()->first()->name}}</td>
    <td>{{$news->status}}</td>
    <td class="text-center">
        <a class='btn btn-success btn-xs' href="{{url('news/'.$news->id)}}">
            View</a>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="DELETE">
        <button style="background:none!important;border:none;padding:0!important;">
            <a class=' btn btn-danger btn-xs' role="button">
                Delete </a>
        </button>

    </td>
</tr>