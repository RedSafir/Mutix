<?php
require "Qcrud.php";
session_start();

if (!isset($_SESSION['_login'])) {
    header("Location : homeAdminTable.php");
    exit;
}

$aut = $_SESSION['_aut'];
$id = $_SESSION['_id'];

if ($aut == "admin") {
    $data_ubah = query("SELECT * FROM admin WHERE id_admin = '$id'");
} else if ($aut == "staff") {
    $data_ubah = query("SELECT * FROM staff WHERE id_staff = '$id'");
} else if ($aut == "user") {
    $data_ubah = query("SELECT * FROM user WHERE id_user = '$id'");
}

if (isset($_POST["_submit"])) {



    if (ubah_profile($_POST, 'user')) {
        echo "<script> alert('data berhasil di perbaharui');
            document.location.href = 'homeProfile.php';
            </script>";
    } else {
        echo  "<script> alert('data gagal di perbaharui');</script>";
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
    <title>Update User</title>
</head>

<body>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_id" id="_id" value="<?php echo $data_ubah[0]["id_user"] ?>">
        <input type="hidden" name="_gambarLama" id="_gambarLama" value="<?php echo $data_ubah[0]["gambar"] ?>">

        <label for="_gambar"></label>
        <div class="container  mt-5">
            <div class="row justify-content-center">
                <div class="col-4">
                    <img src="image/<?php echo $data_ubah[0]["gambar"] ?>" alt="error" width="300" style="border-radius: 50%;">
                    <input type="file" name="_gambar" id="_gambar" class="mt-5">
                </div>
                <div class="col-4 me-5">
                    <div class="mb-3">
                    <label for="_username">username</label>
                    </div>
                    <input type="text" name="_username" id="_username" value="<?php echo $data_ubah[0]['nama'] ?>">
                    <div class="mb-3 mt-3">
                    <label for="_umur">umur</label>
                    </div>
                    <input type="text" name="_umur" id="_umur" value="<?php echo $data_ubah[0]['umur_user'] ?>">
                    <div class="mb-3">
                    <label for="_password">password</label>
</div>
                    <input type="password" name="_password" id="_password" value="<?php echo $data_ubah[0]['password_user'] ?>">
                    <div class="mt-3">
                    <button type="submit" name="_submit">Update</button>
</div>
                    
                </div>
            </div>
        </div>
        <!-- data yang nggk perlu di tampilkan -->

      
    </form>
</body>

</html>