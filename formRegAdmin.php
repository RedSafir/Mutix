<?php 
    require "Qcrud.php";

    if(isset($_POST["_submit"]))
    {
        if (daftar_admin_mutix($_POST) > 0) 
        {
            echo "<script> alert('user baru berhasil di tambahkan');
            document.location.href = 'formLogin.php';</script>";
        }else
        {
            echo  "<script> alert('user baru gagal di tambahkan');</script>";
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
    <title>Registrasi admin</title>
</head>
<body>
    <section class="text-center">
     <!-- Background image -->
     <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Registrasi Admin</h2>
          <form action="" method="POST" enctype="multipart/form-data">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="file" name="_gambar" id="_gambar" class="form-control" />
                  <label class="form-label" for="_gambar">Foto Profil</label>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" name="_username" id="_username" class="form-control" />
                  <label class="form-label" for="_username">Username</label>
                </div>
              </div>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" name="_password" id="_password" class="form-control" />
              <label class="form-label" for="_password">Password</label>
            </div>

            <!-- Password Confirm -->
            <div class="form-outline mb-4">
              <input type="password" name="_confirmPassword" id="_confirmPassword" class="form-control" />
              <label class="form-label" for="_confirmPassword">Confirm Password</label>
            </div>

            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-center mb-4">
              <input class="form-check-input me-2" type="checkbox" value="" name="_remember_me" id="_remember_me" checked />
              <label class="form-check-label" for="_remember_me">
                Remember Me
              </label>
            </div>

            <!-- Submit button -->
            <button type="submit" name="_submit" class="btn btn-primary btn-block mb-4">
              Sign Up
            </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>\
<br>
<br>
</body>
</html>