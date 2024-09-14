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

Route::get('/', function (Illuminate\Http\Request $request) {
  
    $sort = $request->input('sort', 'reviews_desc'); // Default sorting method

    // Base SQL query
    $sql = "SELECT Item.*, Manufacturer.ManName, 
                (SELECT COUNT(*) FROM Review WHERE Review.ItemId = Item.ItemId) as review_count, 
                (SELECT AVG(Rating) FROM Review WHERE Review.ItemId = Item.ItemId) as avg_rating
            FROM Item
            LEFT JOIN Manufacturer ON Item.ManId = Manufacturer.ManId";

    switch ($sort) {
        case 'reviews_asc':
            $sql .= " ORDER BY review_count ASC";
            break;
        case 'reviews_desc':
            $sql .= " ORDER BY review_count DESC";
            break;
        case 'rating_asc':
            $sql .= " ORDER BY avg_rating ASC";
            break;
        case 'rating_desc':
            $sql .= " ORDER BY avg_rating DESC";
            break;
        default:
            $sql .= " ORDER BY review_count DESC"; // Default sorting
    }

    
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



Route::get('createItem', function () {
    $manufacturers = DB::table('Manufacturer')->get();
    return view('addItem')->with('manufacturers', $manufacturers);
});

Route::post('/itemStore', function (Illuminate\Http\Request $request) {
    $errors = [];

    $name = $request->input('name');

    if (strlen($name) <= 2) {
        $errors[] = 'Item name must be more than 2 characters long.';
    } elseif (preg_match('/[-_+"\']/', $name)) { // Check for -, _, +, or "
        $errors[] = 'Item name must not contain -, _, +, or ".';
    }

    $manufacturerId = $request->input('manufacturer_id');
    if (empty($manufacturerId)) {
        $errors[] = 'Manufacturer is required.';
    } elseif (!DB::table('Manufacturer')->where('ManId', $manufacturerId)->exists()) {
        $errors[] = 'Selected manufacturer does not exist.';
    }

    if (!empty($errors)) {
        return redirect()->back()->withErrors($errors)->withInput();
    }

    DB::table('Item')->insert([
        'ItemName' => $name,
        'ManId' => $manufacturerId,
        'Tracks' => 'Tracks',
        'CoverImage' => 'images/placeholderimg.png'
    ]);

    // Redirect back to the item list or another page
    return redirect('/')->with('success', 'Item added successfully!');
});

Route::get('test', function () {
    return view('feed');
});