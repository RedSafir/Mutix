<?php 
    require "koneksi.php";

    //memasukan database ke dalam array dengan functuion koneksi.php
    $admins = query("SELECT * FROM admin");
    $users = query("SELECT * FROM user");
    $stafs = query("SELECT * FROM staff");

    //cek password dan username 
    //bila benar, admin, staff, dan user punya tingkatan akses yang berbeda
    if(isset($_POST["_submit"]))
    {
        foreach( $admins as $admin )
        {
            if($_POST["_username"] == $admin["nama_admin"] && $_POST["_password"] == $admin["password_admin"])
            {
                header("Location: ../Table/adminTabel.php");
                exit;
            }
        }

        foreach( $users as $user)
        {
            if($_POST["_username"] == $user["nama_user"] && $_POST["_password"] == $user["password_user"])
            {
                header("Location: ../Content/useraccess.php");
                exit;
            }
        }

        foreach( $stafs as $staff)
        {
            if($_POST["_username"] == $staff["nama_staff"] && $_POST["_password"] == $staff["password_staff"])
            {
                header("Location: ../COntent/staffaccess.php");
                exit;
            }
        }
        
        header("Location: ../index.php?error=true");
    }
?>