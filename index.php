<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>LOGIN FORM</h1>

    <?php if(isset($_GET["error"])) : ?>
        <p>Username atau password salah</p>
    <?php endif ?>

    <form  method="POST" action="function/cekLogin.php">
        <label for="username">Username :</label>
        <input type="text" name="_username" id="username">
        <br>
        <label for="password">Password :</label>
        <input type="password" name="_password" id="password">
        <br>
        <button type="submit" name="_submit">Login</button>
    </form>
    <a href="registerForm.php"><button>Register</button></a>
</body>
</html>