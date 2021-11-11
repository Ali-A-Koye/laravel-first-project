@extends('layouts.admin')




@section('content')

@if(Session::has('deleted_user'))
<p class="bg-danger">{{session('deleted_user')}}</p>

   @endif


<h1> Posts </h1>

<table class="table">
    <thead><tr>
        <th>id</th>
        <th>Photo</th>
        <th>User</th>
        <th>Category</th>
        <th>Title(Update)</th>
        <th>Comments</th>
        <th>Visit Post</th>
        <th>Created at</th>
        <th>Updated at</th>

    </tr>
    </thead>

    <tbody>
        @if($posts)

        @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td> <img height="50" src="{{$post->photo ? '/images/'.$post->photo->file : 'http://placehold.it/400x400'}}" alt="" ></td>

        <td>{{ $post->user->name}}</td>
            <td>{{ $post->category ? $post->category->name : 'Not Category' }}</td>

            <td> <a href="{{route('admin.posts.edit',$post->id)}}"> {{ $post->title }} </a> </td>
            <td><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
     
        <td> <a href="/post/{{$post->id}}"> Visit </a></td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>  
        </tr>
        @endforeach
        @endif

</table>


<div class="row">
    <div class="col-sm-6 col-sm-offset-5">
        {{$posts->render()}}
    </div>
</div>
@stop