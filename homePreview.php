<?php 
    require "QcekLogin.php";
    //======================================================= cek profile ============================================\\
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

    //=======================================================mengakses data===================================================\\
    if(isset($_GET['id'])){
        $id_film = $_GET['id'];
    }else{
        header("Location : homepage.php");
        exit;
    }

    $film = query("SELECT * FROM film WHERE id_film = $id_film");

    //====================================================== posisi ========================================================\\
    // if (!isset($_SESSION['posisi']) == 1)
    // {
    //     $_SESSION['posisi'] = 1;
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Film</title>
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

    <br><br>
            <a href="javascript:history.go(-1)">kembali</a>
    <br>

    <h1><?php echo $film[0]['judul_film'] ?></h1>
    <br>
    <img src="image/<?php echo $film[0]['gambar'] ?>" alt="error" width="250">
    <h3><?php echo $film[0]['deskripsi'] ?></h3>
    <a href="homePesan.php?id=<?php echo $film[0]['id_film'] ?>">pesan</a>
</body>
</html>