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

    if(isset($_POST["_submit"])){
        if(isset($_GET['_tayang'])){
            $id_tayang = $_POST['_tayang'];
            $query_bioskop = mysqli_query($conn,"SELECT * FROM tayang WHERE id_tayang = $id_tayang ");  
            $id_bioskop_tayang = mysqli_fetch_assoc($query_bioskop);
            $data['id_bioskop'] = $id_bioskop_tayang['id_bioskop'];
            $data['film'] = $id_bioskop_tayang['id_film'];
            $data['waktu'] = $id_bioskop_tayang['hh/mm/ss'];
            $data['ruangan'] = $id_bioskop_tayang['id_ruangan'];
            $data['tanggal'] = $id_bioskop_tayang['dd/mm/yy'];

            global $conn;

            $id_bioskop = $data['id_bioskop'];
            $waktu = $data['waktu'];
            $ruangan = $data['ruangan'];
            $tanggal = $data['tanggal'];
            $film = $data['film'];

            $query = "INSERT INTO tiket VALUES ('','$id_bioskop','$ruangan','$film','','$tanggal','$waktu')";
            
            mysqli_query($conn,$query);

            if( mysqli_affected_rows($conn) > 0){
                
                $result = query("SELECT * FROM tiket ORDER BY id_tiket DESC LIMIT 1");
                $id_tiket = $result[0]["id_tiket"];

                echo "<script>alert('Tersimpan');
                document.location.href = 'homePesanKursi.php?id_tiket=$id_tiket';
                </script>";

            }else{
                echo "<script>alert('gagal');</script>";
            }
        }else{
            echo "<script>alert('silahkan pilih waktu');</script>";
        }
    }

    if(!isset($_GET['id'])){
        echo "<script>alert('terjadi kesalahan');
            document.location.href = 'homePage.php';
            </script>";
    }
    
    if(isset($_GET['id'])){
        $id_film = $_GET['id'];
    }else{
        header("Location: homepage.php");
        exit;
    }

    $film = query("SELECT * FROM film WHERE id_film = $id_film");

    //========================================================== tampil =====================================\\
    $kursi = query("SELECT * FROM kursi");
    $bioskop = query("SELECT * FROM bioskop");
    $ruangan = query("SELECT * FROM ruangan");
    $tayang = query("SELECT * FROM tayang");   

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
    <title>Pesan | MUTIX</title>
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
        <a class="nav-link" href="hometiketUser.php">Tiket Saya</a>
        <a class="nav-link" href="javascript:history.go(-1)">Kembali</a>
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
            <?php endif; ?>
    </div>
  </div>
</nav>
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
            <?php foreach($tayang as $tay) : ?>
                <td>
                    <a href="?_tayang=<?php echo $tay['id_tayang'] ?>&id=<?php echo $id_film ?>">
                        <p><?php echo date('d F Y',strtotime($tay['dd/mm/yy'])) ?> </p>
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
            <?php foreach($bioskop as $bios) : ?>
            <tr>
                <td>
                    <h1 class="fw-bold mb-5"><?php echo $bios['nama_bioskop'] ?></h1>
                </td>
            </tr>
            <tr>
                <td>
                    <?php $id_bioskop = $bios['id_bioskop'] ?>
                    <?php $tanggal = query("SELECT * FROM tayang WHERE id_bioskop = $id_bioskop") ?>
                    <?php foreach($tanggal as $tay) : ?>
                        <input type="radio" name="_tayang" id="_tayang" value="<?php echo $tay['id_tayang'] ?>" require> <label for="_tayang"><?php echo date('h:i',strtotime($tay['hh/mm/ss'])) ?></label>
                        <br>
                    <?php endforeach ?>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    <button type="submit" name="_submit">Pesan</button>
    </form>
</body>
</html>