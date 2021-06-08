<?php 

    require '../function/functions.php';

    if(isset($_POST["register"])){
        if (registrasi($_POST)>0) {
            echo "
                <script>
                    alert('Anda Berhasil Sign Up, Silahkan Login dengan akun baru anda');
                    document.location.href = 'login.php';
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

    <title>Register</title>
</head>

<body>

    <!-- Form Login -->
    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h2>Register</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="namaLengkap" aria-describedby="namaLengkap"
                            name="namaLengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" aria-describedby="username"
                            name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="email" name="email"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="notelp" class="form-label">No. telp</label>
                        <input type="number" class="form-control" id="notelp" aria-describedby="notelp" name="notelp"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" aria-describedby="alamat" name="alamat"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" aria-label="Default select example" name="role">
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" aria-describedby="password"
                            name="password" required>
                    </div>

                    <div class="mb-3 text-end">
                        Sudah Punya Akun?
                        <a href="login.php">Login</a>
                    </div>
                    <button type="submit" class="btn btn-primary" name="register">Sign Up</button>
                </form>
            </div>
        </div>


        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
        </script>
</body>

</html>