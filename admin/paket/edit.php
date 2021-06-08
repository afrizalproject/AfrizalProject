<?php 

    require '../../function/functions.php';

    $id = $_GET["id"];
    $data = query("SELECT * FROM paket WHERE idpaket=$id")[0];

    if(isset($_POST["edit"])){
        if (updatePaket($_POST)>0) {
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

    <title>Edit Paket</title>
</head>

<body>

    <!-- Form Login -->
    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h2>Edit Paket</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="namaLengkap" aria-describedby="namaLengkap"
                            name="idpaket" required value="<?= $data["idpaket"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" id="username" aria-describedby="username"
                            name="namapaket" required value="<?= $data["namapaket"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Harga Paket</label>
                        <input type="text" class="form-control" id="email" aria-describedby="email" name="hargapaket"
                            required value="<?= $data["hargapaket"]; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                    <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
                </form>
            </div>
        </div>


        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
        </script>
</body>

</html>