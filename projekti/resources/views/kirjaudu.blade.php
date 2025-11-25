<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login Page</h1>
    <form method="POST" action="/kirjaudu">
        @csrf
        <input type="email" name="sähköposti" required>
        <input type="password" name="SalasanaHash" required>
        <button type="submit">Login</button>
    </form>
</body>

</html>