<?php
require "QcekLogin.php";
global $login;

if(isset($_SESSION['_login'])){

  $login = true;
}else if(isset($_COOKIE['_id'])){

  $login = true;
  $data['_username'] = $_COOKIE['_id'];
  $data['_password'] = $_COOKIE['_pas'];

  if(ceklogin($data)){

      echo "<script>alert('selamat datang kembali');</script>";
  }
}

if(isset($login)){

  if($login){

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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="WhatsApp_Image_2023-01-16_at_22.59.41-removebg-preview.png" alt="" width="100"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="homePage.php">Home</a>
        <a class="nav-link" href="hometiketUser.php">Tiket Saya</a>
        <a class="nav-link" href="javascript:history.go(-1)">Kembali</a>
        
        <a class="navbar-brand" href="homeProfile.php">
        <?php if(!$login) : ?>
            <a href="formLogin.php" class="nav-link">Login</a>
                <img src="image/NoUser.png" alt="error" width="30" height="24" class="d-inline-block align-text-top" style="border-image: 50%;">
            </a>
        <?php else : ?>
            <a href="QLogOut.php" class="nav-link">LogOut</a>
            <a href="homeProfile.php">
            <img src="image/<?php echo $profile[0]['gambar'] ?>" alt="error" width="30" height="24" class="d-inline-block align-text-top" style="border-image: 50%;">
            </a>
          <?php endif; ?></div>
    </div>
  </div>
</nav>
</body>
</html>