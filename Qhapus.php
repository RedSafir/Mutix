<?php 
    require "Qcrud.php";

    $id = $_GET['_id'];
    $aut = $_GET['_aut'];

    if(hapus_profile($id,$aut)){

        echo "
        <script>
            alert('data berhasil di hapus');
            document.location.href = 'javascript:history.go(-1)';
        </script>";
    }else{

        echo "
        <script>
            alert('data gagal di hapus');
            document.location.href = 'javascript:history.go(-1)';
        </script>";
    }
?>