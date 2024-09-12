<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  
  <body>  
    @include('navbar')
    <br>

    <div class="detailsBG">

      <img class="detailsImage" src="{{ asset('images/placeholderimg.png')}}">
      <p class="postTitle">{{ $item->ItemName }}</p>
      <p class="postAuthor"> {{ $item->ManName }}</p>
      <p class="postMessage">{{ $item->Tracks }}</p>

    </div>

    <div class="detailsCommentBox">
      <div class="commentTitle">
        <p class="commentTitle">Reviews</p>
      </div>   
      
    </div>
  </body>
</html>

