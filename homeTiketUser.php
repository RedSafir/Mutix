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
    <title>Tiket Saya</title>
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