<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminMediaController extends Controller
{

    public function index()

    {

        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        Photo::Create(['file' => $name]);
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        unlink(public_path() . '\images\\' . $photo->file);
        $photo->delete();

        return redirect('/admin/media');
    }


    public function deleteMedia(Request $request)
    {
        $photo = Photo::findOrFail($request->checkBoxArray);
        foreach ($photo as $photos) {
            $photos->delete();
        }
        return redirect()->back();
    }
    //
}
