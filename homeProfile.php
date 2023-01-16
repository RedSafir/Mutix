<?php
require "nav.php";


$login = false;

if (isset($_SESSION['_login'])) {

    $login = true;
} else if (isset($_COOKIE['_id'])) {

    $login = true;
    $data['_username'] = $_COOKIE['_id'];
    $data['_password'] = $_COOKIE['_pas'];

    if (ceklogin($data)) {

        echo "<script>alert('selamat datang kembali');</script>";
    }
}

if (isset($login)) {

    if ($login) {

        $profile = [];
        $profile = cekProfile();

        $aut = $_SESSION['_aut'];
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Profil Saya | MUTIX</title>
</head>

<body>
    <div class="container text-center mt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <?php if (!$login) : ?>
                    <img src="image/NoUser.png" alt="error" width="250" style="border-image: 50%;">
                <?php else : ?>
                    <img src="image/<?php echo $profile[0]['gambar'] ?>" alt="error" width="250" style="border-radius: 50%;">
                <?php endif ?>
                </a>
            </div>
            <div class="col-4 me-5">
                <<?php if ($login) : ?> <br><br>
                    <?php if ($aut == 'admin') : ?>
                        <a href="formUpAdmin.php" target="_blank">Edit Account</a>
                    <?php endif ?>
                    <?php if ($aut == 'staff') : ?>
                        <a href="formUpStaff.php" target="_blank">Edit Account</a>
                    <?php endif ?>
                    <?php if ($aut == 'user') : ?>
                        <a href="formUpUser.php" target="_blank">Edit Account</a>
                    <?php endif ?>
                    <br><br>

                <?php endif ?>

                <?php if ($login) : ?>
                    <h2>Nama</h2>
                    <p><?php echo $profile[0]['nama'] ?></p>
                <?php else : ?>
                    <h2>Anda Belum Login</h2>
                <?php endif ?>
                </section>
            </div>


        </div>
    </div>










</body>

</html>