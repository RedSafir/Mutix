<?php 
    session_start();
    setcookie('_id', '', mktime(0, 0, 0, 6, 27, 2003));
    setcookie('_pas', '', mktime(0, 0, 0, 6, 27, 2003));
    setcookie('_id', '', mktime(0, 0, 0, 6, 27, 2003));

    if(session_destroy())
    {
        echo "<script> alert('anda berhasil keluar');
        document.location.href = 'homePage.php';
        </script>";
    }
?>