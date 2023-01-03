<?php 
    require "Qcrud.php";

    if(isset($_POST["_submit"])){
        if(daftar_bioskop($_POST) >= 1){
            echo "berhasil di tambahkan";
        }else{
            echo "terjadi kesalahan";
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
    <title>Daftar Bioskop</title>
</head>
<body>
    <!-- Section: Design Block -->
<section class="text-center">
  <!-- Background image -->
  <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Daftar Bioskop</h2>
          <form action="" method="POST">

            <!-- Nama Bioskop -->
            <div class="form-outline mb-4">
              <input type="text" name="_nama" id="_nama" class="form-control" />
              <label class="form-label" for="_nama">Nama Bioskop</label>
            </div>

            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" name="_banyak_ruangan" id="_banyak_ruangan" class="form-control" />
                  <label class="form-label" for="_banyak_ruangan">Banyak Ruangan</label>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" name="_kota" id="_kota" class="form-control" />
                  <label class="form-label" for="_kota">Kota</label>
                </div>
              </div>
            </div>

            <!-- Alamat input -->
            <div class="form-outline mb-4">
              <input type="text" name="_alamat" id="_alamat" class="form-control" />
              <label class="form-label" for="_alamat">Alamat</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">
              Submit
            </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<br>
<br>
</body>
</html>