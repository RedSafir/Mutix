<?php 
    require "Qcrud.php";

    if(isset($_POST["_submit"])){
        if(daftar_ruangan($_POST) >= 1){
            echo "berhasil di tambahkan";
        }else{
            echo "terjadi kesalahan";
        }
    }
    $bioskop = query("SELECT * FROM bioskop")
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
    <title>Daftar Ruangan</title>
</head>
<body>
    
    <h1>Daftar Ruangan</h1>
    <form action="" method="POST">
        <label for="_nama">Nama bioskop</label>
        <select name="_bioskop" id="_bioskop">
            <?php foreach($bioskop as $bios) : ?>
                <option value="<?php echo $bios['id_bioskop'] ?>"><?php echo $bios['nama_bioskop'] ?></option>
            <?php endforeach ?>
        </select>

        <br><br>

        <label for="_nama">Nama Ruangan</label>
        <input type="text" name="_nama" id="_nama">

        <br><br>

        <label for="_baris">Baris</label>
        <input type="text" name="_baris" id="_baris">

        <br><br>

        <label for="_column">Column</label>
        <input type="text" name="_column" id="_column">

        <br><br>

        <button type="submit" name="_submit">Submit</button>
    </form>
</body>
</html>