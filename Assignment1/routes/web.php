<?php

use Illuminate\Support\Facades\Route;

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
    $sql = "SELECT * FROM USER, USER_POST WHERE user_post.author = user.userID ORDER BY USER_POST.date DESC";
    $posts = DB::select($sql);
    return view('index')->with('posts', $posts);
});



Route::get('post/', function (){
    return view('postDetails');
});

Route::get('userlist', function(){
    $sql = "SELECT displayName FROM USER";
    $users = DB::select($sql);
    return view('userList')->with('users', $users);
});



Route::get('makePost', function () {
    return view('newPost');
});


Route::post('create_new_post', function () {
    $title=request('title');
    $author=request('displayName');
    $message=request('message');
    add_post($title, $author, $message);
});

function add_post($title, $author, $message){
    $sql="insert into USER_POST (postID, title, author, message, date) values (NULL, ?, ?, ?, NULL)";
    DB::insert($sql, array($title, $author, $message));
    $id = DB::getPdo()->lastInsertId();
    dd($id);
}

Route::get('test', function () {
    return view('feed');
});