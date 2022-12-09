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
    <title>HomePesan</title>
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
        
    <h1><?php echo $film[0]['judul_film'] ?></h1>
    <br>
    <img src="image/<?php echo $film[0]['gambar'] ?>" alt="error" width="250">
    <h2>Deskripsi</h2>
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
                    <h1><?php echo $bios['nama_bioskop'] ?></h1>
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