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