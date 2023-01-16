<?php
require "nav.php";

//======================================================= cek profile ============================================\\
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
//=========================================================== ambil data =============================================\\
if (isset($login)) {
    $aut = $_SESSION['_aut'];
    $id = $_SESSION['_id'];

    if ($aut == 'user') {
        $query_tiket = query("SELECT * FROM tiket_tayang INNER JOIN user ON tiket_tayang.id_user = user.id_user INNER JOIN tiket ON tiket_tayang.id_tiket=tiket.id_tiket INNER JOIN film ON tiket.id_film=film.id_film WHERE User.id_user=$id");
    } else if ($aut == 'staff') {
        $query_tiket = query("SELECT * FROM tiket_tayang INNER JOIN staff ON tiket_tayang.id_staff = staff.id_staff INNER JOIN tiket ON tiket_tayang.id_tiket=tiket.id_tiket INNER JOIN film ON tiket.id_film=film.id_film WHERE staff.id_staff=$id");
    } else if ($aut == 'admin') {
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
    <div class="img-fluid mt-5 mb-5 px-5">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="mt-3"> Ticket Saya </h2>
                <p class="mt-3">Daftar tiket dan transaksi yang pernah anda lakukan</p>
                <?php if (!$login) :  ?>
                    <h1>Tidak ada transaksi</h1>
                <?php else : ?>
                    <?php foreach ($query_tiket as $tiket) : ?>
                        <div class="row">
                            <img src="image-2.jpg" alt="" class="d-block w-25" alt="C:\xampp\htdocs\Mutix\image\image-2.jpg" style="height: 300px; width: 500px;">
                            <div class="col">
                                <h2><?php echo $tiket['judul_film'] ?></h2>
                                <h3><?php echo $tiket['tot_harga'] ?></h3>
                                <a class="mt-5" href="homeBuktiTransaksi.php?id_tiket=<?php echo $tiket['id_tiket'] ?>">cari tau!</a>







                                
                            </div>
                            
                        </div>
                        <hr class="mt-5 mb-5">
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>
    <br><br>


</body>

</html>