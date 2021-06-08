<?php 
      require '../function/functions.php';
      session_start();

        if (isset($_SESSION["login"])) {
            header("Location: ../index.php");
            exit;
        }


      if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $_SESSION["email"]=$email;

        $result = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
        // hitung ada berapa baris yg di return dari query sleect diatas jika 1 ada dan 0 tidak ada
        if (mysqli_num_rows($result)===1) {
            // cek pw
            $row = mysqli_fetch_assoc($result);
            if($password===$row["password"]){
                $_SESSION["login"]=true;
                $_SESSION["email"]=$row["email"];
                $_SESSION["role"]=$row["role"];
                header('Location: ../index.php');
                exit;
            }
        }

        $error = true;
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

    <title>Login</title>
</head>

<body>

    <!-- Form Login -->
    <form action="" method="POST">
        <div class="container">
            <div class="row">
                <div class="col text-center mt-5">
                    <h2>Login</h2>
                </div>
            </div>
            <div class="row">
                <?php if(isset($error)) : ?>
                <div class="col text-center mt-1">
                    <p class="text-danger fst-italic">Email / Password Salah !</p>
                </div>
                <?php endif ?>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="email" name="email"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" aria-describedby="password"
                                name="password" required>
                        </div>
                        <div class="mb-3 text-end">
                            Belum Punya Akun?
                            <a href="register.php">Register</a>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </form>
                </div>
            </div>


            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
                crossorigin="anonymous"></script>
</body>

</html>