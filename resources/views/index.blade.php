<!DOCTYPE html>

<html>
  <head>
    <title>Z-Music</title>
    <meta charset="utf-8">
    
  </head>
  
  <body>  
      @include('navbar') 
      <div class="sorting-buttons">
      <form method="GET" action="{{ url('/') }}">
        <label for="sort">Sort By:</label>
        <select name="sort" id="sort">
          <option value="reviews_asc" {{ request('sort') == 'reviews_asc' ? 'selected' : '' }}>Reviews (Ascending)</option>
          <option value="reviews_desc" {{ request('sort') == 'reviews_desc' ? 'selected' : '' }}>Reviews (Descending)</option>
          <option value="rating_asc" {{ request('sort') == 'rating_asc' ? 'selected' : '' }}>Rating (Ascending)</option>
          <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>Rating (Descending)</option>
        </select>
        <button type="submit">Sort</button>
      </form>
    </div>
      @include('feed')
  </body>
</html>

