<?php 
    require "QcekLogin.php";

    $login = false;
    
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
    <title>Document</title>
</head>
<body>
<h1>MUTIX.ID</h1>
    <a href="homePage.php">Home</a>
    <a href="hometiketUser.php">Tiket Saya</a>
    <a href="homeProfile.php">
    <?php if(!$login) : ?>
            <a href="formLogin.php">Login</a>
            <a href="homeProfile.php">
                <img src="image/NoUser.png" alt="error" width="50" >
            </a>
        <?php else : ?>
            <img src="image/<?php echo $profile[0]['gambar'] ?>" alt="error" width="50">
            <a href="QLogOut.php">LogOut</a>
        <?php endif; ?>
    </a>

    <br><br><br>
    
    <a href="">
    <?php if(!$login) : ?>
            <img src="image/NoUser.png" alt="error" width="250" >
        <?php else : ?>
            <img src="image/<?php echo $profile[0]['gambar'] ?>" alt="error" width="250">
        <?php endif ?>
    </a>


    <?php if($login) : ?>

        <br><br>
            <?php if($aut == 'admin') : ?>
                <a href="formUpAdmin.php" target="_blank">Edit Account</a>
            <?php endif ?>
            <?php if($aut == 'staff') : ?>  
                <a href="formUpStaff.php" target="_blank">Edit Account</a>
            <?php endif ?>  
            <?php if($aut == 'user') : ?>
                <a href="formUpUser.php" target="_blank">Edit Account</a>
            <?php endif ?>
        <br><br>

    <?php endif ?>  
    
    <?php if($login) : ?>
        <h2>Nama</h2>
        <p><?php echo $profile[0]['nama'] ?></p>
    <?php else : ?>
        <h2>Anda Belum Login</h2>
    <?php endif ?>
    
</body>
</html>