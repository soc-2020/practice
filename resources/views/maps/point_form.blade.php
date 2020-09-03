<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point Form</title>
</head>
<body>
    <h1>Point {{ $point->description }}</h1>

    <form method="post" action="{{ url('point/update') }}">
        @csrf
        <input hidden value="{{ $point->id }}" name="id">
        Description: <input type="text" value="{{ $point->description }}" name="description">
        Latitude: <input type="text" value="{{ $point->lat }}" name="lat">
        Longitude: <input type="text" value="{{ $point->lon }}" name="lon">
        <input type="submit">
    </form>
</body>
</html>