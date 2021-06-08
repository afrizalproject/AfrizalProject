<?php 

    require '../../function/functions.php';

    $id = $_GET["id"];
    $pembayaran = query("SELECT * FROM pembayaran WHERE idpembayaran=$id")[0];
    $metodepembayaran = query("SELECT * FROM metodepembayaran");
    

    if(isset($_POST["edit"])){

        if (editpembayaran($_POST)>0) {
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

    <title>Edit Pembayaran</title>
</head>

<body>

    <!-- Form Login -->
    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h2>Edit Pembayaran</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select class="form-select" aria-label="Default select example" name="metodepembayaran">
                            <?php foreach($metodepembayaran as $valuepembayaran) : ?>
                            <option value="<?= $valuepembayaran['idmetodepembayaran']; ?>">
                                <?= $valuepembayaran["namametodepembayaran"]; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga yang harus dibayar</label>
                        <input type="text" class="form-control" id="harga" aria-describedby="harga" name="harga"
                            required value="<?= $pembayaran['hargatotal']; ?>">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" name="edit">Edit</button>
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