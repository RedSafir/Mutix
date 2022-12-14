<?php 
    require "Qcrud.php";

    if(isset($_POST["_submit"])){
        if(daftar_tayang($_POST) >= 1){
            echo "berhasil di tambahkan";
        }else{
            echo "terjadi kesalahan";
        }
    }
    $bioskop = query("SELECT * FROM bioskop");
    $ruangan = query("SELECT * FROM ruangan");
    $kursi = query("SELECT * FROM kursi");
    $film = query("SELECT * FROM film");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tayang</title>
</head>
<body>
    <h1>Daftar Tayang</h1>
    <form action="" method="POST">
        <label for="_bioskop">Nama bioskop</label>
        <select name="_bioskop" id="_bioskop">
            <?php foreach($bioskop as $bios) : ?>
                <option value="<?php echo $bios['id_bioskop'] ?>"><?php echo $bios['nama_bioskop'] ?></option>
            <?php endforeach ?>
        </select>

        <br><br>

        <label for="_ruangan">Nama ruangan</label>
        <select name="_ruangan" id="_ruangan">
            <?php foreach($ruangan as $ruang) : ?>
                <option value="<?php echo $ruang['id_ruangan'] ?>"><?php echo $ruang['nama_ruangan'] ?></option>
            <?php endforeach ?>
        </select>

        <br><br>

        <label for="_nama">Nama film</label>
        <select name="_film" id="_ruangan">
            <?php foreach($film as $fil) : ?>
                <option value="<?php echo $fil['id_film'] ?>"><?php echo $fil['judul_film'] ?></option>
            <?php endforeach ?>
        </select>

        <br><br>
        
        <label for="_date">Tanggal/bulan/tahun</label>
        <input type="date" name="_date" id="_date">

        <br><br>
        
        <label for="_time">Jam/menit/detik</label>
        <input type="time" name="_time" id="_time">

        <br>

        <button type="submit" name="_submit">Submit</button>
    </form>
</body>
</html>