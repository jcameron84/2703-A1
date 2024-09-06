<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" tpye="text/css" href="css/main.css">
  </head>
  
  <body>
    
    @foreach($posts as $post)
      <?php
       $userID = $post->userID; 
       $displayName = $post->displayName;
       $postID = $post->postID;
       $title = $post->title;
       $message = $post->message;
       $date = $post->date;
      ?>
      
      <div class="thumbnail">
      <a href="https://s5220233.elf.ict.griffith.edu.au/WebAppDev/AssignmentPart1/Assignment1/public/post={{ $postID }}">
        <img class="thumbImage" src="{{ asset('images/placeholderimg.png')}}"> 

        <div class="thumbTextDiv">
          <p class="thumbTitle"> {{ $title }} </p> 
          <p class=thumbUser> {{ $displayName }} </p>
        </div> 
      </a> 
      
      <p class="feedDate"> Date posted: {{ $date }}</p>
        
      </div>
      
    @endforeach
    
  </body>
</html>

