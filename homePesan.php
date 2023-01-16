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

// if(isset($_SESSION)){
//     if($_SESSION['posisi'] == "preview"){
//         $_SESSION['posisi'] = "pesan";
//     }else{
//         header("Location : homePage.php");
//         exit;
//     }
// }else{
//     header("Location : homePage.php");
//     exit;
// }

//=================================================== cek posisi ===================================\\

// if (!isset($_SESSION['posisi']) == 1)
// {
//     header("Location : homepage.php");
//     exit;
// }else{

//     ++$_SESSION['posisi'];
// }

//=================================================== memasukan data =============================\\

if (isset($_POST["_submit"])) {

    // $id_tayang = $_POST['_tayang'];
    // $query_bioskop = mysqli_query($conn, "SELECT * FROM tayang WHERE id_tayang = $id_tayang ");
    // $id_bioskop_tayang = mysqli_fetch_assoc($query_bioskop);
    // $data['id_bioskop'] = $id_bioskop_tayang['id_bioskop'];
    // $data['film'] = $id_bioskop_tayang['id_film'];
    // $data['waktu'] = $id_bioskop_tayang['hh/mm/ss'];
    // $data['ruangan'] = $id_bioskop_tayang['id_ruangan'];
    // $data['tanggal'] = $id_bioskop_tayang['dd/mm/yy'];

    // global $conn;
    $id_bioskop = "XXI";
    $waktu = $_POST["options-outline1"];
    $ruangan = "3";
    $tanggal = $_POST["options-outlined"];
    $film = $_POST['id_film'];

    $query = "INSERT INTO tiket VALUES ('','$id_bioskop','$ruangan','$film','','$tanggal','$waktu')";

    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {

        $result = query("SELECT * FROM tiket ORDER BY id_tiket DESC LIMIT 1");
        $id_tiket = $result[0]["id_tiket"];

        echo "<script>alert('Tersimpan');
                document.location.href = 'homePesanKursi.php?id_tiket=$id_tiket';
                </script>";
    } else {
        echo "<script>alert('gagal');</script>";
    }
}

if (!isset($_GET['id'])) {
    echo "<script>alert('terjadi kesalahan');
            document.location.href = 'homePage.php';
            </script>";
}

if (isset($_GET['id'])) {
    $id_film = $_GET['id'];
} else {
    header("Location: homepage.php");
    exit;
}

$film = query("SELECT * FROM film WHERE id_film = $id_film");

//========================================================== tampil =====================================\\
// $kursi = query("SELECT * FROM kursi");
// $bioskop = query("SELECT * FROM bioskop");
// $ruangan = query("SELECT * FROM ruangan");
// $tayang = query("SELECT * FROM tayang"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/react/umd/react.production.min.js" crossorigin></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/react-dom/umd/react-dom.production.min.js" crossorigin></script>

    <script src="https://cdn.jsdelivr.net/npm/react-bootstrap@next/dist/react-bootstrap.min.js" crossorigin></script>
    <title>Pesan | MUTIX</title>
</head>

<body>
    <main>
        <form action="" method="POST">
        <input type="hidden" name="id_film" id="id" value="<?php echo $film[0]['id_film'] ?>">
            <div class="img-fluid mt-5 mb-5 px-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <h2>JADWAL</h2>
                            <p>pilih jadwal yang akan kamu tonton</p>
                            <form action="" method="POST"></form>
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="ms-5">
                                            <div class="ms-5">
                                                <input type="radio" value="21dec SAT" class="btn-check" onclick="update()" name="options-outlined" id="danger-outlined" autocomplete="off">
                                                <label class="btn btn-outline-secondary mt-4 ms-4" for="danger-outlined">
                                                    <div>
                                                        <p id="jadwal">21dec</p>
                                                        <p id="jadwal1"><B>SAT</B></p>
                                                    </div>
                                                </label>

                                                <input type="radio" value="22dec SAT" class="btn-check" onclick="update1()" name="options-outlined" id="danger1-outlined" autocomplete="off">
                                                <label class="btn btn-outline-secondary mt-4 ms-4" for="danger1-outlined">
                                                    <div>
                                                        <p id="jadwal2">22dec</p>
                                                        <p id="jadwal3"><B>MIN</B></p>
                                                    </div>

                                                </label>

                                                <input type="radio" value="23dec SAT" class="btn-check" onclick="update2()" name="options-outlined" id="danger2-outlined" autocomplete="off">
                                                <label class="btn btn-outline-secondary mt-4 ms-4" for="danger2-outlined">
                                                    <div>
                                                        <p id="jadwal4">23dec</p>
                                                        <p id="jadwal5"><B>SEN</B></p>
                                                    </div>
                                                </label>
                                                <input type="radio" value="24dec SAT" class="btn-check" onclick="update3()" name="options-outlined" id="danger3-outlined" autocomplete="off">
                                                <label class="btn btn-outline-secondary mt-4 ms-4" for="danger3-outlined">
                                                    <div>
                                                        <p id="jadwal6">24dec</p>
                                                        <p id="jadwal7"><B>SEL</B></p>
                                                    </div>
                                                </label>
                                                <input type="radio" value="25dec SAT" class="btn-check" onclick="update4()" name="options-outlined" id="danger4-outlined" autocomplete="off">
                                                <label class="btn btn-outline-secondary mt-4 ms-4" for="danger4-outlined">
                                                    <div>
                                                        <p id="jadwal8">25dec</p>
                                                        <p id="jadwal9"><B>RAB</B></p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="ms-5">
                                            <div class="ms-5">
                                                <button type="button" class="btn btn-outline-secondary mt-4">
                                                    <div>
                                                        <p>25dec</p>
                                                        <p><B>KAM</B></p>
                                                    </div>
                                                </button>

                                                <button type="button" class="btn btn-outline-secondary mt-4 ms-4">
                                                    <div>
                                                        <p>26dec</p>
                                                        <p><B>JUM</B></p>
                                                    </div>
                                                </button>

                                                <button type="button" class="btn btn-outline-secondary mt-4 ms-4">
                                                    <div>
                                                        <p>27dec</p>
                                                        <p><B>SAT</B></p>
                                                    </div>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary mt-4 ms-4">
                                                    <div>
                                                        <p>28dec</p>
                                                        <p><B>MIG</B></p>
                                                    </div>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary mt-4 ms-4">
                                                    <div>
                                                        <p>29dec</p>
                                                        <p><B>SEN</B></p>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="ms-5">
                                            <div class="ms-5">
                                                <button type="button" class="btn btn-outline-secondary mt-4">
                                                    <div>
                                                        <p>30dec</p>
                                                        <p><B>SEL</B></p>
                                                    </div>
                                                </button>

                                                <button type="button" class="btn btn-outline-secondary mt-4 ms-4">
                                                    <div>
                                                        <p>31dec</p>
                                                        <p><B>RAB</B></p>
                                                    </div>
                                                </button>

                                                <button type="button" class="btn btn-outline-secondary mt-4 ms-4">
                                                    <div>
                                                        <p>1jun</p>
                                                        <p><B>KAM</B></p>
                                                    </div>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary mt-4 ms-4">
                                                    <div>
                                                        <p>2jun</p>
                                                        <p><B>SAT</B></p>
                                                    </div>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary mt-4 ms-4">
                                                    <div>
                                                        <p>3jun</p>
                                                        <p><B>MIG</B></p>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <hr class="mt-5 mb-5">
                            <div class="dropdown mb-5">
                                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-geo-alt-fill"></i> Jakarta
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                            <div class="row mb-5">
                                <div class="col-sm-6">
                                    <div class="input-group rounded">
                                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                        <span class="input-group-text border-0" id="search-addon">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-2">
                                    <div class="dropdown">
                                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Studio
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-2">
                                    <div class="dropdown">
                                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Sortir
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-2">
                                    <div class="dropdown">
                                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Bioskop
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-sm-6 col-md-8">
                                    <h2 class="mb-3" id="GICGV"><i class="bi bi-star-fill"></i> Grand Indonesia CGV</h2>
                                    <p class="mb-3">JL. MH. TAHMRIN NO.1</p>

                                </div>
                                <div class="col-sm-6 col-md-2 float-end">
                                    <button type="button" class="btn btn-warning">CGV</button>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-sm-6 col-md-8">
                                    <h2 class="mb-3" id="CGVR">REGULAR 2D</h2>

                                    <div class="row">
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="11:00" class="btn-check" onclick="updatecgvr()" name="options-outline1" id="GICGV4" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGV4">11:00</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="13:45" class="btn-check" onclick="updatecgvr()" name="options-outline1" id="GICGV5" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGV5">13:45</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="14:40" class="btn-check" onclick="updatecgvr()" name="options-outline1" id="GICGV6" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGV6">14:40</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="15:00" class="btn-check" onclick="updatecgvr()" name="options-outline1" id="GICGV7" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGV7">15:00</label>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="17:15" class="btn-check" onclick="updatecgvr()" name="options-outline1" id="GICGV8" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGV8">17:15</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="18:15" class="btn-check" onclick="updatecgvr()" name="options-outline1" id="GICGV2" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGV2">18:15</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="20:00" class="btn-check" onclick="updatecgvr()" name="options-outline1" id="GICGV1" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGV1">20:00</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="21:00" class="btn-check" onclick="updatecgvr()" name="options-outline1" id="GICGV" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGV">21:00</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-3 float-end">
                                    <p>Rp. 45.000 - 50.000</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-6 col-md-8">
                                    <h2 class="mb-3" id="CGVG">GOLD CLASS 2D</h2>

                                    <div class="row">
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="12:40" class="btn-check" onclick="updatecgvg()" name="options-outline1" id="GICGVG8" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGVG8">12:40</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="15:40" class="btn-check" onclick="updatecgvg()" name="options-outline1" id="GICGVG2" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGVG2">15:40</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="17:10" class="btn-check" onclick="updatecgvg()" name="options-outline1" id="GICGVG1" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGVG1">17:10</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="18:35" class="btn-check" onclick="updatecgvg()" name="options-outline1" id="GICGVG" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGVG">18:35</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-3 float-end">
                                    <p>Rp. 100.000</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-6 col-md-8">
                                    <h2 class="mb-3" id="CGVV">VELVET 2D</h2>

                                    <div class="row">
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="12:40" class="btn-check" onclick="updatecgvv()" name="options-outline1" id="GICGVV2" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGVV2">12:40</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="15:40" class="btn-check" onclick="updatecgvv()" name="options-outline1" id="GICGVV1" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGVV1">15:40</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="17:10" class="btn-check" onclick="updatecgvv()" name="options-outline1" id="GICGVV" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="GICGVV">17:10</label>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-3 float-end">
                                    <p>Rp. 100.000</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-6 col-md-8">
                                    <h2 class="mb-3" id="mangga3"><i class="bi bi-star-fill"></i> MANGGA DUA CINEMAPOLIS</h2>
                                    <p class="mb-3">JL. MH. TAHMRIN NO.1</p>

                                </div>
                                <div class="col-sm-6 col-md-2 float-end">
                                    <button type="button" class="btn btn-warning">Cinemapolis</button>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-sm-6 col-md-8">
                                    <h2 class="mb-3" id="mangga4">REGULAR 2D</h2>

                                    <div class="row">
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="11:00" class="btn-check" onclick="updatemangga()" name="options-outline1" id="XXI4" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="XXI4">11:00</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="13:45" class="btn-check" onclick="updatemangga()" name="options-outline1" id="XXI5" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="XXI5">13:45</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="14:40" class="btn-check" onclick="updatemangga()" name="options-outline1" id="XXI6" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="XXI6">14:40</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="15:00" class="btn-check" onclick="updatemangga()" name="options-outline1" id="XXI7" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="XXI7">15:00</label>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="17:15" class="btn-check" onclick="updatemangga()" name="options-outline1" id="XXI8" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="XXI8">
                                                <p>17:15</p>
                                            </label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="18:15" class="btn-check" onclick="updatemangga()" name="options-outline1" id="XXI2" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="XXI2">
                                                <p>18:15</p>
                                            </label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="19:15" class="btn-check" onclick="updatemangga()" name="options-outline1" id="XXI1" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="XXI1">
                                                <p>19:15</p>
                                            </label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="20:15" class="btn-check" onclick="updatemangga()" name="options-outline1" id="XXI" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="XXI">
                                                <p>20:15</p>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-3 float-end">
                                    <p>Rp. 30.000</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-6 col-md-8">
                                    <h2 class="mb-3" id="mangga"><i class="bi bi-star-fill"></i> MANGGA DUA XXI</h2>
                                    <p class="mb-3">JL. MH. TAHMRIN NO.1</p>

                                </div>
                                <div class="col-sm-6 col-md-2 float-end">
                                    <button type="button" class="btn btn-danger">XXI</button>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-sm-6 col-md-8">
                                    <h2 class="mb-3" id="mangga2">REGULAR 2D</h2>

                                    <div class="row">
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="11:00" class="btn-check" onclick="updatemangga2()" name="options-outline1" id="jadwalmangga4" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="jadwalmangga4">11:00</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="13:45" class="btn-check" onclick="updatemangga2()" name="options-outline1" id="jadwalmangga5" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="jadwalmangga5">13:45</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="14:40" class="btn-check" onclick="updatemangga2()" name="options-outline1" id="jadwalmangga6" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="jadwalmangga6">14:40</label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="15:00" class="btn-check" onclick="updatemangga2()" name="options-outline1" id="jadwalmangga7" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="jadwalmangga7">15:00</label>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="17:15" class="btn-check" onclick="updatemangga2()" name="options-outline1" id="jadwalmangga8" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="jadwalmangga8">
                                                <p>17:15</p>
                                            </label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="18:15" class="btn-check" onclick="updatemangga2()" name="options-outline1" id="jadwalmangga2" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="jadwalmangga2">
                                                <p>18:15</p>
                                            </label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="19:15" class="btn-check" onclick="updatemangga2()" name="options-outline1" id="jadwalmangga1" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="jadwalmangga1">
                                                <p>19:15</p>
                                            </label>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="radio" value="20:15" class="btn-check" onclick="updatemangga2()" name="options-outline1" id="jadwalmangga" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="jadwalmangga">
                                                <p>20:15</p>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-3 float-end">
                                    <p>Rp. 30.000</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 mt-8 ">
                        <div class="ms-5">
                            <img src="image\<?php echo $film[0]["gambar"] ?>" alt="error" style="height: 500px; width: 400px;">
                            <h2 class="mt-5"><?php echo $film[0]["judul_film"] ?></h2>
                            <div class="row">
                                <!-- <div class="col-sm-4 mt-5">
                                    <p class=""> Genres</p>
                                    <p class=""> Durasi</p>
                                    <p class=""> Sutradara</p>
                                    <p class=""> Rating Usia</p>
                                </div>


                                <div class="col-sm-6 mt-5">
                                    <p class="">Action</p>
                                    <p class="">1 jam. 37 menit.</p>
                                    <p class="">Niwa Masami</p>
                                    <p class="">PG-13</p>
                                </div> -->
                            </div>
                            <div class="card border-dark mt-5">
                                <div class="card-body">
                                    <h2 id="bioskop">Grand Indonesia CGV</h2>
                                    <p class="mt-3" id="demo">Kamis, 23 Desember 2022</p>
                                    <h2 class="mt-3" id="type">Regular 2D</h2>
                                    <p class="mt-3">*pemilihan kursi dapat dilakukan setelah ini</p>
                                    <div class="d-grid gap-2">

                                        <button type="submit" name="_submit" class="btn btn-outline-primary m-4">Beli Sekarang</button>
                                        <!-- <a name="" id="" class="btn btn-outline-primary m-4" href="homePesanKursi.php" role="button">Beli Sekarang</a> -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </main>
    <section class="text-center">
        <!-- Background image -->
        <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>

        <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
            <div class="card-body py-5 px-md-5">

                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-5">Kamu akan memesan</h2>
                        <div class="container-sm">

                            <h1 class="fw-bold mb-5"><?php echo $film[0]['judul_film'] ?></h1>
                            <br>
                            <img src="image/<?php echo $film[0]['gambar'] ?>" alt="error" width="250">
                            <h2 class="fw-bold mb-5">Deskripsi</h2>
                            <h4><?php echo $film[0]['deskripsi'] ?></h4>

                            <br><br>

                            <label for="_tanggal">Tanggal tayang</label>
                            <br><br>
                            <table cellpadding="5" cellspacing="0">
                                <tr>
                                    <?php foreach ($tayang as $tay) : ?>
                                        <td>
                                            <a href="?_tayang=<?php echo $tay['id_tayang'] ?>&id=<?php echo $id_film ?>">
                                                <p><?php echo date('d F Y', strtotime($tay['dd/mm/yy'])) ?> </p>
                                            </a>
                                        </td>
                                    <?php endforeach ?>
                                </tr>
                            </table>
                            <br>

                            <form action="" method="POST">
                                <table>
                                    <?php $id_film = $_GET['id'] ?>
                                    <input type="hidden" name="id" id="id" value="<?php echo $id_film ?>">
                                    <?php foreach ($bioskop as $bios) : ?>
                                        <tr>
                                            <td>
                                                <h1 class="fw-bold mb-5"><?php echo $bios['nama_bioskop'] ?></h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php $id_bioskop = $bios['id_bioskop'] ?>
                                                <?php $tanggal = query("SELECT * FROM tayang WHERE id_bioskop = $id_bioskop") ?>
                                                <?php foreach ($tanggal as $tay) : ?>
                                                    <input type="radio" name="_tayang" id="_tayang" value="<?php echo $tay['id_tayang'] ?>" require> <label for="_tayang"><?php echo date('h:i', strtotime($tay['hh/mm/ss'])) ?></label>
                                                    <br>
                                                <?php endforeach ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </table>
                                <button type="submit" name="_submit">Pesan</button>
                            </form>
</body>
<script>
    function update() {
        var x = document.getElementById("jadwal").textContent;
        var y = document.getElementById("jadwal1").textContent;
        document.getElementById("demo").innerHTML = y + ", " + x + " 2023";
    }

    function update1() {
        var x = document.getElementById("jadwal2").textContent;
        var y = document.getElementById("jadwal3").textContent;
        document.getElementById("demo").innerHTML = y + ", " + x + " 2023";
    }

    function update2() {
        var x = document.getElementById("jadwal4").textContent;
        var y = document.getElementById("jadwal5").textContent;
        document.getElementById("demo").innerHTML = y + ", " + x + " 2023";
    }

    function update3() {
        var x = document.getElementById("jadwal6").textContent;
        var y = document.getElementById("jadwal7").textContent;
        document.getElementById("demo").innerHTML = y + ", " + x + " 2023";
    }

    function update4() {
        var x = document.getElementById("jadwal8").textContent;
        var y = document.getElementById("jadwal9").textContent;
        document.getElementById("demo").innerHTML = y + ", " + x + " 2023";
    }

    function updatemangga2() {
        var x = document.getElementById("mangga").textContent;
        var y = document.getElementById("mangga2").textContent;
        document.getElementById("bioskop").innerHTML = x;
        document.getElementById("type").innerHTML = y;
    }

    function updatemangga() {
        var x = document.getElementById("mangga3").textContent;
        var y = document.getElementById("mangga4").textContent;
        document.getElementById("bioskop").innerHTML = x;
        document.getElementById("type").innerHTML = y;
    }

    function updatecgvr() {
        var x = document.getElementById("CGVR").textContent;
        var y = document.getElementById("GICGV").textContent;
        document.getElementById("bioskop").innerHTML = y;
        document.getElementById("type").innerHTML = x;
    }

    function updatecgvg() {
        var x = document.getElementById("CGVG").textContent;
        var y = document.getElementById("GICGV").textContent;
        document.getElementById("bioskop").innerHTML = y;
        document.getElementById("type").innerHTML = x;
    }

    function updatecgvv() {
        var x = document.getElementById("CGVV").textContent;
        var y = document.getElementById("GICGV").textContent;
        document.getElementById("bioskop").innerHTML = y;
        document.getElementById("type").innerHTML = x;
    }
</script>

</html>