<?php 
        require '../../function/functions.php';
        session_start();

        // ambil data
        $idpesanan = $_SESSION['idpesanan'];
        $iduser = $_SESSION['iduser'];
        $metodepembayaran = $_SESSION['metodepembayaran'];
        $idharga = $_SESSION['harga'];

        $data = query("SELECT * FROM pembayaran,metodepembayaran WHERE idpesanan=$idpesanan and id=$iduser and metodepembayaran.idmetodepembayaran='$metodepembayaran' and hargatotal='$idharga'")[0];
        $idpembayaran = $data['idpembayaran'];
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Upload Bukti Pembayaran</title>

    <style type="text/css">
    body {
        padding-top: 70px;
        background: #eeeeee;
    }

    .container-body {
        background: #ffffff;
        box-shadow: 1px 1px 1px #999;
        padding: 20px;
    }
    </style>
</head>

<body>

    <div class="col text-center mt-5 mb-3">
        <h2>Form Upload Bukti Pembayaran</h2>
    </div>

    <!-- tabel informasi -->
    <div class="container table-responsive">
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Metode Pembayaran</th>
                    <th scope="col">Nomor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>OVO</td>
                    <td>085330609273</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>GOPAY</td>
                    <td>085330609273</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>DANA</td>
                    <td>085330609273</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container text-danger">
        <p>*Silahkan lakukan pembayaran sebesar Rp. <?= $idharga; ?> menggunakan metode pembayaran
            <?= $data['namametodepembayaran']; ?> dan
            kirim ke nomor yang tertera</p>
    </div>

    <!-- form upload -->
    <div class="container container-body">
        <h1>Upload</h1>
        <hr>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-10">
                            <input type="file" name="myFile" class="filestyle" data-icon="false">
                        </div>
                        <div class="col-md-2 mt-3 mb-3">
                            <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                        </div>
                    </div>
                </form>

                <?php
        // definisi folder upload
        define("UPLOAD_DIR", "uploads/");

        if (!empty($_FILES["myFile"])) {
          $myFile = $_FILES["myFile"];
          $ext    = pathinfo($_FILES["myFile"]["name"], PATHINFO_EXTENSION);
          $size   = $_FILES["myFile"]["size"];
          $tgl   = date("Y-m-d");

          if ($myFile["error"] !== UPLOAD_ERR_OK) {
            echo '<div class="alert alert-warning">Gagal upload file.</div>';
            exit;
          }

        //   size file
        if ($size > 5000000) {
            echo '<div class="alert alert-warning">Gagal Upload, File tidak boleh Lebih dari 5Mb <a href="uploadpembayaran.php">coba lagi</a></div>';
            exit;
          }

          // filename yang aman
          $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

          // mencegah overwrite filename
          $i = 0;
          $parts = pathinfo($name);
          while (file_exists(UPLOAD_DIR . $name)) {
            $i++;
            $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
          }

          // upload file
          $success = move_uploaded_file($myFile["tmp_name"],
            UPLOAD_DIR . $name);
          if (!$success) { 
            echo '<div class="alert alert-warning">Gagal upload file.</div>';
            exit;
          }else{
            $insert = $conn->query("INSERT INTO buktipembayaran(idpembayaran,tgl_upload, file_name, file_size, file_type) VALUES($idpembayaran,'$tgl', '$name', '$size', '$ext')");
            if($insert){
              echo '<div class="alert alert-success">File berhasil diupload.</div>';
            }else{
              echo '<div class="alert alert-warning">Gagal upload file.</div>';
              exit;
            }
          }
          // set permisi file
          chmod(UPLOAD_DIR . $name, 0644);
        }
        ?>
            </div>
        </div>
        <?php
    
    ?>
        <hr>
        <center>copyright &copy; 2021 <a href="https://github.com/afrizalproject" target="_blank">AfrizalProject</a>
        </center>
    </div>

    <div class="container mt-3 text-end">
        <a class="btn btn-primary" href="../ordersukses.php" role="button">Finish</a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>