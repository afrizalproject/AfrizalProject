<?php 

    require '../../function/functions.php';

    $id = $_GET["id"];
    $data = query("SELECT * FROM pesanan WHERE idpesanan=$id")[0];
    $paket = query("SELECT * FROM paket");
    $promo = query("SELECT * FROM promo");
    $durasiacara = query("SELECT * FROM durasiacara");
    $layanan = query("SELECT * FROM layanantambahan");

    

    if(isset($_POST["edit"])){

        if ($_POST['paket'] == 1 ) {
            $data = (int) $_POST['paket'];
            $result = mysqli_query($conn,"SELECT * FROM paket WHERE idpaket = $data");
            $row = mysqli_fetch_assoc($result);
            $hargaAwal = $row['hargapaket']; 
            $hargaTotal = (int) $row['hargapaket'] * 0.5;
        }elseif ($_POST['paket'] == 3 ) {
            $data = (int) $_POST['paket'];
            $result = mysqli_query($conn,"SELECT * FROM paket WHERE idpaket = $data");
            $row = mysqli_fetch_assoc($result);
            $hargaAwal = $row['hargapaket']; 
            $hargaTotal = (int) $row['hargapaket'] * 0.5;
        }elseif ($_POST['paket'] == 4 ) {
            $data = (int) $_POST['paket'];
            $result = mysqli_query($conn,"SELECT * FROM paket WHERE idpaket = $data");
            $row = mysqli_fetch_assoc($result);
            $hargaAwal = $row['hargapaket']; 
            $hargaTotal = (int) $row['hargapaket'] * 0.5;
        }

        if (editpesanan($_POST)>0) {
            echo "
            <script>
                alert('data berhasil diupdate');
                document.location.href = 'index.php';
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

    <title>Edit Pesanan</title>
</head>

<body>

    <!-- Form Login -->
    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h2>Edit Pesanan</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
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
                            style="height: 100px" name="keterangan"
                            required><?php echo $data['keterangan']; ?></textarea>
                        <label for="floatingTextarea2">keterangan tambahan</label>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" name="edit">edit</button>
                        <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
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