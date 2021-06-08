<?php 
        require '../../function/functions.php';
        session_start();

            $idbukti=$_GET['id'];
        // $data = query("SELECT * FROM pembayaran,metodepembayaran WHERE idpesanan=$idpesanan and id=$iduser and metodepembayaran.idmetodepembayaran='$metodepembayaran' and hargatotal='$idharga'")[0];

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



    <!-- form upload -->
    <div class="container container-body">
        <h1>Silahkan Upload</h1>
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
        define("UPLOAD_DIR", "../../user/pembayaran/uploads/");

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
            echo '<div class="alert alert-warning">Gagal Upload, File tidak boleh Lebih dari 5Mb</div>';
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
            $insert = $conn->query("UPDATE buktipembayaran SET tgl_upload='$tgl',file_name='$name',file_size='$size',file_type='$ext'
           WHERE idbuktipembayaran=$idbukti");
            if($insert){
              echo '<div class="alert alert-success">File berhasil diupdate.</div>';
            }else{
            //   echo '<div class="alert alert-warning">Gagal Update.</div>';
            echo mysqli_error($conn);
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
        <a class="btn btn-primary" href="index.php" role="button">Back</a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>