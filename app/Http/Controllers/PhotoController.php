<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos=Photo::paginate(9);
        return view('admin.photo',compact('photos'));
    }

    public function loadPhoto(Request $request)
    {
        return response()->json(['photo'=>Photo::create(['url'=>'/storage/'.$request->file('photo')->store('photo','public'),'user_id'=>1])]);
    }

    public function delete(Request $request)
    {
        Photo::where('id',$request->id)->first()->delete();
        return response()->json()->setStatusCode(200);
    }
}
