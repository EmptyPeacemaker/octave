<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('login', function () {
    return view('login');
})->name('login')   ;
Route::post('login', function (\Illuminate\Http\Request $request) {
    $user=\App\Models\User::where('login',$request->login)->where('password',$request->password)->first();
    if ($user){
        $token=\Illuminate\Support\Str::random(80);
        $user->remember_token=$token;
        $user->save();
        session()->push('token',$token);
        return redirect(\route('spectacle.index'));
    }
});
Route::get('logout',function (){
    \App\Models\User::where('remember_token',session()->get('token'))->update(['remember_token'=>null]);
    return redirect(\route('login'));
})->name('logout');


Route::get('/', function () {
    $photos = \App\Models\Photo::takeRandom(2)->get()->pluck('url');
    $spectacles = \App\Models\Spectacle::takeRandom(10)->get();
    return view('index', compact('photos', 'spectacles'));
})->name('home');
Route::get('photos', function () {
    $photos = \App\Models\Photo::paginate(15);
    return view('photos', compact('photos'));
})->name('photos');

Route::get('spectacle/{text}', function ($text) {
    if ($text) {
        $spectacles = \App\Models\Spectacle::with('comments')->
        orWhere('text', 'LIKE', '%' . $text . '%')->
        orWhere('title', 'LIKE', '%' . $text . '%')->
        orWhere('description', 'LIKE', '%' . $text . '%')->
        paginate(10);
    } else {
        $spectacles = \App\Models\Spectacle::with('comments')->paginate(10);
    }
    return view('spectacle', compact('spectacles'));
})->name('spectacle');

Route::post('comment', function (Illuminate\Http\Request $request) {
    \App\Models\Comment::create([
        'auth' => $request->auth,
        'text' => $request->text,
        'spectacle_id' => $request->id
    ]);
    return response()->json()->setStatusCode(200);
})->name('comment');

Route::post('request', function (\Illuminate\Http\Request $request) {
    \App\Models\Request::create($request->only(['phone', 'fio', 'type']));
    return response()->json()->setStatusCode(200);
})->name('request');


Route::prefix('admin')->middleware('authUser')->group(function () {
//    if (!$_SESSION['token'] || !\App\Models\User::where('remember_token',$_SESSION['token'])->first())return redirect(\route('home'));
    Route::prefix('spectacle')->group(function () {
        Route::get('/', [\App\Http\Controllers\SpectacleController::class, 'index'])->name('spectacle.index');
        Route::post('/', [\App\Http\Controllers\SpectacleController::class, 'save'])->name('spectacle.load');
        Route::post('edit', [\App\Http\Controllers\SpectacleController::class, 'edit'])->name('spectacle.edit');
        Route::delete('/', [\App\Http\Controllers\SpectacleController::class, 'delete'])->name('spectacle.delete');
    });

    Route::get('photo', [\App\Http\Controllers\PhotoController::class, 'index'])->name('photo.index');
    Route::delete('photo', [\App\Http\Controllers\PhotoController::class, 'delete'])->name('photo.delete');
    Route::post('photo', [\App\Http\Controllers\PhotoController::class, 'loadPhoto'])->name('photo.load');

    Route::get('request', function () {
        $requests = \App\Models\Request::paginate(15);
        return view('admin.request', compact('requests'));
    })->name('request.index');
});