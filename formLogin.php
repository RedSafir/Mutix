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
    <title>Log In | MUTIX</title>
    <link rel="stylesheet" href="http://localhost/mutix/formLogin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
         </style>
    </head>
<body>
<nav class="navbar bg-light">
    <div class="container-fluid">
         <a class="navbar-brand" href="#">
          <img src="http://localhost/mutix/image/Maroon%20Minimalist%20Cinema%20Ticket%20(5).png" alt="Logo" width="60" height="54" class="d-inline-block align-text-top">
          Login
             </a>
        </div>
    </nav>
      

    <?php if(isset($error)) : ?>
        <p>Username atau password salah</p>
    <?php endif ?>

    <form  method="POST" action="">
    <center>
    <section class="login">
	<div class="titulo">Login</div>
	<form action="#" method="post" enctype="application/x-www-form-urlencoded">
    	<input type="text" name="_username" id="username" required title="Username required" placeholder="Username" data-icon="U">
        <input type="password" name="_password" id="password" required title="Password required" placeholder="Password" data-icon="x">
        <div class="olvido">
        	<div class="col"><a href="formRegUser.php" title="Ver Carásteres">Register</a></div>
            <div class="col"><a name="_remember_me" title="Recuperar Password">Remember Me</a></div>
        </div>
        <button type="submit" name="_submit">Login</button>
    </form>
</section>
        
        
</body>
</html>