<?php
require "nav.php";
//========================================================== Login =============================================\\


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



//========================================================== tiket =============================================\\

// $query_film = query("SELECT * FROM film");
// $query_genre = query("SELECT * FROM genre");

$query_genre = query("SELECT * FROM genre");
//id_film, id_genre, gambar_film

// $banyak_genre = 0;

// foreach ($query_genre as $genre){

//     $banyak_film = 0;
//     $id_genre = $genre['id_genre'];
//     $query_genre_film = query("SELECT * FROM genre_film WHERE id_genre = $id_genre");

//     foreach($query_genre_film as $genre_film){

//         $id_film = $genre_film['id_film'];
//         $query_film_id = mysqli_query($conn, "SELECT * FROM film WHERE id_film = $id_film");
//         $row_film = mysqli_fetch_assoc($query_film_id);

//         if(mysqli_num_rows($query_film_id) == 1){

//             $gambar_film = $row_film['gambar'];
//             $judul_film = $row_film['judul_film'];
//             $data_film[$banyak_genre][$banyak_film] = ['id_genre' => $id_genre, 'id_film' => $genre_film['id_film'] , 'judul_film' => $judul_film ,'gambar' => $gambar_film];
//         }
//         //$data_film[$banyak_genre][$banyak_film] = ['id_genre' => '', 'id_film' => '' , 'judul_film' => '','gambar' => ''];
//         $banyak_film++;

//     }
//     $banyak_genre++;
// }
// echo $banyak_film;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <style>
        .carousel-inner>.item>img {
            width: 20px;
            height: 360px;
        }
    </style>
    <title>Homepage</title>
</head>

<body>
    <main>
        <div class="img-fluid mt-5 mb-5 px-5">
            <div id="carouselExampleControls1" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-around">
                            <div class="col-4">
                                <img src="image-2.jpg" class="d-block w-100" alt="image\image-2.jpg" style="height: 650px">
                                <div class="row">
                                <div class="d-grid gap-2">
                                    <a name="" id="" class="btn btn-outline-primary m-4" href="homePesan.php?id=21" role="button">Beli Sekarang</a>
                                </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <img src="image-3.jpg" class="d-block w-100" alt="image\image-2.jpg" style="height: 650px">
                                <div class="row">
                                <div class="d-grid gap-2">
                                    <a name="" id="" class="btn btn-outline-primary m-4" href="homePesan.php?id=22" role="button">Beli Sekarang</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-around">
                            <div class="col-4">
                                <img src="MV5BOTEyNDJhMDAtY2U5ZS00OTMzLTkwODktMjU3MjFkZWVlMGYyXkEyXkFqcGdeQXVyMjkwOTAyMDU@._V1_.jpg" class="d-block w-100" alt="\image\image-2.jpg" style="height: 650px">
                                <div class="row">
                                <div class="d-grid gap-2">
                                    <a name="" id="" class="btn btn-outline-primary m-4" href="homePesan.php?id=23" role="button">Beli Sekarang</a>
                                </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <img src="MV5BMDdmZGU3NDQtY2E5My00ZTliLWIzOTUtMTY4ZGI1YjdiNjk3XkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_.jpg" class="d-block w-100" alt="C:\xampp\htdocs\Mutix\image\image-2.jpg" style="height: 650px">
                                <div class="row">
                                <div class="d-grid gap-2">
                                    <a name="" id="" class="btn btn-outline-primary m-4" href="homePesan.php?id=24" role="button">Beli Sekarang</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls1" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls1" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="img-fluid mb-5  px-5">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="image-2.jpg" class="d-block w-100" alt="C:\xampp\htdocs\Mutix\image\image-2.jpg" style="height: 200px">
                    </div>
                    <div class="carousel-item">
                        <img src="image-3.jpg" class="d-block w-100" alt="C:\xampp\htdocs\Mutix\image\image-2.jpg" style="height: 200px">
                    </div>
                    <div class="carousel-item">
                        <img src="image-1.jpg" class="d-block w-100" alt="C:\xampp\htdocs\Mutix\image\image-2.jpg" style="height: 200px">
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
        </div>
        
        <div class="px-5">
            <p style="font-size: 20px;"> <b> Akan Datang</b></p>
            <div class="row justify-content-between">
                <div class="col-4">
                <p class="pt-2">Tunggu kehadirannya di bioskop kesayangan kamu!</p>
                </div>
                <div class="col-4" >
                <a href="" class="pt-2" style="font-size: 20px; color: #105f84; margin-left: 320px;"><b>Lihat semua</b></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <img src="image\image-4.jpg" class="d-block w-100" alt="C:\xampp\htdocs\Mutix\image\image-2.jpg" style="height: 550px; width: 100px;">
                                <div class="row">
                                <div class="d-grid gap-2">
                                    <a name="" id="" class="btn btn-outline-primary m-4" href="homePesan.php?id=25" role="button">Beli Sekarang</a>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <img src="MV5BOTEyNDJhMDAtY2U5ZS00OTMzLTkwODktMjU3MjFkZWVlMGYyXkEyXkFqcGdeQXVyMjkwOTAyMDU@._V1_.jpg" class="d-block w-100" alt="C:\xampp\htdocs\Mutix\image\image-2.jpg" style="height: 550px; width: 100px;">
                                <div class="row">
                                <div class="d-grid gap-2">
                                    <a name="" id="" class="btn btn-outline-primary m-4" href="homePesan.php?id=23" role="button">Beli Sekarang</a>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <img src="MV5BMDdmZGU3NDQtY2E5My00ZTliLWIzOTUtMTY4ZGI1YjdiNjk3XkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_.jpg" class="d-block w-100" alt="C:\xampp\htdocs\Mutix\image\image-2.jpg" style="height: 550px; width: 100px;">
                                <div class="row">
                                <div class="d-grid gap-2">
                                    <a name="" id="" class="btn btn-outline-primary m-4" href="homePesan.php?id=24" role="button">Beli Sekarang</a>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="img-fluid mb-5  px-5">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="Poster.png" class="d-block w-100" alt="C:\xampp\htdocs\Mutix\image\image-2.jpg" style="height: 200px">
                    </div>
                    <div class="carousel-item">
                        <img src="image-3.jpg" class="d-block w-100" alt="C:\xampp\htdocs\Mutix\image\image-2.jpg" style="height: 200px">
                    </div>
                    <div class="carousel-item">
                        <img src="image-1.jpg" class="d-block w-100" alt="C:\xampp\htdocs\Mutix\image\image-2.jpg" style="height: 200px">
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
        </div>
    </main>

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
                    <div class="container-sm">

                        <table>
                            <?php foreach ($query_genre as $genre) : ?>
                                <tr>
                                    <td>
                                        <h1 class="fw-bold mb-5"><?php echo $genre['nama_genre'] ?></h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php $genre = $genre['id_genre'] ?>
                                        <?php $query_film = query("SELECT * FROM film WHERE genre = $genre") ?>
                                        <?php foreach ($query_film as $film) : ?>
                                            <a href="homePreview.php?id=<?php echo $film['id_film'] ?>">
                                                <img src="image/<?php echo $film['gambar'] ?>" alt="error" height="100">
                                                <h2><?php echo $film['judul_film'] ?></h2>
                                            </a>
                                        <?php endforeach ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                        </section>

</body>

</html>