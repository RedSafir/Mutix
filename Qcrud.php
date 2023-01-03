<?php 
    require "Qkoneksi.php";

    
    function upload()
    {
        $namaFile = $_FILES['_gambar']['name'];
        $ukuranFile = $_FILES['_gambar']['size'];
        $error = $_FILES['_gambar']['error'];
        $tmp = $_FILES['_gambar']['tmp_name'];

        //===========error 4 adalah user tidak masukin gambar/ada error saat input
        if($error == 4)
        {
            echo "<script> alert('gambar belum ada'); </script>";
            return false;
        }

        //===========yang di upload hanya gambar
        //ekstensi yang di ijinkan
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];

        //akan memecah gambar bila ketemu '.'
        $arrayNamaGambar = explode('.',$namaFile);
        //mengambil array terakhir (end)
        //membuat semua nama dalam array jadi kecil semua (strtolower)
        $ektensiGambar = strtolower(end($arrayNamaGambar));
        //mengecek apakah ada string valid di dalam ekstensi
        //true bila ada, false bila sebaliknya
        if(!in_array($ektensiGambar, $ekstensiGambarValid))
        {
            echo "<script> alert('input bukan gambar error'); </script>";
            return false;
        }

        //============ukuran file kegedean
        //bila ukuran file terlalu besar(lebih dari 1 mb)
        if($ukuranFile > 10000000)
        {
            echo "<script> alert('gambar gede amat'); </script>";
            return false;
        }

        //==============bila semua sudah di periksa, maka siap di upload
        //pindahin data yang di upload(berada di tmp) pindahin ke folder kita
        //generate nama baru sebelum upload ke database
        $namaFileBaru = uniqid() . '.' . $ektensiGambar;
        move_uploaded_file($tmp, 'image/' . $namaFileBaru);

        return $namaFileBaru;
    }

    //======================================== update profile ===================================================== \\
    function daftar_user_mutix($data)
    {
        global $conn;

        //html special chars di gunakan agar tidak ada user yang
        //mencoba mem bridge system lewat query data
        $username = strtolower(stripslashes($data["_username"]));
        $password = mysqli_real_escape_string($conn, $data["_password"]);
        $passwordConfirm = mysqli_real_escape_string($conn, $data["_confirmPassword"]);
        $umur =htmlspecialchars($data["_umur"]);
        $gambar = upload();

        //nama user harus beda dari yang lain
        $query = "SELECT nama FROM user WHERE nama = '$username'";
        $result = mysqli_query($conn,$query);

        if( mysqli_fetch_assoc($result))
        {
            echo "<script>alert('username sudah terdaftar');</script>" ;
            return false;
        }
        //pass dan confirm pass harus sama
        if($password !== $passwordConfirm)
        {
            echo "<script> alert('konfirmasi tidak sesuai');</script>";
            return false;
        }

        $query = "INSERT INTO user 
        VALUES 
        ('','$username','$password','$umur','','$gambar')";

        mysqli_query($conn, $query);

        //cek error, tapi kayanya sekarang udah bagus, jadi nggk perlu ini
        return mysqli_affected_rows($conn);
    }

    function daftar_admin_mutix($data)
    {
        global $conn;

        //html special chars di gunakan agar tidak ada user yang
        //mencoba mem bridge system lewat query data
        $username = strtolower(stripslashes($data["_username"]));
        $password = mysqli_real_escape_string($conn, $data["_password"]);
        $passwordConfirm = mysqli_real_escape_string($conn, $data["_confirmPassword"]);
        $gambar = upload();

        //nama user harus beda dari yang lain
        $query = "SELECT nama FROM admin WHERE nama = '$username'";
        $result = mysqli_query($conn,$query);

        if( mysqli_fetch_assoc($result))
        {
            echo "<script>alert('username sudah terdaftar');</script>" ;
            return false;
        }
        //pass dan confirm pass harus sama
        if($password !== $passwordConfirm)
        {
            echo "<script> alert('konfirmasi tidak sesuai');</script>";
            return false;
        }
        //enkripsi password

        $query = "INSERT INTO admin VALUES ('','$username','$password','$gambar')";

        mysqli_query($conn, $query);

        //cek error, tapi kayanya sekarang udah bagus, jadi nggk perlu ini
        return mysqli_affected_rows($conn);
    }

    function daftar_staff_mutix($data)
    {
        global $conn;

        //html special chars di gunakan agar tidak ada user yang
        //mencoba mem bridge system lewat query data
        $username = strtolower(stripslashes($data["_username"]));
        $password = mysqli_real_escape_string($conn, $data["_password"]);
        $passwordConfirm = mysqli_real_escape_string($conn, $data["_confirmPassword"]);
        $gambar = upload();

        //nama user harus beda dari yang lain
        $query = "SELECT nama FROM staff WHERE nama = '$username'";
        $result = mysqli_query($conn,$query);

        if( mysqli_fetch_assoc($result))
        {
            echo "<script>alert('username sudah terdaftar');</script>" ;
            return false;
        }
        //pass dan confirm pass harus sama
        if($password !== $passwordConfirm)
        {
            echo "<script> alert('konfirmasi tidak sesuai');</script>";
            return false;
        }

        $query = "INSERT INTO staff VALUES ('','$username','$password','$gambar')";

        mysqli_query($conn, $query);

        //cek error, tapi kayanya sekarang udah bagus, jadi nggk perlu ini
        return mysqli_affected_rows($conn);
    }

    //======================================== delete profile ===================================================== \\
    function hapus_profile($id, $aut)
    {
        global $conn;

        if($aut == 'admin'){

            mysqli_query($conn, "DELETE FROM admin WHERE id_admin = $id");
            return true;
        }else if($aut == 'staff'){

            mysqli_query($conn, "DELETE FROM staff WHERE id_staff = $id");
            return true;
        }else if($aut == 'user'){

            mysqli_query($conn, "DELETE FROM user WHERE id_user = $id");
            return true;
        }else{
            return false;
        }
    
        return mysqli_affected_rows($conn);
    }

    //============================================= update profile =========================================================\\
    function ubah_profile($data, $aut)
    {
        global $conn;

        if($aut == 'admin'){

            $id = $data["_id"];
            $Nama =htmlspecialchars($data["_username"]);
            $password =htmlspecialchars($data["_password"]);
            $gambarLama =htmlspecialchars($data["_gambarLama"]);

            //cek apakah user pilih gambar baru atau tidak
            // bila error 4 maka user tidak upload gambar baru
            if( $_FILES['_gambar']['error'] === 4)
            {
                $Gambar = $gambarLama;
            }else
            {
                $Gambar = upload();
            }


            $query = "UPDATE admin SET 
            Nama = '$Nama',
            password_admin = '$password',
            Gambar = '$Gambar' 
            WHERE id_admin = $id";

            mysqli_query($conn, $query);

            return true;

        }else if($aut == 'staff'){

            $id = $data["_id"];
            $Nama =htmlspecialchars($data["_username"]);
            $password =htmlspecialchars($data["_password"]);
            $gambarLama  =htmlspecialchars($data["_gambarLama"]);

            if( $_FILES['_gambar']['error'] === 4)
            {
                $Gambar = $gambarLama;
            }else
            {
                $Gambar = upload();
            }

            $query = "UPDATE staff SET 
            nama = '$Nama',
            password_staff = '$password',
            gambar = '$Gambar' 
            WHERE id_staff = $id";

            mysqli_query($conn, $query);

            return true;

        }else if($aut == 'user'){

            $id = $data["_id"];
            $Nama =htmlspecialchars($data["_username"]);
            $Email =htmlspecialchars($data["_password"]);
            $gambarLama  =htmlspecialchars($data["_gambarLama"]);

            if( $_FILES['_gambar']['error'] === 4)
            {
                $Gambar = $gambarLama;
            }else
            {
                $Gambar = upload();
            }


            $query = "UPDATE user SET 
            nama = '$Nama',
            password_password = '$Email',
            gambar = '$Gambar' 
            WHERE id = $id";

            mysqli_query($conn, $query);
            
            return true;
        }else{

            return false;
        }
    }

    //================================================ update film =======================================================\\
    function daftar_film($data)
    {
        global $conn;
        //input data film

        $judul = htmlspecialchars($data['_judul']);
        $durasi = $data['_durasi'];
        $gambar = upload();
        $genre_film = $data['_genre'];
        $deskripsi = htmlspecialchars($data['_deskripsi']);

        if(!$gambar){
            return false;
        }

        $query_film = "INSERT INTO film
        VALUES 
        ('','$judul','$genre_film','$durasi','$gambar','$deskripsi')";

        mysqli_query($conn, $query_film);

        //FK 
        // $result = query("SELECT id_film FROM film ORDER BY id_film DESC LIMIT 1");
        // $id_film = $result[0]["id_film"];

        // $genre_film = $data['_genre'];

        // $query_fk = "INSERT INTO genre_film VALUES ('','$id_film','$genre_film')";

        // mysqli_query($conn, $query_fk);

        //cek error, tapi kayanya sekarang udah bagus, jadi nggk perlu ini
        return mysqli_affected_rows($conn);
    }

    //========================================================= update bioskop ===============================================\\
    function daftar_bioskop($data)
    {
        global $conn;

        $nama = $data["_nama"];
        $banyak_ruangan = $data['_banyak_ruangan'];
        $kota = $data["_kota"];
        $alamat = $data["_alamat"];

        $query_film = "INSERT INTO bioskop
        VALUES 
        ('','$nama','$banyak_ruangan','$kota','$alamat')";

        mysqli_query($conn, $query_film);

        return mysqli_affected_rows($conn);
    }

    function daftar_ruangan($data)
    {
        global $conn;

        $nama = $data['_nama'];
        $bioskop = $data['_bioskop'];
        $baris = $data['_baris'];
        $column = $data['_column'];

        $query_ruangan= "INSERT INTO ruangan
        VALUES 
        ('','$bioskop','$nama','$baris','$column')";

        mysqli_query($conn, $query_ruangan);

        $query_id_ruangan = query("SELECT * FROM ruangan ORDER BY id_ruangan DESC LIMIT 1");
        $id_ruangan = $query_id_ruangan[0]['id_ruangan'];

        if(mysqli_affected_rows($conn) >= 0){

            for($i=1; $i <= $column; $i++){

                switch ($i) {

                    case 1:
                        $nama = 'A';
                        break;
                    
                    case 2:
                        $nama = 'B';
                        break;
        
                    case 3:
                        $nama = 'C';
                        break;
        
                    case 4:
                        $nama = 'D';
                        break;
        
                    case 5:
                        $nama = 'E';
                        break;
        
                    case 6:
                        $nama = 'F';
                        break;
        
                    case 7:
                        $nama = 'G';
                        break;
        
                    case 8:
                        $nama = 'H';
                        break;
                }

                for($j = 1; $j <= $baris; $j++ ){
                    $nama_kursi = $nama . $j;
        
                    $query = "INSERT INTO kursi
                    VALUES 
                    ('','$id_ruangan','$nama_kursi ','50000','0')"; 
        
                    mysqli_query($conn, $query);
                    if(mysqli_affected_rows($conn) < 0){
                        echo "error kursi";
                        die;
                    }
                }
                
            }
        }else{
            echo "error";
            die;
        }
    }

    function daftar_tayang($data)
    {
        global $conn;

        $bioskop = $data["_bioskop"];
        $ruang = $data["_ruangan"];
        $film = $data["_film"];
        $date = $data["_date"];
        $time = $data["_time"];


        $query_tayang= "INSERT INTO tayang
        VALUES 
        ('','$bioskop','$ruang','$film','$date','$time')";

        mysqli_query($conn, $query_tayang);

        return mysqli_affected_rows($conn);
    }

    //========================================================  pesan kursi =====================================\\


?>