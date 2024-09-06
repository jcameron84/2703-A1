<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" tpye="text/css" href="css/main.css">
  </head>
  
  <body>  
    @include('navbar')
    <br>
    <div class="detailsBG">

      <img class="detailsImage" src="{{ asset('images/placeholderimg.png')}}">
      <p class="postTitle">TITLE</p>
      <p class="postAuthor"> ExampleUser</p>
      <p class="postAuthor"> DD-MM-YYYY</p>
      <p class="postMessage">Example Text</p>

    </div>

    <div class="detailsCommentBox">
      <div class="commentTitle">
        <p class="commentTitle">Comments</p>
      </div>   
      
    </div>
  </body>
</html>

