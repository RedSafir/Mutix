<?php 

    // if(!isset($_POST["_submit"]))
    // {
    //     header("Location: index.php");
    //     exit;
    // }
    //menghubungkan dengan file php yang lain
    require "../function/koneksi.php";

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
    <title>Document</title>
</head>
<body>
    <h1>Daftar Admin</h1>
        <a href="">tambah</a>
        <a href="index.php">kembali</a>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>ACTION</th>
                <th>IDN ADMIN</th>
                <th>Nama ADMIN</th>
                <th>PASSWORD</th>
            </tr>
            <?php foreach($admins as $admin) : ?>
            <tr>
                <td>1</td>
                <td>
                    <a href="">Ubah</a>| 
                    <a href="">hapus</a>
                </td>
                <td><?php echo $admin["idn_admin"] ?></td>
                <td><?php echo $admin["nama_admin"] ?></td>
                <td><?php echo $admin["password_admin"] ?></td>
            </tr>
            <?php endforeach ?>
        </table>

    <br><br>

    <h1>Daftar Staff</h1>
        <a href="">tambah</a>
        <a href="index.php">kembali</a>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>ACTION</th>
                <th>IDN STAFF</th>
                <th>Nama STAFF</th>
                <th>PASSWORD</th>
            </tr>
            <?php foreach($staffs as $staff) : ?>
            <tr>
                <td>1</td>
                <td>
                    <a href="">Ubah</a>| 
                    <a href="">hapus</a>
                </td>
                <td><?php echo $staff["idn_staff"] ?></td>
                <td><?php echo $staff["nama_staff"] ?></td>
                <td><?php echo $staff["password_staff"] ?></td>
            </tr>
            <?php endforeach ?>
        </table>

    <br><br>

    <h1>Daftar User</h1>
        <a href="">tambah</a>
        <a href="index.php">kembali</a>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>ACTION</th>
                <th>IDN USER</th>
                <th>Nama USER</th>
                <th>PASSWORD</th>
                <th>UMUR</th>
                <th>REKENING</th>
            </tr>
            <?php foreach($users as $user) : ?>
            <tr>
                <td>1</td>
                <td>
                    <a href="">Ubah</a>| 
                    <a href="">hapus</a>
                </td>
                <td><?php echo $user["idn_user"] ?></td>
                <td><?php echo $user["nama_user"] ?></td>
                <td><?php echo $user["password_user"] ?></td>
                <td><?php echo $user["umur_user"] ?></td>
                <td><?php echo $user["rekening_user"] ?></td>
            </tr>
            <?php endforeach ?>
        </table>
</body>
</html>