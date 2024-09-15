<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <title>Add Review for {{ $item->ItemName }}</title>
</head>
<body>

    @include('navbar')
    
    <div class="container">
        <h1>Add a Review for {{ $item->ItemName }}</h1>
        
        <!-- Display validation errors -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- Add review form -->
        <form action="{{ url('item/' . $item->ItemId . '/storeReview') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="username">Display Name:</label>
                <input type="string" id="username" class="form-control" name="username" required>
            </div>

            <div class="form-group">
                <label for="rating">Rating (1-10):</label>
                <input type="number" id="rating" name="rating" class="form-control" min="1" max="10" required>
            </div>

            <div class="form-group">
                <label for="reviewBody">Review:</label>
                <textarea id="reviewBody" name="reviewBody" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>

</body>
</html>
