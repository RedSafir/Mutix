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

//===================================== masukan nilai ================================\\

/* if(!isset($_GET['id_tiket'])){
        echo "<script>alert('terjadi kesalahan');
            document.location.href = 'homePage.php';
            </script>";
    } */

$id_tiket = $_GET['id_tiket'];

$query_tiket = query("SELECT * FROM tiket WHERE id_tiket = $id_tiket");

// $id_ruangan = $query_tiket[0]['id_ruangan'];

$query_ruangan = query("SELECT * FROM ruangan WHERE id_ruangan = 5");
$baris_ruangan = $query_ruangan[0]['baris'];
$column_ruangan = $query_ruangan[0]['colom'];
$query_kursi = mysqli_query($conn, "SELECT * FROM kursi  WHERE id_ruangan = 5");
$kursi = mysqli_fetch_all($query_kursi);
$k = 0;
for ($i = 1; $i <= $baris_ruangan; $i++) {

    for ($j = 1; $j <= $column_ruangan; $j++) {

        $data[$i][$j]['nama_kursi'] = $kursi[$k][2];
        $data[$i][$j]['id_kursi'] = $kursi[$k][0];
        $k++;
    }
}
//====================================== submit di tekan =============================\\
if (isset($_POST['_submit'])) {

    $total_harga = 0;
    $panjang_kursi = count($_POST["_kursi"]);
    $id_user = $_SESSION["_id"];

    foreach ($_POST["_kursi"] as $kursi) {

        $id_kursi = $kursi;
        $kursi = query("SELECT * FROM kursi WHERE id_kursi = $id_kursi");
        $total_harga += $kursi[0]['harga'];
        mysqli_query($conn, "INSERT INTO tiket_tayang VALUES ('','$id_user','$id_tiket','$id_kursi')");

        if (mysqli_affected_rows($conn) > 0) {

            mysqli_query($conn, "UPDATE `kursi` SET `status` = '1' WHERE `kursi`.`id_kursi` = $id_kursi");
        }
    }
    mysqli_query($conn, "UPDATE tiket SET `tot_harga` = $total_harga WHERE `tiket`.`id_tiket` = $id_tiket");
    if (mysqli_affected_rows($conn) > 0) {

        echo "<script>alert('pemesanan berhasil');
            document.location.href = 'homeBuktiTransaksi.php?id_tiket=$id_tiket';
            </script>";
    } else {

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
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Pesan Kursi</title>
</head>

<body>

    <form action="" method="post">
        <div class="m-5">
            <?php for ($i = 1; $i <= $baris_ruangan; $i++) : ?>
                <div class="row">
                    <?php for ($j = 1; $j <= $column_ruangan; $j++) : ?>
                        <div class="btn  btn-outline-secondary col">

                            <input type="checkbox" name="_kursi[]" id="_kursi" value="<?php echo $data[$i][$j]['id_kursi'] ?>">
                            <label for=""><?php echo $data[$i][$j]['nama_kursi'] ?></label>
                        </div>
                    <?php endfor
                    ?>
                    
                </div>
                
            <?php endfor ?>
            <div class="d-grid gap-1 mt-5">
                <button class="btn btn-primary disabled" type="button">Layar Bioskop Disini</button>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn btn-primary btn-lg mt-5 " name="_submit">Konfrimasi</button>
            </div>
        </div>
    </form>
</body>

</html>