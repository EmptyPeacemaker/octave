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

Route::prefix('admin')->group(function (){

    Route::get('spectacle',[\App\Http\Controllers\SpectacleController::class,'index']);
    Route::post('spectacle',[\App\Http\Controllers\SpectacleController::class,'save'])->name('spectacle.load');

    Route::get('photo',[\App\Http\Controllers\PhotoController::class,'index']);
    Route::post('photo',[\App\Http\Controllers\PhotoController::class,'loadPhoto'])->name('photo.load');
});
Route::get('/', function () {
    $photos=\App\Models\Photo::takeRandom(2)->get()->pluck('url');
    return view('index',compact('photos'));
});
