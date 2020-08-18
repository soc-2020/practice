<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Combo Box DB populated</h2>

    <form method="post" action="{{ url('form/combo/action') }}">
        @csrf
        <select name="country" id="">
            @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
        <button type="submit">Go</button>
    </form>
</body>
</html>