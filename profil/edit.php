<?php 

    require '../function/functions.php';

    $id = $_GET["id"];
    $data = query("SELECT * FROM users WHERE id=$id")[0];

    if(isset($_POST["edit"])){
        if (updateUser($_POST)>0) {
            echo "
            <script>
                alert('data berhasil diupdate');
                // document.location.href = '../profil/index.php';
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

    <title>Edit</title>
</head>

<body>

    <!-- Form Login -->
    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h2>Edit Profil</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="namaLengkap" aria-describedby="namaLengkap"
                            name="namaLengkap" required value="<?= $data["namaLengkap"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" aria-describedby="username"
                            name="username" readonly value="<?= $data["username"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="text" class="form-control" id="email" aria-describedby="email" name="email"
                            readonly value="<?= $data["email"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="notelp" class="form-label">No. telp</label>
                        <input type="number" class="form-control" id="notelp" aria-describedby="notelp" name="notelp"
                            required value="<?= $data["notelp"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" aria-describedby="alamat" name="alamat"
                            required value="<?= $data["alamat"]; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" aria-describedby="password"
                            name="password" required value="<?= $data["password"]; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                    <a class="btn btn-primary" href="index.php?email=<?= $data["email"]; ?>" role="button">Kembali</a>
                </form>
            </div>
        </div>


        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
        </script>
</body>

</html>