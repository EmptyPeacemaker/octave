<?php

namespace App\Http\Controllers;

use App\Models\Spectacle;
use Illuminate\Http\Request;

class SpectacleController extends Controller
{
    public function index()
    {
        $spectacles=Spectacle::paginate(7);
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

    public function edit(Request $request)
    {
        $data=[
            'title'=>$request->title,
            'description'=>$request->description,
            'text'=>$request->text,
        ];
        if ($request->file('photo')){
            $data['url']='/storage/'.$request->file('photo')->store('photo','public');
        }
        Spectacle::where('id',$request->id)->update($data);
    }

    public function delete(Request $request)
    {
        Spectacle::where('id',$request->id)->first()->delete();
        return response()->json()->setStatusCode(200);
    }
}
