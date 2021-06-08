<?php 
  session_start();
  require 'function/functions.php';

  $iduser = $_GET['id'];

  $data = query("SELECT idpesanan,pelaksanaan.idpelaksanaan,username,namapaket,namaLayanan,durasiacara,namaPromo,keterangan FROM pesanan,pelaksanaan,users,paket,layanantambahan,durasiacara,promo where 
  pesanan.id=users.id and pesanan.idpaket=paket.idpaket and pesanan.id_layanantambahan=layanantambahan.id_layanantambahan and pesanan.iddurasiacara=durasiacara.iddurasiacara 
  and pesanan.idpromo=promo.idpromo and pesanan.idpelaksanaan=pelaksanaan.idpelaksanaan and users.id=$iduser ORDER BY idpesanan ASC");

  $data2 = query("SELECT idpelaksanaan,username,namadusun,namadesa,namakecamatan,namakabupaten,namaprovinsi from pelaksanaan,users,dusun,desa,kecamatan,kabupaten,provinsi
                where pelaksanaan.id=users.id and pelaksanaan.iddusun=dusun.iddusun and pelaksanaan.iddesa=desa.iddesa and pelaksanaan.idkecamatan=kecamatan.idkecamatan and 
                pelaksanaan.idkabupaten=kabupaten.idkabupaten and pelaksanaan.idprovinsi=provinsi.idprovinsi and users.id=$iduser ORDER BY idpelaksanaan ASC");

  $data3 = query("SELECT idpembayaran,pesanan.idpesanan,username,namametodepembayaran,hargatotal FROM pembayaran,pesanan,users,metodepembayaran WHERE 
                pembayaran.idpesanan=pesanan.idpesanan and pembayaran.id=users.id and pembayaran.idmetodepembayaran=metodepembayaran.idmetodepembayaran and users.id=$iduser ORDER BY idpembayaran ASC");
  
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

    <!-- Bootsrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <title>Tabel Pesanan</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top mb-2">
        <div class="container">
            <a class="navbar-brand" href="#">AfrizalProject</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <?php if($_SESSION['role'] == 'user') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user/pelaksanaan/formpelaksanaan.php?id=<?= $iduser ?>">Order</a>
                    </li>
                    <?php endif ?>
                    <?php if($_SESSION['role'] == 'user') : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="cart.php?id=<?= $iduser ?>"><i class="bi bi-cart-fill"></i></a>
                    </li>
                    <?php endif ?>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/logout.php"
                            onclick="return confirm('yakin ingin logout?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->
    <br>

    <!-- tabel pelaksanaan -->
    <h3 class="text-center mt-5">Tabel Pelaksanaan</h3>
    <div class="container text-end">
        <!-- <a class="btn btn-primary " href="tambah.php" role="button">Tambah Data</a> -->
    </div>

    <div class="container mb-5 table-responsive">
        <div class="mb-2">
            <a class="btn btn-outline-primary" href="index.php" role="button">Back</a>
        </div>
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">username</th>
                    <th scope="col">Dusun</th>
                    <th scope="col">Desa</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kabupaten</th>
                    <th scope="col">Provinsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                <?php foreach($data2 as $value) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $value["username"]; ?></td>
                    <td><?= $value["namadusun"]; ?></td>
                    <td><?= $value["namadesa"]; ?></td>
                    <td><?= $value["namakecamatan"]; ?></td>
                    <td><?= $value["namakabupaten"]; ?></td>
                    <td><?= $value["namaprovinsi"]; ?></td>
                </tr>
                <?php $i++ ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <hr>

    <!-- akhir pelaksanaan -->

    <!-- tabel pesanan -->
    <h3 class="text-center mt-5">Tabel Pesanan</h3>
    <div class="container text-end">
        <!-- <a class="btn btn-primary " href="tambah.php" role="button">Tambah Data</a> -->
    </div>

    <div class="container mb-5 table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">username</th>
                    <th scope="col">Nama Paket</th>
                    <th scope="col">Layanan</th>
                    <th scope="col">Durasi Acara</th>
                    <th scope="col">Promo</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                <?php foreach($data as $value) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $value["username"]; ?></td>
                    <td><?= $value["namapaket"]; ?></td>
                    <td><?= $value["namaLayanan"]; ?></td>
                    <td><?= $value["durasiacara"]; ?></td>
                    <td><?= $value["namaPromo"]; ?></td>
                    <td><?= $value["keterangan"]; ?></td>
                </tr>
                <?php $i++ ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <!-- akhir tabel pesanan -->
    <hr>



    <!-- awal pembayaran -->
    <h3 class="text-center mt-5">Tabel Pembayaran</h3>
    <div class="container text-end">
        <!-- <a class="btn btn-primary " href="tambah.php" role="button">Tambah Data</a> -->
    </div>

    <div class="container mb-5 table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">username</th>
                    <th scope="col">metode pembayaran</th>
                    <th scope="col">Harga Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                <?php foreach($data3 as $value) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $value["username"]; ?></td>
                    <td><?= $value["namametodepembayaran"]; ?></td>
                    <td><?= $value["hargatotal"]; ?></td>
                </tr>
                <?php $i++ ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <!-- akhir pembayaran -->
    <hr>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
</body>

</html>