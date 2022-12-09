<?php 
    require "Qcrud.php";

    if(isset($_POST["_submit"])){
        if(daftar_bioskop($_POST) >= 1){
            echo "berhasil di tambahkan";
        }else{
            echo "terjadi kesalahan";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bioskop</title>
</head>
<body>
    <h1>Daftar Bioskop</h1>
    <form action="" method="POST">
        <label for="_nama">Nama bioskop</label>
        <input type="text" name="_nama" id="_nama">
        <br><br>
        <label for="_banyak_ruangan">Banyak_ruangan</label>
        <input type="text" name="_banyak_ruangan" id="_banyak_ruangan">
        <br><br>
        <label for="_kota">Kota</label>
        <input type="text" name="_kota" id="_kota">
        <br><br>
        <label for="_alamat">Alamat</label>
        <br>
        <textarea name="_alamat" id="_alamat" cols="30" rows="10"></textarea>
        <br>
        <button type="submit" name="_submit">Submit</button>
    </form>
</body>
</html>