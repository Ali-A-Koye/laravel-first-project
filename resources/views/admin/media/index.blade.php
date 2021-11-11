@extends('layouts.admin')








@section('content')

<h1>Media</h1>

  
@if ($photos)


      
<form action='/delete/media' method="post" class='form-inline'>
    {{csrf_field()}}

    {{method_field('delete')}}
    <div class="form-group">
        <select name="checkBoxArray" id="" class="form-control">

            <option value="">Delete</option>

        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="delete_all" class="btn-primary">
     </div>




<table class="table">
    <thead><tr>
        <th><input type="checkbox" id="options"></th>
        <th>id</th>
        <th>Name</th>
        <th>created at</th>
        <th>Delete</th>
       </tr>
    </thead>

    <tbody>
    @foreach ($photos as $photo)
 <tr>
    <td><input class='checkBoxes' type="checkbox" name="checkBoxArray[]" value={{$photo->id}}></td>
    <td>{{ $photo->id }}</td>
    <td><img height="50" src={{ $photo->file? '/images/'.$photo->file : 'No Image'}}></td>
    <td>{{ $photo->created_at? $photo->created_at : 'No date'}}</td>
    <td>


      
{{ Form::open(['method' => 'DELETE','action'=>['AdminMediaController@destroy',$photo->id]])}}

<div class="form-group">
    {!! Form::submit('Delete Photo',['class'=>'btn btn-danger']) !!}
</div>

{!! Form::close() !!}
    </td>

 </tr>
@endforeach

</form>

@endif

@stop
@section('scripts')


    <script>
        $(document).ready(function(){
            $('#options').click(function(){
                

                if(this.checked){

                    $('.checkBoxes').each(function(){
                        


                        this.checked = true;

                    });

                }else {

                    $('.checkBoxes').each(function(){


                        this.checked = false;

                    });
                }
            });
        });

    </script>


@stop
