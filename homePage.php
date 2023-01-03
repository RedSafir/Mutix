<?php 
    //========================================================== Login =============================================\\
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



     //========================================================== tiket =============================================\\
    
    // $query_film = query("SELECT * FROM film");
    // $query_genre = query("SELECT * FROM genre");
    
    $query_genre= query("SELECT * FROM genre");
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
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Homepage</title>
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
        <a class="nav-link active" aria-current="page" href="homePage.php">Home</a>
        <a class="nav-link" href="hometiketUser.php">Tiket Saya</a>
        <a class="nav-link" href="javascript:history.go(-1)">Kembali</a>
        <a class="navbar-brand" href="homeProfile.php">
        <?php if(!$login) : ?>
            <a href="formLogin.php" class="nav-link">Login</a>
                <img src="image/NoUser.png" alt="error" width="30" height="24" class="d-inline-block align-text-top" >
            </a>
        <?php else : ?>
            <a href="QLogOut.php" class="nav-link">LogOut</a>
            <a href="">
            <img src="image/<?php echo $profile[0]['gambar'] ?>" alt="error" width="30" height="24" class="d-inline-block align-text-top">
            </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
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
        <?php foreach($query_genre as $genre) : ?>
        <tr>
            <td>
                <h1 class="fw-bold mb-5"><?php echo $genre['nama_genre'] ?></h1>
            </td>
        </tr>
        <tr>
            <td>
                <?php $genre = $genre['id_genre'] ?>
                <?php $query_film = query("SELECT * FROM film WHERE genre = $genre") ?>
                <?php foreach($query_film as $film) : ?>
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