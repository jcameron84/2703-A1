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
        $ItemName = $item->ItemName;
        $ManName = $item->ManName;
        $CoverImage = $item->CoverImage;
        $reviewCount = $item->review_count;
        $avgRating = $item->avg_rating;
      ?>
      
      <div class="thumbnail">
        <a href="https://s5220233.elf.ict.griffith.edu.au/WebAppDev/AssignmentPart1/public/item/{{ $ItemId }}">
        <img class="thumbImage" src="{{ !empty($CoverImage) ? asset($CoverImage) : asset('images/placeholderimg.png') }}">


        <div class="thumbTextDiv">
          <p class="thumbTitle"> {{ $ItemName }} </p> 
          <p class=thumbUser> {{ $ManName }} </p>
        </div> 
      </a> 
      
      <p class="feedDate"> Rating: {{ number_format($avgRating, 2) }}</p>
        
      </div>
      
    @endforeach
    
  </body>
</html>

