<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NGENTOT</title>
</head>
<body>
    @if (Auth::user())
        halo {{Auth::user()->name}} kontol
    @endif
    <form action="{{ route('gnetot-upload')}}" method="POST">
        @csrf
        <input type="file" name="ngentot" id="">
        <button type="submit">tai</button>
    </form>
</body>
</html>