<?php 
    session_start();
    if (!isset($_SESSION["login"])) {
      header("Location: login.php");  
    }
    require '../../function/functions.php';
    $idData = $_GET["id"];

    if (deleteKecamatan($idData)>0) {
        echo "
                <script>
                    alert('data berhasil dihapus');
                </script>            
            ";
        header("Location: index.php");
    }else{
        echo mysqli_error($conn);
    }

?>