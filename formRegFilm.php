<?php 
    require "Qcrud.php";

    $genre = query("SELECT * FROM genre");

    if(isset($_POST["_submit"])){

        if(daftar_film($_POST)){

            echo "<script> alert('Filmmu berhasil ditambahkan!');</script>";
        }else{

            echo "<script> alert('Penambahan gagal, harap dicek kembali jika terdapat kesalahan');</script>";
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
    <title>Tambah Film</title>
</head>
<body>
    <h1>Tambah Film</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="_judul">Judul</label>
        <br>
        <textarea name="_judul" id="_judul" cols="30" rows="2"></textarea>
        
        <br><br>
        
        
        <label for="_genre">Genre</label>
        <select name="_genre" id="_genre">
            <?php foreach($genre as $gen) : ?>
                <option value="<?php echo $gen['id_genre'] ?>"><?php echo $gen['nama_genre'] ?></option>
            <?php endforeach; ?>
        </select>

        <br><br>

        <label for="_durasi">Durasi</label>
        <input type="time" name="_durasi" id="_durasi">

        <br><br>

        <label for="_gambar">Gambar</label>
        <input type="file" name="_gambar" id="_gambar">

        <br><br>

        <label for="_deskripsi">Deskripsi</label>
        <br>
        <textarea name="_deskripsi" id="_deskripsi" cols="30" rows="10"></textarea>

        <br><br>

        <button type="submit" name="_submit">Submit</button>
    </form>
</body>
</html>