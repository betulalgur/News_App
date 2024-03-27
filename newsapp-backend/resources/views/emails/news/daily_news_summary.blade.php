<!DOCTYPE html>
<html>
<head>
    <title>Daily News Summary</title>
</head>
<body>
<h1>Daily News Summary</h1>
@foreach ($newsItems as $item)
    <h2>{{ $item->title }}</h2>
    <p>{{ $item->summary }}</p>
    <hr>
@endforeach
</body>
</html>
