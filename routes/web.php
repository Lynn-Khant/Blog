<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogConroller;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;

Route::get('/', [BlogConroller::class,'index']);

Route::get('/blogs/{blog:slug}',function(Blog $blog){
    return view('blog',[
        'blog'=>$blog,
        'randomBlogs'=>Blog::inRandomOrder()->take(3)->get(),
        
    ]);

});

Route::get('/register',[AuthController::class,'create'])->middleware('guest');
Route::post('/register',[AuthController::class,'store'])->middleware('guest');

Route::post('/logout',[AuthController::class,'logout'])->middleware('auth');

Route::get('/login',[AuthController::class,'login_create'])->middleware('guest');
Route::post('/login',[AuthController::class,'login_store'])->middleware('guest');

Route::post('/blogs/{blog:slug}/comments',[CommentController::class,'store']);

Route::post('/blogs/{blog:slug}/subscription',[BlogConroller::class,'subscriptionHandler']);

Route::middleware('can:isAdmin')->group(function(){
    Route::get('/admin/blogs/create',[BlogConroller::class,'create']);
    Route::get('/admin/blogs',[BlogConroller::class,'blogs']);
    Route::post('/admin/blogs/store',[BlogConroller::class,'store']);
    Route::delete('/admin/blogs/{blog:slug}/delete',[BlogConroller::class,'destroy']);
    Route::get('/admin/blogs/{blog:slug}/edit',[BlogConroller::class,'edit']);
    Route::patch('/admin/blogs/{blog:slug}/update',[BlogConroller::class,'update']);
});
