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

    <title>Dashboard Admin</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top mb-5">
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
                        <a class="nav-link active" aria-current="page" href="#">Daftar Tabel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/logout.php"
                            onclick="return confirm('yakin ingin logout?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <h1 class="text-center mt-5">Daftar Tabel</h1>

    <div class="container">
        <div class="mb-2">
            <a class="btn btn-outline-primary" href="../index.php" role="button">Back</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama tabel</th>
                    <th scope="col">Button</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Users</td>
                    <td><a class="btn btn-primary" href="users/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Pesanan</td>
                    <td><a class="btn btn-primary" href="pesanan/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Upload Berkas Portofolio</td>
                    <td><a class="btn btn-primary" href="portofolio/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Paket</td>
                    <td><a class="btn btn-primary" href="paket/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Durasi Acara</td>
                    <td><a class="btn btn-primary" href="durasiacara/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Layanan Tambahan</td>
                    <td><a class="btn btn-primary" href="layanantambahan/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>Promo</td>
                    <td><a class="btn btn-primary" href="promo/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">8</th>
                    <td>Dusun</td>
                    <td><a class="btn btn-primary" href="dusun/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">9</th>
                    <td>Desa</td>
                    <td><a class="btn btn-primary" href="desa/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">10</th>
                    <td>Kecamatan</td>
                    <td><a class="btn btn-primary" href="kecamatan/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">11</th>
                    <td>Kabupaten</td>
                    <td><a class="btn btn-primary" href="kabupaten/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">12</th>
                    <td>Provinsi</td>
                    <td><a class="btn btn-primary" href="provinsi/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">13</th>
                    <td>Metode Pembayaran</td>
                    <td><a class="btn btn-primary" href="metodepembayaran/index.php" role="button">Lihat Tabel</a></td>
                </tr>
                <tr>
                    <th scope="row">14</th>
                    <td>Kritik & Saran</td>
                    <td><a class="btn btn-primary" href="kritiksaran/index.php" role="button">Lihat Tabel</a></td>
                </tr>

            </tbody>
        </table>
    </div>

    <!-- Contact -->
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


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
</body>

</html>