<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" tpye="text/css" href="css/main.css">
  </head>
  
  <body>
    
    @foreach($items as $item)
 
    <?php
       $ItemId = $item->ItemId; 
       $DisplayName = $item->DisplayName;
       $ReviewId = $item->ReviewId;
       $ItemName = $item->ItemName;
       $ReviewBody = $item->ReviewBody;
       $Date = $item->Date;
       $ManName = $item->ManName;
      ?>
      
      <div class="thumbnail">
      <a href="https://s5220233.elf.ict.griffith.edu.au/WebAppDev/AssignmentPart1/public/item/{{ $ItemId }}">
        <img class="thumbImage" src="{{ asset('images/placeholderimg.png')}}"> 

        <div class="thumbTextDiv">
          <p class="thumbTitle"> {{ $ItemName }} </p> 
          <p class=thumbUser> {{ $ManName }} </p>
        </div> 
      </a> 
      
      <p class="feedDate"> Rating: {{ $Date }}</p>
        
      </div>
      
    @endforeach
    
  </body>
</html>

