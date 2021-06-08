<?php 

    require '../../function/functions.php';

    // $id = $_GET["id"];
    session_start();
    $kritik = $_GET['id'];
    $data = query("SELECT * FROM review WHERE kritik='$kritik'")[0];
    // var_dump($data);
    $hid = $data['kritik'];

    if(isset($_POST["edit"])){
        if (updateKritikSaran($_POST)>0) {
            echo "
            <script>
                alert('data berhasil diupdate');
                document.location.href = 'kritiksaran.php';
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

    <title>Edit Kritik dan Saran</title>
</head>

<body>

    <!-- Form Login -->
    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h2>Edit Kritik dan Saran</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="POST">
                    <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        value="<?= $hid; ?>" name="kritiklama">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                            style="height: 100px" name="kritik"><?= $data['kritik']; ?></textarea>
                        <label for="floatingTextarea2">Kritik</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control mb-3" placeholder="Leave a comment here" id="floatingTextarea2"
                            style="height: 100px" name="saran"><?= $data['saran']; ?></textarea>
                        <label for="floatingTextarea2">Saran</label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                    <a class="btn btn-outline-primary" href="kritiksaran.php" role="button">Cancel</a>
                </form>
            </div>
        </div>


        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
        </script>
</body>

</html>