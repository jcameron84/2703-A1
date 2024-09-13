<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
        <title>Add New Item</title>
    </head>

    <body>
        @include('navbar')
        <div class="container">
            <h1>Add a New Item</h1>

            <!-- Display validation errors -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> <!-- Use double curly braces -->
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Display success message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }} <!-- Use double curly braces -->
                </div>
            @endif

            <!-- Add item form -->
            <form action="/item/store" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Item Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="manufacturer">Select Manufacturer:</label>
                    <select id="manufacturer" name="manufacturer_id" class="form-control" required>
                        <option value="">Select Manufacturer</option>
                        @foreach ($manufacturers as $manufacturer)
                            <option value="{{ $manufacturer->ManId }}">{{ $manufacturer->Name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Add Item</button>
            </form>
        </div>
    </body>
</html>
