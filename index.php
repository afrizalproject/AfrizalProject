<?php 
    session_start();
    require 'function/functions.php';

    $email = $_SESSION["email"];
    $role = $_SESSION["role"];
    $data = query("SELECT * FROM users WHERE email='$email'")[0];

    $_GET['iduser']=$data['id'];


    $sapa = "Welcome ".$data['username'].", Anda Login Sebagai ". $role;

    if (!isset($_SESSION["login"])) {
        header("Location: auth/login.php");
    }


    // krisar
    if (isset($_POST["krisar"])) {
        if (tambahKritikSaran($_POST)>0) {
            echo "
            <script>
                alert('Terimakasih sudah memberikan kami kritik dan saran ');
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



    <!-- Bootsrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <!-- my css -->
    <link rel="stylesheet" href="css/style.css">

    <title>Home</title>
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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#promo">Promo</a>
                    </li>
                    <?php if($_SESSION['role'] == 'user') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user/pelaksanaan/formpelaksanaan.php?id=<?= $data["id"] ?>">Order</a>
                    </li>
                    <?php endif ?>
                    <?php if($_SESSION['role'] == 'user') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php?id=<?= $data["id"] ?>"><i class="bi bi-cart-fill"></i></a>
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

    <!-- role -->


    <!-- jumbotron -->
    <section class="jumbotron text-center mt-5">
        <div class="mb-3 fst-italic">
            <?= $sapa?>
            <a href="profil/index.php?email=<?= $email ?>">edit</a>
        </div>
        <img class="img-thumbnail rounded-circle" src="img/logo.jpg" alt="AfrizalProject" width="200px">
        <h1 class="display-4 fw-bold">AfrizalProject</h1>
        <p class="lead">Jasa Dokumentasi Foto/Video untuk Acara Wedding</p>
        <?php if($_SESSION['role'] == 'admin') : ?>
        <a class="btn btn-primary" href="admin/index.php" role="button">Dashboard Admin</a>
        <?php elseif($_SESSION['role'] == 'user') : ?>
        <a class="btn btn-primary" href="user/pelaksanaan/formpelaksanaan.php?id=<?= $data["id"] ?>" role="button">Let's
            Order</a>
        <?php endif ?>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1"
                d="M0,96L40,96C80,96,160,96,240,117.3C320,139,400,181,480,186.7C560,192,640,160,720,165.3C800,171,880,213,960,202.7C1040,192,1120,128,1200,101.3C1280,75,1360,85,1400,90.7L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
            </path>
        </svg>
    </section>
    <!-- end jumbotron -->

    <!-- About Me -->
    <section id="about">
        <div class="container">
            <div class="row text-center mb-3">
                <div class="col">
                    <h2>About Me</h2>
                </div>
            </div>
            <div class="row justify-content-center fs-5 text-center">
                <div class="col-md-4">
                    <p>Halo Welcome, kami dari tim AfrizalProject. Kami menyediakan jasa dokumentasi foto/video untuk
                        acara wedding. Kami sudah menerima project sekitar 50+ di beberapa kota di Indonesia. Ayo jangan
                        ragu order ke kami, karena kami akan memberikan pelayanan terbaik untuk anda</p>
                </div>
            </div>
        </div>

    </section>
    <!-- Akhir About Me -->

    <!-- Projects -->
    <section id="promo">
        <div class="container">
            <div class="row text-center mb-3">
                <div class="col">
                    <h2>Promo Paket</h2>
                    <hr>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="img/basic.png" class="card-img-top" alt="Projects 1" ">
                        <div class=" card-body">
                        <h5 class="card-text text-center">Paket Basic</h5>
                        <p>Paket Basic sangat cocok untuk kalian yang mempunyai budget pas-pasan dengan layanan tim kami
                            hanya membantu anda untuk mendokumentasikan acara wedding anda, anda juga mendapatkan
                            pelayanan yang terbaik dari kami</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="img/standard.png" class="card-img-top" alt="Projects 2">
                    <div class=" card-body">
                        <h5 class="card-text text-center">Paket Standard</h5>
                        <p>Paket Standard sangat cocok untuk kalian yang mempunyai budget menengah dengan layanan tim
                            kami
                            yang akan turut membantu anda untuk mendokumentasikan acara wedding anda dan membantu
                            menyiapkan acara sebelum hari wedding, anda juga mendapatkan
                            pelayanan yang terbaik dari kami</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="img/premium.png" class="card-img-top" alt="Projects 3">
                    <div class=" card-body">
                        <h5 class="card-text text-center">Paket Premium</h5>
                        <p>Paket Premium sangat cocok untuk kalian yang ingin acara pernikahan anda terlihat sangat
                            mewah dengan layanan tim kami
                            membantu anda untuk mendokumentasikan acara wedding anda, membantu anda menyiapkan acara
                            sebelum hari wedding dan menyiapkan panggung estetik untuk tempat foto bagi para tamu
                            undangan anda, anda juga mendapatkan
                            pelayanan yang terbaik dari kami</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </section>
    <!-- Akhir Projects -->

    <!-- Projects -->
    <section id="projects">
        <div class="container">
            <div class="row text-center mb-3">
                <div class="col">
                    <h2>My Projects</h2>
                    <hr>
                </div>
            </div>
            <div class="row justify-content-center">
                <h4 class="text-center text-primary">Foto</h4>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="img/foto1.png" class="card-img-top" alt="Projects 1" ">
                        <div class=" card-body">
                        <p class="card-text text-center">Hari <i class="bi bi-heart-fill text-danger"></i> Susan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="img/foto2.png" class="card-img-top" alt="Projects 2">
                    <div class=" card-body">
                        <p class="card-text text-center">Yayan <i class="bi bi-heart-fill text-danger"></i> Sriyani</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="img/foto3.png" class="card-img-top" alt="Projects 3">
                    <div class=" card-body">
                        <p class="card-text text-center">Budi <i class="bi bi-heart-fill text-danger"></i> Zulfa</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="img/foto4.png" class="card-img-top" alt="Projects 4">
                    <div class=" card-body">
                        <p class="card-text text-center">Yono <i class="bi bi-heart-fill text-danger"></i> Juminten</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="img/foto5.png" class="card-img-top" alt="Projects 5">
                    <div class=" card-body">
                        <p class="card-text text-center">Yanto <i class="bi bi-heart-fill text-danger"></i> Yunnah</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </section>
    <!-- Akhir Projects -->

    <div class="container mt-1">
        <br>
        <h4 class="text-center text-primary mt-1">Video</h4>
        <br>
        <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/jR2QBNcy43M" title="YouTube video" allowfullscreen></iframe>
        </div>
    </div>

    <div class="container mt-1">
        <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/bkMjpEixNrg" title="YouTube video" allowfullscreen></iframe>
        </div>
    </div>

    <div class="container mt-1">
        <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/tWa1xifDkoQ" title="YouTube video" allowfullscreen></iframe>
        </div>
    </div>






    <!-- Contact -->
    <div class="container">
        <?php if($_SESSION['role'] == 'user') :?>
        <div class="row text-center mb-3">
            <div class="col mt-5">
                <h2>Beri Kami Kritik & Saran</h2>
            </div>
        </div>
        <form action="" method="POST">
            <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="<?= $data["id"]; ?>" name="id">
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                    style="height: 100px" name="kritik"></textarea>
                <label for="floatingTextarea2">Kritik</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control mb-3" placeholder="Leave a comment here" id="floatingTextarea2"
                    style="height: 100px" name="saran"></textarea>
                <label for="floatingTextarea2">Saran</label>
            </div>
            <div class="text-end">

                <button type="submit" class="btn btn-primary ml-3" name="krisar">Kirim</button><br>
                <a href="user/krisar/kritiksaran.php?id=<?= $data["id"]; ?>">Lihat Kritik & Saran anda </a>
            </div>

        </form>
        <?php endif ?>
    </div>

    <?php if($_SESSION['role'] == 'user') :?>
    <!-- start bukti pembayaran -->
    <div class="container container-body text-center table-responsive mt-5">
        <h2>Download Berkas Portofolio</h2>
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
                <th>No. </th>
                <th>FILE NAME</th>
                <th>DOWNLOAD</th>
            </tr>
            <?php $sqlDataBukti = $conn->query("SELECT * FROM portofolio ORDER BY idportofolio ASC"); 
            ?>
            <?php $i=1 ?>
            <?php foreach($sqlDataBukti as $value) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $value["file_name"]; ?></td>
                <td>
                    <!-- <a class="btn btn-primary" href="admin/portofolio/uploads/<?= $value['file_name']; ?>"
                        role="button">Download</a> -->
                    <a class="btn btn-primary" href="download.php?file=<?= $value['file_name']; ?>"
                        role="button">Download</a>
                </td>
            </tr>
            <?php $i++ ?>
            <?php endforeach ?>
        </table>

        <?php
    }
    ?>


        <hr>
    </div>
    <!-- end bukti pembayaran -->
    <?php endif ?>


    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#0d6efd" fill-opacity="1"
            d="M0,160L40,186.7C80,213,160,267,240,250.7C320,235,400,149,480,106.7C560,64,640,64,720,58.7C800,53,880,43,960,64C1040,85,1120,139,1200,160C1280,181,1360,171,1400,165.3L1440,160L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
        </path>
    </svg>
    </section>
    <!-- Akhir Contact -->

    <!-- Footer -->
    <footer class="bg-primary text-white text-center pb-5">
        <p>Created with <i class="bi bi-heart-fill text-danger"></i> <a href="https://www.instagram.com/afrizalrizky7/"
                class="text-white fw-bold">AfrizalProject</a>
        </p>
    </footer>
    <!-- Akhir Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
</body>

</html>