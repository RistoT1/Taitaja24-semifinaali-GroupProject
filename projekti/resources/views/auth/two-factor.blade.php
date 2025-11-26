<!DOCTYPE html>
<html>
<head>
    <title>Two-Factor Authentication</title>
</head>
<body>

<h1>Enter Verification Code</h1>

@if($errors->any())
    <p style="color:red;">{{ $errors->first() }}</p>
@endif

<form method="POST" action="/2fa">
    @csrf
    <input type="text" name="code" placeholder="Enter 6-digit code">
    <button type="submit">Verify</button>
</form>

</body>
</html>
