<?php 
    require "Qcrud.php";
    session_start();

    if(!isset($_SESSION['_login']))
    {
        header("Location : homeAdminTable.php");
        exit;
    }

    $aut = $_SESSION['_aut'];
    $id = $_SESSION['_id'];

    if($aut == "admin"){
        $data_ubah = query("SELECT * FROM admin WHERE id_admin = '$id'");
    }else if($aut == "staff")
    {
        $data_ubah = query("SELECT * FROM staff WHERE id_staff = '$id'");
    }else if($aut == "user") 
    {
        $data_ubah = query("SELECT * FROM user WHERE id_user = '$id'");
    }

    if(isset($_POST["_submit"]))
    {

        if (ubah_profile($_POST, 'admin')) 
        {
            echo "<script> alert('user baru berhasil di tambahkan');
            document.location.href = 'homeProfile.php';
            </script>";
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
    <title>Update admin</title>
</head>
<body>
    <h1>Update Admin</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- data yang nggk perlu di tampilkan -->
        <input type="hidden" name="_id" id="_id" value="<?php echo $data_ubah[0]["id_admin"] ?>">
        <input type="hidden" name="_gambarLama" id="_gambarLama" value="<?php echo $data_ubah[0]["gambar"] ?>">

        <label for="_gambar">gambar</label>
        <br>
        <img src="image/<?php echo $data_ubah[0]["gambar"] ?>" alt="error" width="100">
        <br>
        <input type="file" name="_gambar" id="_gambar">
        <br>
        <label for="_username">username</label>
        <input type="text" name="_username" id="_username" value="<?php echo $data_ubah[0]['nama'] ?>">
        <br>
        <label for="_password">password</label>
        <input type="password" name="_password" id="_password" value="<?php echo $data_ubah[0]['password_admin'] ?>">
        <br>
        <button type="submit" name="_submit">Registrasi</button>
    </form>
</body>
</html>