<?php 
    session_start();
    if (!isset($_SESSION["login"])) {
      header("Location: login.php");  
    }
    require '../function/functions.php';
    $idData = $_GET["id"];

    if (deleteUser($idData)>0) {
        echo "
                <script>
                    alert('data berhasil dihapus');
                </script>            
            ";
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../auth/login.php");
    }else{
        echo mysqli_error($conn);
    }

?>