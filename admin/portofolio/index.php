<?php 
        require '../../function/functions.php';
        session_start();

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

    <title>Upload Berkas Portofolio</title>

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

    <div class="mb-2 container">
        <a class="btn btn-outline-primary" href="../index.php" role="button">Back</a>
    </div>
    <!-- form upload -->
    <div class="container container-body">
        <h1>Upload Berkas Portofolio</h1>
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
            echo '<div class="alert alert-warning">Gagal Upload, File tidak boleh Lebih dari 5Mb <a href="index.php">coba lagi</a></div>';
            // echo '<a href="index.php">coba lagi</a>';
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
            $insert = $conn->query("INSERT INTO portofolio (tgl_upload, file_name, file_size, file_type) VALUES('$tgl', '$name', '$size', '$ext')");
            if($insert){
              echo '<div class="alert alert-success">File berhasil di upload.</div>';
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

    </div>


    <!-- start bukti pembayaran -->
    <div class="container container-body text-center table-responsive">
        <h3>Download Berkas Portofolio</h3>
        <hr>
        <?php
    if(!$_SESSION['login']){
      echo '<div class="alert alert-danger">Anda harus login untuk membuka halaman ini.</div>';
    }else{
      function bytesToSize($bytes, $precision = 2){  
        $kilobyte = 1024;
        $megabyte = $kilobyte * 1024;
        $gigabyte = $megabyte * 1024;
        $terabyte = $gigabyte * 1024;
       
        if (($bytes >= 0) && ($bytes < $kilobyte)) {
          return $bytes . ' B';
        } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
          return round($bytes / $kilobyte, $precision) . ' KB';
        } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
          return round($bytes / $megabyte, $precision) . ' MB';
        } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
          return round($bytes / $gigabyte, $precision) . ' GB';
        } elseif ($bytes >= $terabyte) {
          return round($bytes / $terabyte, $precision) . ' TB';
        } else {
          return $bytes . ' B';
        }
      }
    ?>

        <table class="table table-hover">
            <tr class="table-light">
                <th>No.</th>
                <th>Tanggal Upload</th>
                <th>FILE NAME</th>
                <th>FILE SIZE</th>
                <th>FILE TYPE</th>
                <th>DOWNLOAD</th>
                <th>Button</th>
            </tr>
            <?php $sqlDataBukti = $conn->query("SELECT * FROM portofolio ORDER BY idportofolio ASC"); 
            ?>
            <?php $i=1 ?>
            <?php foreach($sqlDataBukti as $value) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $value["tgl_upload"]; ?></td>
                <td><?= $value["file_name"]; ?></td>
                <td><?= bytesToSize($value['file_size']) ?></td>
                <td><?= $value["file_type"]; ?></td>
                <td>
                    <a class="btn btn-primary" href="download.php?file=<?= $value['file_name']; ?>"
                        role="button">Download</a>
                </td>
                <td>
                    <a class="btn btn-danger" onclick="return confirm('apakah anda yakin?')"
                        href="hapusportofolio.php?id=<?= $value["idportofolio"]; ?>" role="button">Hapus</a>
                </td>
            </tr>
            <?php $i++ ?>
            <?php endforeach ?>
        </table>

        <?php
    }
    ?>
        <center>copyright &copy; 2021 <a href="https://github.com/afrizalproject" target="_blank">AfrizalProject</a>
        </center>

        <hr>
    </div>
    <!-- end bukti pembayaran -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>