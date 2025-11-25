<!DOCTYPE html>
<html lang="fi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1>Welcome, {{ $user->Nimi }}</h1>
    <p>Email: {{ $user->Sähköposti }}</p>
    <p>Phone: {{ $user->Puhelin }}</p>

    <a href="{{ route('logout') }}">Logout</a>
</body>

</html>