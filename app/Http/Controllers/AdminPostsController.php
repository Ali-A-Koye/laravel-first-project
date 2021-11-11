<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostsCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Posts;
use App\Photo;
use App\Category;

use App\Http\Requests;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = Posts::paginate(1);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //PostsCreateRequest
    public function store(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name); //saving the file into the images folder

            $photo = Photo::create(['file' => $name]);

            $input['photo_id'] = $photo->id;
        };

        $user->posts()->create($input);

        return redirect("/admin/posts");


        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Posts::findOrFail($id);
        $category = Category::pluck('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->all();

        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name); //saving the file into the images folder

            $photo = Photo::create(['file' => $name]);

            $input['photo_id'] = $photo->id;
        };

        Auth::user()->posts()->whereId($id)->first()->update($input);


        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $post = Posts::findOrFail($id);

        unlink(public_path() . "/images/" . $post->photo->file);

        $post->delete();

        Session::flash('deleted_user', "Post has been Deleted");
        return redirect('/admin/posts');
    }


    public function post($id)
    {

        $post = Posts::findOrFail($id);

        $comments = $post->comments()->whereIsActive(1)->get();



        return view('posts', compact('post', 'comments'));
    }
}
