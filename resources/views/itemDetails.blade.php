<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  
  <body>  
    @include('navbar')
    <br>


    @if (session('username_changed'))
    <div class="alert alert-info">
        {{ session('username_changed') }}
    </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="detailsBG">

      <img class="detailsImage" src="{{ asset($item->CoverImage) }}">
      <p class="postTitle">{{ $item->ItemName }}</p>
      <p class="postAuthor"> {{ $item->ManName }}</p>
      <p class="postMessage">{{ $item->Tracks }}</p>
      <form action="{{ url('item/' . $item->ItemId . '/delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item and all its reviews?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Item</button>
      </form>
    </div>
    @include('reviewsBox')
  </body>
</html>



