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

    //===================================== masukan nilai ================================\\

    if(!isset($_GET['id_tiket'])){
        echo "<script>alert('terjadi kesalahan');
            document.location.href = 'homePage.php';
            </script>";
    }
    
    $id_tiket = $_GET['id_tiket'];
    $query_tiket = query("SELECT * FROM tiket WHERE id_tiket = $id_tiket");
    $id_ruangan = $query_tiket[0]['id_ruangan'];
    $query_ruangan = query("SELECT * FROM ruangan WHERE id_ruangan = $id_ruangan");
    $baris_ruangan = $query_ruangan[0]['baris'];
    $column_ruangan = $query_ruangan[0]['colom'];
    $query_kursi = mysqli_query($conn, "SELECT * FROM kursi WHERE id_ruangan = $id_ruangan");
    $kursi = mysqli_fetch_all($query_kursi);
    $k = 0;
    for($i = 1; $i <= $baris_ruangan; $i++){

        for($j=1; $j <= $column_ruangan; $j++){

            $data[$i][$j]['nama_kursi'] = $kursi[$k][2];
            $data[$i][$j]['id_kursi'] = $kursi[$k][0];
            $k++;
        }
    }
    //====================================== submit di tekan =============================\\
    if(isset($_POST['_submit'])){

        $total_harga = 0;
        $panjang_kursi = count($_POST["_kursi"]);
        $id_user = $_SESSION["_id"];

        foreach($_POST["_kursi"] as $kursi){
            
            $id_kursi = $kursi;
            $kursi = query("SELECT * FROM kursi WHERE id_kursi = $id_kursi");
            $total_harga += $kursi[0]['harga'];
            mysqli_query($conn, "INSERT INTO tiket_tayang VALUES ('','$id_user','$id_tiket','$id_kursi')");

            if(mysqli_affected_rows($conn) > 0){

                mysqli_query($conn, "UPDATE `kursi` SET `status` = '1' WHERE `kursi`.`id_kursi` = $id_kursi");
            }
        }
        mysqli_query($conn, "UPDATE tiket SET `tot_harga` = $total_harga WHERE `tiket`.`id_tiket` = $id_tiket");
        if(mysqli_affected_rows($conn) > 0){

            echo "<script>alert('pemesanan berhasil');
            document.location.href = 'homeBuktiTransaksi.php?id_tiket=$id_tiket';
            </script>";

        }else{

            echo "<script>alert('pemesanan gagal, silahkan coba lagi');
            document.location.href = 'homePesan.php?id=$id_tiket';
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kursi</title>
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
    <br><br>
    
    <form action="" method="post">
    <?php for($i= 1; $i <= $baris_ruangan; $i++) : ?>
        <?php for($j=1; $j <= $column_ruangan; $j++) : ?>
            <input type="checkbox" name="_kursi[]" id="_kursi" value="<?php echo $data[$i][$j]['id_kursi'] ?>">
            <label for=""><?php echo $data[$i][$j]['nama_kursi'] ?></label>
        <?php endfor ?>
        <br>
    <?php endfor ?>
    <button  type="submit" name="_submit">Pesan</button>
    </form>
</body>
</html>