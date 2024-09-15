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
        return view('itemDetails', ['ItemId' => $ItemId])->with('item', $item)->with('reviews', $reviews);
    } else {
        abort(404, 'Item not found');
    }
});

Route::get('manufacturers', function () {
    $manufacturers = DB::table('Manufacturer')
        ->join('Item', 'Manufacturer.ManId', '=', 'Item.ManId')
        ->join('Review', 'Item.ItemId', '=', 'Review.ItemId')
        ->select('Manufacturer.ManId', 'Manufacturer.ManName', 
            DB::raw('AVG(Review.Rating) as avg_manufacturer_rating'))
        ->groupBy('Manufacturer.ManId')
        ->get();

    return view('manList', ['manufacturers' => $manufacturers]);
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
    return redirect('/')->with('success', 'Item added successfully!');
});

//Route for creating a new reviw
Route::get('item/{ItemId}/addReview', function ($ItemId) {
    $item = DB::table('Item')->where('ItemId', $ItemId)->first();
    return view('addReview')->with('item', $item);
});

//Route for handling form submission for new review
Route::post('item/{ItemId}/storeReview', function (Illuminate\Http\Request $request, $ItemId) {
    $errors = [];

    $username = $request->input('username');
    $originalUsername = $username;
    $username = preg_replace('/[13579]/', '', $username);
    if ($username !== $originalUsername) {
        session()->flash('username_changed', "The username '$originalUsername' was changed to '$username' after odd numbers were removed.");
    }

    $rating = $request->input('rating');
    $reviewBody = $request->input('reviewBody');

    if (strlen($username) <= 2) {
        $errors[] = 'user name must be more than 2 characters long.';
    } elseif (preg_match('/[-_+"\']/', $username)) { // Check for -, _, +, or "
        $errors[] = 'user name must not contain -, _, +, or ".';
    }


    if (!empty($errors)) {
        return redirect()->back()->withErrors($errors)->withInput();
    }

        // Check if the user exists by username
        $user = DB::table('User')->where('DisplayName', $username)->first();

        // If the user does not exist, insert them into the User table
        if (!$user) {
            $userId = DB::table('User')->insertGetId([
                'DisplayName' => $username,
            ]);
        } else {
            $userId = $user->UserId; 
        }
    
        // Check if the user has already reviewed this item
        $existingReview = DB::table('review')
                            ->where('ItemId', $ItemId)
                            ->where('UserId', $userId)
                            ->first();
    
        if ($existingReview) {
            // If the user already reviewed this item error
            return redirect()->back()->withErrors(['error' => 'You have already reviewed this item.'])->withInput();
        }
    
        // If no existing review, insert the new review
        DB::table('Review')->insert([
            'ItemId' => $ItemId,
            'UserId' => $userId, 
            'Rating' => $rating,
            'ReviewBody' => $reviewBody,
            'Date' => now(),
        ]);
    
        return redirect('item/' . $ItemId)->with('success', 'Review added successfully!');
    });

    //Route for deleting an item
    Route::delete('item/{ItemId}/delete', function ($ItemId) {
        DB::transaction(function () use ($ItemId) {
            // Delete all reviews associated with the item
            DB::table('Review')->where('ItemId', $ItemId)->delete();
    
            // Delete the item itself
            DB::table('Item')->where('ItemId', $ItemId)->delete();
        });

        return redirect('/')->with('success', 'Item and all associated reviews have been deleted successfully.');
    });




    Route::get('manufacturer/{ManId}/items', function ($ManId) {
        // Query to get items for the manufacturer and their average rating
        $items = DB::table('Item')
            ->leftJoin('Review', 'Item.ItemId', '=', 'Review.ItemId')
            ->where('Item.ManId', $ManId)
            ->select('Item.ItemId', 'Item.ItemName', 
                DB::raw('AVG(Review.Rating) as avg_item_rating'))
            ->groupBy('Item.ItemId')
            ->get();
    
        // Get manufacturer name for display
        $manufacturer = DB::table('Manufacturer')->where('ManId', $ManId)->first();
    
        return view('manItemList', ['items' => $items, 'manufacturer' => $manufacturer]);
    });


Route::get('test', function () {
    return view('feed');
});