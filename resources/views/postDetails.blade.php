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

      <img class="detailsImage" src="{{ asset($item->CoverImage) }}">
      <p class="postTitle">{{ $item->ItemName }}</p>
      <p class="postAuthor"> {{ $item->ManName }}</p>
      <p class="postMessage">{{ $item->Tracks }}</p>

    </div>

    <div class="detailsCommentBox">
      <div class="commentTitle">
        <p class="commentTitle">Reviews</p>
      </div>   
      @if (count($reviews) > 0)
            @foreach ($reviews as $review)
            <div class="reviewBox">
                <p class="reviewUser">{{ $review->DisplayName }}</p>
                <p class="reviewRating">Rating: {{ $review->Rating }}/10</p>
                <p class="reviewBody">{{ $review->ReviewBody }}</p>
                <p class="reviewDate">Date: {{ $review->Date }}</p>
            </div>
            @endforeach
        @else
            <p>No reviews yet for this item.</p>
        @endif
    </div>
  </body>
</html>

