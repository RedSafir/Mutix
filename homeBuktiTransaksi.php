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
//============================================================= masukan data =====================================\\
if (!isset($_GET['id_tiket'])) {
    echo "<script>alert('terjadi kesalahan');
            document.location.href = 'homePage.php';
            </script>";
}
$id_tiket = $_GET['id_tiket'];
$query_tiket = query("SELECT * FROM tiket WHERE id_tiket = $id_tiket");
$query_tayang_tiket = query("SELECT * FROM tiket_tayang WHERE id_tiket = $id_tiket ");

$id_ruangan = 5;
$id_bioskop = 3;

$id_user = $query_tayang_tiket[0]['id_user'];

for ($i = 0; $i <= count($query_tayang_tiket) - 1; $i++) {
    $id_kursi[$i] = $query_tayang_tiket[$i]['id_kursi'];
}

if ($aut == 'user') {
    $query_user = query("SELECT * FROM user WHERE id_user = $id_user");
} else if ($aut == 'staff') {
    $query_user = query("SELECT * FROM staff WHERE id_staff = $id_user");
} else if ($aut == 'admin') {
    $query_user = query("SELECT * FROM admin WHERE id_admin = $id_user");
}

$query_user = query("SELECT * FROM user WHERE id_user = $id_user");

$query_ruangan = query("SELECT * FROM ruangan WHERE id_ruangan = $id_ruangan");

$query_bioskop = query("SELECT * FROM bioskop WHERE id_bioskop = $id_bioskop");

$nama_user = $query_user[0]['nama'];

$nama_bioskop = $query_bioskop[0]['nama_bioskop'];


$alamat_bioskop = $query_bioskop[0]['kota'] . ' ' . $query_bioskop[0]['alamat'];
$nama_ruangan = $query_ruangan[0]['nama_ruangan'];
$harga_tot = $query_tiket[0]['tot_harga'];
$nama_kursi = '';
foreach ($id_kursi as $kursi) {
    $i = 0;
    $query_kursi = query("SELECT * FROM kursi WHERE id_kursi = $kursi");
    $nama_kursi = $nama_kursi . ' / ' . $query_kursi[$i]['nama_kursi'] . ' / ';
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
    <div class="container text-center">
        <div class="row align-items-start">
            <div class="col">

            </div>
            <div class="col">
                <h1 class="mt-5">Bukti Transaksi</h1>
                <div class="card" style="background-color:#1a2c50; border-color:darkblue;">
                    <img class="card-img-top" src="" alt="">
                    <div class="card-body">
                        <div class="row">
                        <div class="col me-5">
                            <h2 style="color: #9DA8BE;">Nama</h2>
                            <p style="color: white;"><?php echo $nama_user ?></p>

                            <h2 style="color: #9DA8BE;">Bioskop</h2>
                            <p style="color: white;"><?php echo $nama_bioskop ?></p>

                            <h2 style="color: #9DA8BE;">Alamat Bioskop</h2>
                            <p style="color: white;"><?php echo $alamat_bioskop ?></p>

                        </div>
                        <div class="col ms-5">
                        <h2 style="color: #9DA8BE;">Ruangan</h2>
                        <p style="color: white;"><?php echo $nama_ruangan ?></p>

                        <h2 style="color: #9DA8BE;">Kursi</h2>
                        <p style="color: white;"><?php echo $nama_kursi ?></p>

                        <h2 style="color: #9DA8BE;">Total harga</h2>
                        <p style="color: white;"><?php echo $harga_tot ?></p>
                        </div>
                        </div>
                        
                    </div>
                </div>





                <a href="homePage.php">Kembali</a>
            </div>
            <div class="col">

            </div>
        </div>
    </div>
    <br><br>




</body>

</html>