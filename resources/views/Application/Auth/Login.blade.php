<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Login</title>
</head>
<body>
        <h1>Admin Login</h1>
        <form class="form-controller" action="{{route('admin.login')}}" method="post">
            @csrf
            <label for="">Admin</label>
            <input type="text" placeholder="Admin" name="name" id="username" required>
            <label for="">Password</label>
            <input type="password" placeholder="Password" name="password" id="password" required>
            <button type="submit">Login</button>
        </form>
</body>
</html>