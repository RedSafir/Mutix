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
    <title>Homepage</title>
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
    
    <table>
        <?php foreach($query_genre as $genre) : ?>
        <tr>
            <td>
                <h1><?php echo $genre['nama_genre'] ?></h1>
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

</body> 
</html>