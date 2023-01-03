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
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Tabel Admin</title>
</head>
<body>
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
          <h2 class="fw-bold mb-5">Daftar Admin</h2>
    <div class="container-sm">
        <form method="POST" action="formRegAdmin.php">
        <button type="input" class="btn btn-outline-primary">Tambah</button>
        </form>
        <table class="table table-dark table-hover">
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
                    <a role ="button" class="btn btn-info" href="formUpAdmin.php?id=<?php echo $d['user_id']; ?>">UBAH</a> </button>
					<a role ="button" class="btn btn-danger" href="Qhapus.php?id=<?php echo $admin['id_admin'] ?>&_aut=admin">HAPUS</a>
                </td>
                <td><img src="image/<?php echo $admin["gambar"] ?>" alt="error" width="50"></td>
                <td><?php echo $admin["nama"] ?></td>
                <td><?php echo $admin["password_admin"] ?></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach ?>
        </table>
            </section>
    <br><br>

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
          <h2 class="fw-bold mb-5">Daftar Staff</h2>
        <form method="POST" action="formRegStaff.php">
        <button type="input" class="btn btn-outline-primary">Tambah</button>
        </form>
        <table class="table table-dark table-hover">
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
                <a role ="button" class="btn btn-info" href="formUpStaff.php?id=<?php echo $d['user_id']; ?>">UBAH</a> </button>
				<a role ="button" class="btn btn-danger" href="Qhapus.php?id=<?php echo $d['user_id']; ?>">HAPUS</a>
                </td>
                <td><img src="image/<?php echo $staff["gambar"] ?>" alt="error" width="50"></td>
                <td><?php echo $staff["nama"] ?></td>
                <td><?php echo $staff["password_staff"] ?></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach ?>
        </table>
            </section>
    <br><br>

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
          <h2 class="fw-bold mb-5">Daftar User</h2>
    <form method="POST" action="formRegUser.php">
    <button type="input" class="btn btn-outline-primary">Tambah</button>
    
    </form>
        <table class="table table-dark table-hover">
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
                    <a role ="button" class="btn btn-info" href="formUpUser.php?id=<?php echo $d['user_id']; ?>">UBAH</a> </button>
					<a role ="button" class="btn btn-danger" href="Qhapus.php?id=<?php echo $d['user_id']; ?>">HAPUS</a>
                </td>
                <td><img src="image/<?php echo $user["gambar"] ?>" alt="error" width="50"></td>
                <td><?php echo $user["nama"] ?></td>
                <td><?php echo $user["password_user"] ?></td>
                <td><?php echo $user["umur_user"] ?></td>
                <td><?php echo $user["rekening_user"] ?></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach ?>
        </table>
            
        <br><br>
        <form method="POST" action="homePage.php">
        <button type="input" class="btn btn-outline-primary">Kembali</button>
    
    </form>
    </section>
    <br>
</body>
</html>