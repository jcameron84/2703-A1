<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <title>Items from {{ $manufacturer->ManName }}</title>
</head>
<body>
    <h1>Items from {{ $manufacturer->ManName }}</h1>

    @foreach($items as $item)
        <div class="item">
            <p><strong>{{ $item->ItemName }}</strong></p>
            <p>Average Rating: {{ $item->avg_item_rating ? number_format($item->avg_item_rating, 2) : 'No ratings yet' }}</p>
            <a href="{{ url('item/' . $item->ItemId) }}">View Reviews</a>
        </div>
    @endforeach
</body>
</html>
