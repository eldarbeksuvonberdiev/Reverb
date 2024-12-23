<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Man sho'rdaman
    </h1>
    @foreach ($users as $user)
        <h3>Name: {{ $user->name }}</h3>
        <h3>Email: {{ $user->email }}</h3>
    @endforeach
</body>
</html>