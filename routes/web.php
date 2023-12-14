<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postcontroller;
use App\Http\Controllers\asmaacontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = [];
    if(auth()->check()){
        $posts =auth()->user()->posts()->latest()->get();
    }



    return view('home',['posts' => $posts]);
});

Route::post('/register',[asmaacontroller::class,'register']);

Route::post('/logout',[asmaacontroller::class,'logout']);

Route::post('/login',[asmaacontroller::class,'login']);

Route::post('/create-post',[postcontroller::class,'createPost']);


Route::get('/edit-post/{post}', [asmaacontroller::class,'edit']);
Route::put('/edit-post/{post}', [asmaacontroller::class,'update_post']);
Route::delete('/delete-post/{post}', [asmaacontroller::class,'deletePost']);
