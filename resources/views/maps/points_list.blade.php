<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Points List</title>
</head>
<body>
    <h1>List of Points in DB</h1>

    <ul>
        @foreach($points as $point) 
            <li><a href="{{ url('point/' . $point->id) }}">{{ $point->description }}</a></li>
        @endforeach
    </ul>
    
</body>
</html>