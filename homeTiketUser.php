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
    //=========================================================== ambil data =============================================\\
    if(isset($login))
    {
        $aut = $_SESSION['_aut'];
        $id = $_SESSION['_id'];

        if($aut == 'user'){
            $query_tiket = query("SELECT * FROM tiket_tayang INNER JOIN user ON tiket_tayang.id_user = user.id_user INNER JOIN tiket ON tiket_tayang.id_tiket=tiket.id_tiket INNER JOIN film ON tiket.id_film=film.id_film WHERE User.id_user=$id");
        }else if($aut == 'staff'){
            $query_tiket = query("SELECT * FROM tiket_tayang INNER JOIN staff ON tiket_tayang.id_staff = staff.id_staff INNER JOIN tiket ON tiket_tayang.id_tiket=tiket.id_tiket INNER JOIN film ON tiket.id_film=film.id_film WHERE staff.id_staff=$id");
        }else if($aut == 'admin'){
            $query_tiket = query("SELECT * FROM tiket_tayang INNER JOIN admin ON tiket_tayang.id_admin = admin.id_admin INNER JOIN tiket ON tiket_tayang.id_tiket=tiket.id_tiket INNER JOIN film ON tiket.id_film=film.id_film WHERE admin.id_admin=$id");
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
    <title>Tiket Saya</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MUTIX</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="homePage.php">Home</a>
        <a class="nav-link active" aria-current="page" href="hometiketUser.php">Tiket Saya</a>
        <a class="nav-link" href="javascript:history.go(-1)">Kembali</a>
        <a class="nav-link" href="QLogOut.php">Logout</a>
        <a class="navbar-brand" href="homeProfile.php">
        <?php if(!$login) : ?>
            <a href="formLogin.php" class="nav-link">Login</a>
                <img src="image/NoUser.png" alt="error" width="30" height="24" class="d-inline-block align-text-top" >
            </a>
        <?php else : ?>
            <a href="QLogOut.php" class="nav-link">LogOut</a>
            <a href="homeProfile.php">
            <img src="image/<?php echo $profile[0]['gambar'] ?>" alt="error" width="30" height="24" class="d-inline-block align-text-top">
            </a>        
            <?php endif; ?></div>
    </div>
  </div>
</nav>
    
    <br><br>

    <?php if(!$login) :  ?>
        <h1>Tidak ada transaksi</h1>
    <?php else : ?>
        <?php foreach($query_tiket as $tiket) : ?>
            <table>
                <tr>
                    
                    <td><h1><?php echo $tiket['id_tiket'] ?></h1></td>
                    <td><p><?php echo $tiket['judul_film'] ?></p></td>
                    <td><p><?php echo $tiket['waktu'] ?></p></td>
                    <td><p><?php echo $tiket['tot_harga'] ?></p></td>
                    <td><a href="homeBuktiTransaksi.php?id_tiket=<?php echo $tiket['id_tiket'] ?>">cari tau!</a></td>
                </tr>
            </table>
        <?php endforeach ?>
    <?php endif ?>
</body>
</html>