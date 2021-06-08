<?php 

    require '../../function/functions.php';
    session_start();

    // ambildata
    $id = $_SESSION['iduser'];
    $dusun = $_SESSION['dusun'];
    $desa = $_SESSION['desa'];
    $kecamatan = $_SESSION['kecamatan'];
    $kabupaten = $_SESSION['kabupaten'];
    $provinsi = $_SESSION['provinsi'];
    $datapelaksanaan = query("SELECT * FROM pelaksanaan WHERE id=$id and iddusun=$dusun and iddesa=$desa and idkecamatan=$kecamatan and idkabupaten=$kabupaten and idprovinsi=$provinsi")[0];


    $paket = query("SELECT * FROM paket");
    $promo = query("SELECT * FROM promo");
    $durasiacara = query("SELECT * FROM durasiacara");
    $layanan = query("SELECT * FROM layanantambahan");
    

    $_SESSION['iduser']=$id;

    if(isset($_POST["save"])){

        // harga promo
        if ($_POST['paket'] == 6 ) {
            $data = (int) $_POST['paket'];
            $result = mysqli_query($conn,"SELECT * FROM paket WHERE idpaket = $data");
            $row = mysqli_fetch_assoc($result);
            $hargaAwal = $row['hargapaket']; 
            $hargaTotal = (int) $row['hargapaket'] * 0.5;
        }elseif ($_POST['paket'] == 7 ) {
            $data = (int) $_POST['paket'];
            $result = mysqli_query($conn,"SELECT * FROM paket WHERE idpaket = $data");
            $row = mysqli_fetch_assoc($result);
            $hargaAwal = $row['hargapaket']; 
            $hargaTotal = (int) $row['hargapaket'] * 0.5;
        }elseif ($_POST['paket'] == 9 ) {
            $data = (int) $_POST['paket'];
            $result = mysqli_query($conn,"SELECT * FROM paket WHERE idpaket = $data");
            $row = mysqli_fetch_assoc($result);
            $hargaAwal = $row['hargapaket']; 
            $hargaTotal = (int) $row['hargapaket'] * 0.5;
        }

        $_SESSION['harga']=$hargaTotal;
        $_SESSION['paket']=$_POST['paket'];
        $_SESSION['layanan']=$_POST['layanan'];
        $_SESSION['durasiacara']=$_POST['durasiacara'];
        $_SESSION['promo']=$_POST['promo'];
        $_SESSION['keterangan']=$_POST['keterangan'];



        echo "
            <script>
                alert('Harga awal : Rp. $hargaAwal dan Harga yang harus dibayar: Rp. $hargaTotal' );
            </script>
        ";
        
        if (tambahPesanan($_POST)>0) {
            echo "
                <script>
                    alert('data berhasil disimpan');
                    document.location.href = '../pembayaran/formpembayaran.php';
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

    <title>Form Pesanan</title>
</head>

<body>

    <!-- Form Login -->
    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h2>Form Pesanan</h2>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="idpelaksanaan" value="<?= $datapelaksanaan['idpelaksanaan'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Paket</label>
                        <select class="form-select" aria-label="Default select example" name="paket">
                            <?php foreach($paket as $valuepaket) : ?>
                            <option value="<?= $valuepaket['idpaket']; ?>"><?= $valuepaket["namapaket"]; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Layanan</label>
                        <select class="form-select" aria-label="Default select example" name="layanan">
                            <?php foreach($layanan as $valuelayanan) : ?>
                            <option value="<?= $valuelayanan['id_layanantambahan']; ?>">
                                <?= $valuelayanan["namaLayanan"]; ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Durasi Acara</label>
                        <select class="form-select" aria-label="Default select example" name="durasiacara">
                            <?php foreach($durasiacara as $valuedurasiacara) : ?>
                            <option value="<?= $valuedurasiacara['iddurasiacara']; ?>">
                                <?= $valuedurasiacara["durasiacara"]; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Promo</label>
                        <select class="form-select" aria-label="Default select example" name="promo">
                            <?php foreach($promo as $valuepromo) : ?>
                            <option value="<?= $valuepromo['idpromo']; ?>">
                                <?= $valuepromo["namaPromo"]; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-floating mb-3 text-end">
                        <textarea class="form-control" placeholder="Keterangan Tambahan" id="floatingTextarea2"
                            style="height: 100px" name="keterangan" required></textarea>
                        <label for="floatingTextarea2">keterangan tambahan</label>
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