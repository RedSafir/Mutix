<?php
require "QcekLogin.php";

if (isset($_POST['_submit'])) {
    if (ceklogin($_POST)) {

        echo "
            <script> alert('login berhasil');
            document.location.href = 'homeProfile.php';
            </script>";
        exit;
    } else {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
    </style>
</head>

<body>
    <?php if (isset($error)) : ?>
        <?php echo '<script>alert("Username atau Password salah")</script>'; ?>
    <?php endif ?>
    <form method="POST" action="">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 2rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-4 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>
                                <form action="#" method="post" enctype="application/x-www-form-urlencoded">
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label"></label>
                                    <input type="text" name="_username" id="username" required title="Username required" class="form-control form-control-lg" placeholder="Username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label"></label>
                                    <input type="password" name="_password" id="password" required title="Password required" data-icon="x" class="form-control form-control-lg" placeholder="Password">
                                </div>
                                <input type="checkbox" name="_remember_me" id="_remember_me">
                                <a label for="_remember_me">Remember me</label></a>
                                
                                <br>
                                <br>

                                <button type="submit"  class="btn btn-outline-light btn-lg px-5" name="_submit">Login</button>
                                </form>
                                <br>
                                <br>
                                <p class="mt-2">Belum punya akun? <a href="formRegUser.php" class="text-white-50 fw-bold">Daftar disini</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>
    <br>
    <br>
</body>
</html>