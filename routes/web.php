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
    $sql = "SELECT * FROM Item, Manufacturer, Review WHERE Item.ManId = Manufacturer.ManId AND Review.ItemId = Item.ItemId AND Item.ItemId = ?";
    $item = DB::select($sql, [$ItemId]);

    $sql_reviews = "SELECT Review.*, User.DisplayName FROM Review 
                    JOIN User ON Review.UserId = User.UserId 
                    WHERE Review.ItemId = ?
                    ORDER BY Review.Date DESC";
    $reviews = DB::select($sql_reviews, [$ItemId]);

    if ($item) {
        $item = $item[0]; 
        return view('postDetails', ['ItemId' => $ItemId])->with('item', $item)->with('reviews', $reviews);
    } else {
        abort(404, 'Item not found');
    }
});

Route::get('userlist', function(){
    $sql = "SELECT displayName FROM USER";
    $users = DB::select($sql);
    return view('userList')->with('users', $users);
});



Route::get('create', function () {
    // Fetch manufacturers to show in the dropdown
    $manufacturers = DB::table('Manufacturer')->get();
    return view('addItem')->with('manufacturers', $manufacturers);
});

// Handle form submission to add a new item
Route::post('item/store', function (Illuminate\Http\Request $request) {
    // Validate the input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'manufacturer_id' => 'required|exists:Manufacturer,ManId',
    ]);

    // Insert the new item into the database
    DB::table('Item')->insert([
        'Name' => $validated['name'],
        'ManId' => $validated['manufacturer_id'],
        'Tracks' => '' // You can handle tracks separately if needed
    ]);

    // Redirect back to the item list or another page
    return redirect('/')->with('success', 'Item added successfully!');
});

Route::get('test', function () {
    return view('feed');
});