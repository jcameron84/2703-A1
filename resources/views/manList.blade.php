<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <title>Manufacturers</title>
</head>
<body>
    <h1>Manufacturers</h1>

    @foreach($manufacturers as $manufacturer)
        <div class="manufacturer">
            <p><strong>{{ $manufacturer->ManName }}</strong></p>
            <p>Average Rating: {{ number_format($manufacturer->avg_manufacturer_rating, 2) }}</p>
            <a href="{{ url('manufacturer/' . $manufacturer->ManId . '/items') }}">View Items</a>
        </div>
    @endforeach
</body>
</html>
