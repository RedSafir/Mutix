<?php 
    require "QcekLogin.php";

    if(isset($_POST['_submit'])){
        if(ceklogin($_POST)){

            echo "
            <script> alert('login berhasil');
            document.location.href = 'homeProfile.php';
            </script>";
            exit;
        }else{
            $error = true;
        }
    }
?>

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

    <?php if(isset($error)) : ?>
        <p>Username atau password salah</p>
    <?php endif ?>

    <form  method="POST" action="">
        <label for="username">Username :</label>
        <input type="text" name="_username" id="username">
        <br>
        <label for="password">Password :</label>
        <input type="password" name="_password" id="password">
        <br>
        <input type="checkbox" name="_remember_me" id="_remember_me">
        <label for="_remember_me">Remember me</label>
        <br>
        <button type="submit" name="_submit">Login</button>
    </form>
    <a href="formRegUser.php"><button>Register</button></a>
    <a href=""></a>
</body>
</html>