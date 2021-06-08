<?php 

    require '../../function/functions.php';
    session_start();

    $harga = $_SESSION['harga'];
    $iduser = $_SESSION['iduser'];
    $paket = $_SESSION['paket'];
    $layanan = $_SESSION['layanan'];
    $durasiacara = $_SESSION['durasiacara'];
    $promo = $_SESSION['promo'];
    $keterangan = $_SESSION['keterangan'];


    $datapesanan = query("SELECT * FROM pesanan WHERE keterangan='$keterangan'")[0];
    $dataUser = query("SELECT * FROM users WHERE id=$iduser")[0];
    $metodepembayaran = query("SELECT * FROM metodepembayaran");
    

    if(isset($_POST["save"])){
        if (tambahpembayaran($_POST)>0) {
            
            // kirim data
            $_SESSION['idpesanan'] = $_POST['idpesanan'];
            $_SESSION['iduser'] = $_POST['id'];
            $_SESSION['metodepembayaran'] = $_POST['metodepembayaran'];
            $_SESSION['hargatotal'] = $_POST['harga'];


            echo "
                <script>
                    alert('data berhasil disimpan');
                    document.location.href = 'uploadpembayaran.php';
                </script>            
            ";
        }else{
            echo mysqli_error($conn);
        }
    }



?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <title>Form Metode Pembayaran</title>
</head>

<body>

    <!-- Form Login -->
    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h2>Form Metode Pembayaran</h2>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="POST">
                    <input type="hidden" name="idpesanan" value="<?= $datapesanan['idpesanan']; ?>">
                    <input type="hidden" name="id" value="<?= $dataUser['id']; ?>">
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select class="form-select" aria-label="Default select example" name="metodepembayaran">
                            <?php foreach($metodepembayaran as $valuemetodepembayaran) : ?>
                            <option value="<?= $valuemetodepembayaran['idmetodepembayaran']; ?>">
                                <?= $valuemetodepembayaran["namametodepembayaran"]; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga yang harus dibayar</label>
                        <input type="text" class="form-control" id="harga" aria-describedby="harga" name="harga"
                            required value="<?= $harga; ?>" readonly>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                        <!-- <a class="btn btn-outline-primary" href="../../index.php" role="button">Cancel</a> -->
                    </div>

                </form>
            </div>
        </div>


        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
        </script>
</body>

</html>