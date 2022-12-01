<?php 
    $conn = mysqli_connect("localhost", "root", "", "mutix");

    function query($query)
    {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];

        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[] = $row;
        }

        return $rows;
    }

    function daftar_user_mutix($data)
    {
        global $conn;

        //html special chars di gunakan agar tidak ada user yang
        //mencoba mem bridge system lewat query data
        $idn =htmlspecialchars($data["_idn"]);
        $nama =htmlspecialchars($data["_nama"]);
        $password =htmlspecialchars($data["_password"]);
        $umur =htmlspecialchars($data["_umur"]);
        $rekening =htmlspecialchars($data["_rekening"]);

        $query = "INSERT INTO mahasiswa 
        VALUES 
        ('','$idn','$nama','$password','$umur','$rekening')";

        mysqli_query($conn, $query);

        //cek error, tapi kayanya sekarang udah bagus, jadi nggk perlu ini
        return mysqli_affected_rows($conn);
    }

    function daftar_staff_mutix($data)
    {
        global $conn;

        //html special chars di gunakan agar tidak ada user yang
        //mencoba mem bridge system lewat query data
        $idn =htmlspecialchars($data["_idn"]);
        $nama =htmlspecialchars($data["_nama"]);
        $password =htmlspecialchars($data["_password"]);

        $query = "INSERT INTO staff 
        VALUES 
        ('','$idn','$nama','$password'";

        mysqli_query($conn, $query);

        //cek error, tapi kayanya sekarang udah bagus, jadi nggk perlu ini
        return mysqli_affected_rows($conn);
    }

    function daftar_admin_mutix($data)
    {
        global $conn;

        //html special chars di gunakan agar tidak ada user yang
        //mencoba mem bridge system lewat query data
        $idn =htmlspecialchars($data["_idn"]);
        $nama =htmlspecialchars($data["_nama"]);
        $password =htmlspecialchars($data["_password"]);

        $query = "INSERT INTO admin 
        VALUES 
        ('','$idn','$nama','$password'";

        mysqli_query($conn, $query);

        //cek error, tapi kayanya sekarang udah bagus, jadi nggk perlu ini
        return mysqli_affected_rows($conn);
    }


?>