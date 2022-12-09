<?php 
    require "Qcrud.php";

    if(isset($_POST["_submit"]))
    {
        if (daftar_user_mutix($_POST) > 0) 
        {
            echo "<script> alert('user baru berhasil di tambahkan');
            document.location.href = 'formLogin.php';</script>";
        }else
        {
            echo  "<script> alert('user baru gagal di tambahkan');</script>";
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi User</title>
</head>
<body>
    <h1>Registrasi User</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="_gambar">gambar</label>
        <input type="file" name="_gambar" id="_gambar">
        <br>
        <label for="_username">username</label>
        <input type="text" name="_username" id="_username">
        <br>
        <label for="_umur">Umur</label>
        <input type="text" name="_umur" id="_umur">
        <br>
        <label for="_password">password</label>
        <input type="password" name="_password" id="_password">
        <br>
        <label for="_confirmPassword">conf password</label>
        <input type="password" name="_confirmPassword" id="_confirmPassword">
        <br>
        <button type="submit" name="_submit">Registrasi</button>
    </form>
</body>
</html>