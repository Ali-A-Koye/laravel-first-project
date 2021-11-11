<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Category;
use App\Comment;


class AdminController extends Controller
{
    //

    public function index()
    {

        $posts = Posts::count();
        $categories = Category::count();
        $comments = Comment::count();

        return view('admin/index', compact('posts', 'categories', 'comments'));
    }
}
