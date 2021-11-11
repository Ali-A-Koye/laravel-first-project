@extends('layouts.admin');





@section('content')

<h1>All Comments</h1>

@if (count($comments)>0)
<table class="table">
    <thead><tr>
        <th>id</th>
        <th>Name</th>
        <th>Email</th>
        <th>body</th>
        <th>View Post</th>
        <th>View replies</th>

        <th>Comments</th>
       <th>Created Date</th> 
        <th>Approve</th>
        <th>Remove</th>



       </tr>
    </thead>

    <tbody>
    @foreach ($comments as $comment)
 <tr>

    <td>{{ $comment->id }}</td>
    <td>{{ $comment->author }}</td>
    <td>{{ $comment->email }}</td>
    <td>{{ $comment->body }}</td>
<td><a href="{{route('home.post',$comment->post->id)}}">{{ $comment->post->title }}</a></td> 
<td><a  href="{{route('admin.comments.show',$comment->post->id)}}">View Comments </a> </td>
<td><a  href="{{route('admin.comment.replies.show',$comment->id)}}">Replies</a> </td>

    <td>{{ $comment->created_at? $comment->created_at->diffForHumans() : "No Date" }}</td>

    <td>

        @if($comment->is_active == 1)

        {!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update',$comment->id]]) !!}
        <input type="hidden" name="is_active" value="0">
            <div class="form-group">
              {!! Form::submit('UnApprove Comment', ['class'=>'btn btn-info']) !!}
           </div>
           {!! Form::close() !!}
           @else
           {!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update',$comment->id]]) !!}
           <input type="hidden" name="is_active" value="1">
               <div class="form-group">
                 {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
              </div>
              {!! Form::close() !!}

        @endif


    </td>

    <td>
    
      {!! Form::open(['method'=>'DELETE', 'action'=> ['PostCommentsController@destroy',$comment->id]]) !!}
            <div class="form-group">
              {!! Form::submit('Delete', ['class'=>'btn btn-Danger']) !!}
           </div> 
           {!! Form::close() !!}
    </td>
 </tr>
@endforeach

</tbody>
</table>
@endif


@stop