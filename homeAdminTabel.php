<?php 
    session_start();

    // if(!isset($_POST["_submit"]))
    // {
    //     header("Location: index.php");
    //     exit;
    // }
    //menghubungkan dengan file php yang lain
    require "Qkoneksi.php";

    //panggil functionya dari koneksi.php 
    //digunakan untuk mengubah databases menjadi array
    $admins = query("SELECT * FROM admin");
    $staffs = query("SELECT * FROM staff");
    $users = query("SELECT * FROM user");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Admin</title>
</head>
<body>
    <h1>Daftar Admin</h1>
        <a href="formRegAdmin.php">tambah</a>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>ACTION</th>
                <th>GAMBAR</th>
                <th>NAMA ADMIN</th>
                <th>PASSWORD</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach($admins as $admin) : ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <a href="formUpAdmin.php">Ubah</a>| 
                    <a href="Qhapus.php?_id=<?php echo $admin['id_admin'] ?>&_aut=admin">hapus</a>
                </td>
                <td><img src="image/<?php echo $admin["gambar"] ?>" alt="error" width="50"></td>
                <td><?php echo $admin["nama"] ?></td>
                <td><?php echo $admin["password_admin"] ?></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach ?>
        </table>

    <br><br>

    <h1>Daftar Staff</h1>
        <a href="formRegStaff.php">tambah</a>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>ACTION</th>
                <th>GAMBAR</th>
                <th>NAMA STAFF</th>
                <th>PASSWORD</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach($staffs as $staff) : ?>
            <tr>
                <td><?php echo $i ?></td>
                <td>
                    <a href="">Ubah</a>| 
                    <a href="Qhapus.php?_id=<?php echo $staff['id_staff'] ?>&_aut=staff">hapus</a>
                </td>
                <td><img src="image/<?php echo $staff["gambar"] ?>" alt="error" width="50"></td>
                <td><?php echo $staff["nama"] ?></td>
                <td><?php echo $staff["password_staff"] ?></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach ?>
        </table>

    <br><br>

    <h1>Daftar User</h1>
        <a href="formRegUser.php">tambah</a>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>ACTION</th>
                <th>GAMBAR</th>
                <th>NAMA USER</th>
                <th>PASSWORD</th>
                <th>UMUR</th>
                <th>REKENING</th>
            </tr>
            <?php $i = 1 ?>
            <?php foreach($users as $user) : ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <a href="">Ubah</a>| 
                    <a href="Qhapus.php?_id=<?php echo $user['id_user'] ?>&_aut=user">hapus</a>
                </td>
                <td><img src="image/<?php echo $user["gambar"] ?>" alt="error" width="50"></td>
                <td><?php echo $user["nama"] ?></td>
                <td><?php echo $user["password_user"] ?></td>
                <td><?php echo $user["umur_user"] ?></td>
                <td><?php echo $user["rekening_user"] ?></td>
            </tr>
            <?php endforeach ?>
        </table>

        <br><br>

    <a href="homePage.php">kembali</a>
</body>
</html>