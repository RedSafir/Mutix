<?php 
    require "Qkoneksi.php";
    session_start();

    function ceklogin($data){
        global $conn;

        //yang tadinya ada di post, masukan ke variabel local
        $username = $data["_username"];
        $password = $data["_password"];
        
        //cek apakah di database terdapat $username atau tidak
        $result_user = mysqli_query($conn, "SELECT * FROM user WHERE nama = '$username'");
        $result_admin = mysqli_query($conn, "SELECT * FROM admin WHERE nama = '$username'");
        $result_staff = mysqli_query($conn, "SELECT * FROM staff WHERE nama = '$username'");

        
        //cek apakah ada atau nggk ada
        if (mysqli_num_rows($result_user) === 1){
            $row_user = mysqli_fetch_assoc($result_user);
            //bila password_hash buat encrypt
            //kalau password verfy hash dan password input
            if($password === $row_user["password_user"]){
                
                //simpan cookie bila tombol radio di tekan
                if(isset($_POST["_remember_me"])){

                    setcookie('_id', $row_user["nama"], time() + 60 * 60);
                    setcookie('_pas', $row_user["password_user"], time() + 60 * 60);
                }

                //simpan session
                $_SESSION['_aut'] = 'user';
                $_SESSION['_id'] = $row_user["id_user"];
                $_SESSION['_login'] = true;
                

                return true;
            }
        } 
        else if (mysqli_num_rows($result_staff) === 1){

            $row_staff = mysqli_fetch_assoc($result_staff);

            if($password === $row_staff["password_staff"]){

                if(isset($_POST["_remember_me"])){

                    setcookie('_id', $row_staff["nama"], time() + 60 * 60);
                    setcookie('_pas', $row_staff["password_staff"], time() + 60 * 60);
                }
                
                $_SESSION['_aut'] = 'staff';
                $_SESSION['_id'] = $row_staff["id_staff"];
                $_SESSION['_login'] = true;

                return true;
            }
        }
        else if (mysqli_num_rows($result_admin) === 1){

            $row_admin = mysqli_fetch_assoc($result_admin);

            if($password === $row_admin["password_admin"])
            {
                if(isset($_POST["_remember_me"])){
                    
                    setcookie('_id', $row_admin["nama"], time() + 60 * 60);
                    setcookie('_pas', $row_admin["password_admin"], time() + 60 * 60);
                }

                $_SESSION['_aut'] = 'admin';
                $_SESSION['_id'] = $row_admin["id_admin"];
                $_SESSION['_login'] = true;

                return true;
            }
        }
        else{

            return false;
        }
    }
    
    function cekProfile(){

        $akses = $_SESSION['_aut'];
        $id = $_SESSION['_id'];
    
        if($akses == "admin"){
            $result_id = query("SELECT * FROM admin WHERE id_admin = '$id'");
        }else if($akses == "staff")
        {
            $result_id = query("SELECT * FROM staff WHERE id_staff = '$id'");
        }else if($akses == "user") 
        {
            $result_id = query("SELECT * FROM user WHERE id_user = '$id'");
        }

        return $result_id;
    }
?>