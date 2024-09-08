<!DOCTYPE html>
<!-- Home page for basic factorisation example. -->
<html>
  <head>
    <title>New Post on Z</title>
    <meta charset="utf-8">
    
  </head>
  
  <body>  
      @include('navbar') 
      
    <form class="newPostForm" action="create_new_post" method="post">
        {{csrf_field()}}
        Title: <br>
        <input type="text" name="title"><br> 
        Display Name: <br>
        <input type="text" name="displayName"><br>
        Message: <br>
        <textarea type="text" name="message"></textarea><br><br>
        <input type="submit" value="add">

    </form>


  </body>
</html>

