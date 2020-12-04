<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<h1>Register.</h1>
<form action="../index.php?target=user&action=add" method="post">
    <div class="form-group">
        <label>Username:</label>
           <input type="text" name = "Username" class="form-control" required>
           <div class="form-group">
        <label>Password:</label>
            <input type="text" name = "Password" class="form-control" required>
            <div class="form-group">
        <label>Email:</label>
           <input type="text" name = "Email" class="form-control" required>
           <div class="form-group">
        <button type="submit" class="btn btn-primary"> Start </button>
    </div>
</form>
</body>
</html>
