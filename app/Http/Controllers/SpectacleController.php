<?php

namespace App\Http\Controllers;

use App\Models\Spectacle;
use Illuminate\Http\Request;

class SpectacleController extends Controller
{
    public function index()
    {

        $spectacles=Spectacle::paginate(10);
        return view('admin.spectacle',compact('spectacles'));
    }

    public function save(Request $request)
    {
        Spectacle::create([
            'url'=>'/storage/'.$request->file('photo')->store('photo','public'),
            'title'=>$request->title,
            'description'=>$request->description,
            'text'=>$request->text,
        ]);
    }
}
