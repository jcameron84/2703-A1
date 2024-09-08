<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" tpye="text/css" href="css/main.css">
  </head>
  
  <body>  
    @include('navbar')
   
    @foreach($users as $user)
        <p>{{ $user->displayName }}</p>
    @endforeach
    
  </body>
</html>

