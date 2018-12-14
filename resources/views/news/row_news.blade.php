<tr>
    <td>{{$news->id}}</td>
    <td>{{$news->title}}</td>
    <td>{{$news->desc}}</td>
    <td>{{$news->user_id()->first()->name}}</td>
    <td>{{$news->status}}</td>
    <td class="text-center">
        <a class='col-md-6 btn btn-info btn-xs' href="{{url('delete/user/'.$news->user_id)}}">
            Delete User</a>
        <a class='col-md-6 btn btn-success btn-xs' href="{{url('news/'.$news->id)}}">
            View</a>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="checkbox" name="id[]" value="{{$news->id}}">
    </td>
</tr>