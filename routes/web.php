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
    $sql = "SELECT * FROM User, Review, Item, Manufacturer WHERE Review.ItemId = Item.ItemId AND Review.UserId = user.UserId AND Item.ManId = Manufacturer.ManId ORDER BY Review.date DESC";
    $items = DB::select($sql);
    return view('index')->with('items', $items);
});



Route::get('item/{ItemId}', function ($ItemId) {
    $sql = "SELECT * FROM Item, Manufacturer WHERE Item.ManId = Manufacturer.ManId AND Item.ItemId = ?";
    $item = DB::select($sql, [$ItemId]);

    if ($item) {
        $item = $item[0]; 
        return view('postDetails', ['ItemId' => $ItemId])->with('item', $item);
    } else {
        abort(404, 'Item not found');
    }
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