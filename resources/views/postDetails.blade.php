<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  
  <body>  
    @include('navbar')
    <br>
    <?php
       $userID = $post->userID; 
       $displayName = $post->displayName;
       $postID = $post->postID;
       $title = $post->title;
       $message = $post->message;
       $date = $post->date;
      ?>
    <div class="detailsBG">

      <img class="detailsImage" src="{{ asset('images/placeholderimg.png')}}">
      <p class="postTitle">{{ $title }}</p>
      <p class="postAuthor"> {{ $displayName }}</p>
      <p class="postAuthor">{{ $date }}</p>
      <p class="postMessage">{{ $message }}</p>

    </div>

    <div class="detailsCommentBox">
      <div class="commentTitle">
        <p class="commentTitle">Comments</p>
      </div>   
      
    </div>
  </body>
</html>

