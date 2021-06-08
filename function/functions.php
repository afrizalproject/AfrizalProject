<?php 
    // koneksi
    $conn = mysqli_connect("localhost","root","1234","afrizalproject");

    // register
    function registrasi($data){
        global $conn;
        // huruf kecil + hilangkan slash / atau \
        $namaLengkap = strtolower(stripslashes( $data["namaLengkap"]));
        $username = strtolower(stripslashes( $data["username"]));
        $email = strtolower(stripslashes( $data["email"])); 
        $notelp = strtolower(stripslashes( $data["notelp"]));
        $alamat = strtolower(stripslashes( $data["alamat"]));
        $role = strtolower(stripslashes( $data["role"]));
        $password = mysqli_real_escape_string($conn,$data["password"]);
    
        // cek username sudah ada/belum
        $result=mysqli_query($conn,"SELECT email FROM users WHERE email='$email'");
        $result2=mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");
        if (mysqli_fetch_assoc($result)) {
            echo "
            <script>
                alert('email sudah digunakan oleh user lain');
                // document.location.href = 'index.php';
            </script>            
        ";
        return false;
        }  else if (mysqli_fetch_assoc($result2)) {
            echo "
            <script>
                alert('username sudah digunakan oleh user lain');
                // document.location.href = 'index.php';
            </script>            
        ";
        return false;
        }else if (strlen($password) < 8) {
            echo "
            <script>
                alert('panjang password minimal 8 karakter');
            </script>            
        ";
        return false;
        }
    
        // insert ke database
        mysqli_query($conn,"INSERT INTO users (namaLengkap,username,email,notelp,alamat,role,password) VALUES
         ('$namaLengkap','$username','$email','$notelp','$alamat','$role','$password')");
        return mysqli_affected_rows($conn);
    }


    // display
    function query($querysql){
        global $conn;
        $result = mysqli_query($conn,$querysql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }


    // hapus
    function deleteUser($id){
        global $conn;
        $sql = "DELETE FROM users WHERE id='$id'";
        mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

    // edit user
    function updateUser($data){
        global $conn;
        $id = $_GET["id"];
        $namaLengkap = strtolower(stripslashes( $data["namaLengkap"]));
        $username = strtolower(stripslashes( $data["username"]));
        $email = strtolower(stripslashes( $data["email"])); 
        $notelp = strtolower(stripslashes( $data["notelp"]));
        $alamat = strtolower(stripslashes( $data["alamat"]));
        $password = mysqli_real_escape_string($conn,$data["password"]);

        $sql = "UPDATE users SET 
                namaLengkap='$namaLengkap',
                username='$username',
                email='$email',
                notelp='$notelp',
                alamat='$alamat',
                password='$password'        
                WHERE id=$id";
    
        mysqli_query($conn,$sql);
    
        return mysqli_affected_rows($conn);
    
    }

            // tambah paket
    function tambahPaket($data){
        $namapaket = $data["namapaket"];
        $hargapaket = $data["hargapaket"];
        global $conn;
                    // cek username sudah ada/belum
                    $result=mysqli_query($conn,"SELECT namapaket FROM paket WHERE namapaket='$namapaket'");
                    if (mysqli_fetch_assoc($result)) {
                        echo "
                        <script>
                            alert('nama paket sudah ada');
                            // document.location.href = 'index.php';
                        </script>            
                    ";
                    return false;
                    }   
        $sql = "INSERT INTO paket (namapaket,hargapaket) VALUES ('$namapaket',$hargapaket)";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

        // hapus paket
        function deletePaket($id){
            global $conn;
            $sql = "DELETE FROM paket WHERE idpaket=$id";
            mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        // edit paket
        function updatePaket($data){
            global $conn;
            $id = $data["idpaket"];
            $namapaket = strtolower(stripslashes( $data["namapaket"]));
            $hargapaket = strtolower(stripslashes( $data["hargapaket"]));
    
  
    
            $sql = "UPDATE paket SET 
                    namapaket='$namapaket',
                    hargapaket='$hargapaket'      
                    WHERE idpaket=$id";
        
            mysqli_query($conn,$sql);
        
            return mysqli_affected_rows($conn);
        
        }

        // tambah durasi
    function tambahDurasi($data){
        $durasiacara = $data["durasiacara"];
        global $conn;
        $result=mysqli_query($conn,"SELECT durasiacara FROM durasiacara WHERE durasiacara='$durasiacara'");
        if (mysqli_fetch_assoc($result)) {
            echo "
            <script>
                alert('durasi acara yang anda masukkan sudah ada');
                // document.location.href = 'index.php';
            </script>            
        ";
        return false;
        } 
        $sql = "INSERT INTO durasiacara (durasiacara) VALUES ('$durasiacara')";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

        // hapus durasi
        function deleteDurasi($id){
            global $conn;
            $sql = "DELETE FROM durasiacara WHERE iddurasiacara=$id";
            mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        // edit durasi
        function updateDurasi($data){
            global $conn;
            $id = $data["iddurasiacara"];
            $durasiacara = $data["durasiacara"];
    
            $sql = "UPDATE durasiacara SET 
                    durasiacara='$durasiacara'     
                    WHERE iddurasiacara=$id";
        
            mysqli_query($conn,$sql);
        
            return mysqli_affected_rows($conn);
        
        }


                // tambah layanan
    function tambahLayanan($data){
        $layanan = $data["namaLayanan"];
        global $conn;
                    // cek username sudah ada/belum
                    $result=mysqli_query($conn,"SELECT namaLayanan FROM layanantambahan WHERE namaLayanan='$layanan'");
                    if (mysqli_fetch_assoc($result)) {
                        echo "
                        <script>
                            alert('layanan yang anda masukkan sudah ada');
                            // document.location.href = 'index.php';
                        </script>            
                    ";
                    return false;
                    } 
        $sql = "INSERT INTO layanantambahan (namaLayanan) VALUES ('$layanan')";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

        // hapus layanan
        function deleteLayanan($id){
            global $conn;
            $sql = "DELETE FROM layanantambahan WHERE id_layanantambahan=$id";
            mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        // edit layanan
        function updateLayanan($data){
            global $conn;
            $id = $data["id_layanantambahan"];
            $layanan = $data["namaLayanan"];
    
    
    
            $sql = "UPDATE layanantambahan SET 
                    namaLayanan='$layanan'     
                    WHERE id_layanantambahan=$id";
        
            mysqli_query($conn,$sql);
        
            return mysqli_affected_rows($conn);
        
        }


                        // tambah promo
    function tambahPromo($data){
        $promo = $data["namaPromo"];
        global $conn;
        $result=mysqli_query($conn,"SELECT namaPromo FROM promo WHERE namaPromo='$promo'");
        if (mysqli_fetch_assoc($result)) {
            echo "
            <script>
                alert('promo yang anda masukkan sudah ada');
                // document.location.href = 'index.php';
            </script>            
        ";
        return false;
        }  
        $sql = "INSERT INTO promo (namaPromo) VALUES ('$promo')";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

        // hapus promo
        function deletePromo($id){
            global $conn;
            $sql = "DELETE FROM promo WHERE idpromo=$id";
            mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        // edit promo
        function updatePromo($data){
            global $conn;
            $id = $data["idpromo"];
            $promo = $data["namaPromo"];
    
            // cek username sudah ada/belum
   
    
            $sql = "UPDATE promo SET 
                    namaPromo='$promo'     
                    WHERE idpromo=$id";
        
            mysqli_query($conn,$sql);
        
            return mysqli_affected_rows($conn);
        
        }


                                // tambah promo
    function tambahDusun($data){
        $dusun = $data["namaDusun"];
        global $conn;
                    // cek username sudah ada/belum
                    $result=mysqli_query($conn,"SELECT namaDusun FROM dusun WHERE namaDusun='$dusun'");
                    if (mysqli_fetch_assoc($result)) {
                        echo "
                        <script>
                            alert('nama dusun yang anda masukkan sudah ada');
                            // document.location.href = 'index.php';
                        </script>            
                    ";
                    return false;
                    } 
        $sql = "INSERT INTO dusun (namaDusun) VALUES ('$dusun')";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

        // hapus dusun
        function deleteDusun($id){
            global $conn;
            $sql = "DELETE FROM dusun WHERE iddusun=$id";
            mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        // edit dusun
        function updateDusun($data){
            global $conn;
            $id = $data["iddusun"];
            $dusun = $data["namaDusun"];
    
    
    
            $sql = "UPDATE dusun SET 
                    namaDusun='$dusun'     
                    WHERE iddusun=$id";
        
            mysqli_query($conn,$sql);
        
            return mysqli_affected_rows($conn);
        
        }


        // tambah desa
    function tambahDesa($data){
        $desa = $data["namaDesa"];
        global $conn;
                    // cek username sudah ada/belum
                    $result=mysqli_query($conn,"SELECT namaDesa FROM desa WHERE namaDesa='$desa'");
                    if (mysqli_fetch_assoc($result)) {
                        echo "
                        <script>
                            alert('nama desa yang anda masukkan sudah ada');
                            // document.location.href = 'index.php';
                        </script>            
                    ";
                    return false;
                    } 
        $sql = "INSERT INTO desa (namaDesa) VALUES ('$desa')";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

        // hapus desa
        function deleteDesa($id){
            global $conn;
            $sql = "DELETE FROM desa WHERE idDesa=$id";
            mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        // edit desa
        function updateDesa($data){
            global $conn;
            $id = $data["iddesa"];
            $desa = $data["namaDesa"];
    
    
    
            $sql = "UPDATE desa SET 
                    namaDesa='$desa'     
                    WHERE iddesa=$id";
        
            mysqli_query($conn,$sql);
        
            return mysqli_affected_rows($conn);
        
        }



        // tambah kec
    function tambahKecamatan($data){
        $kecamatan = $data["namaKecamatan"];
        global $conn;
                    // cek username sudah ada/belum
                    $result=mysqli_query($conn,"SELECT namaKecamatan FROM kecamatan WHERE namaKecamatan='$kecamatan'");
                    if (mysqli_fetch_assoc($result)) {
                        echo "
                        <script>
                            alert('nama kecamatan yang anda masukkan sudah ada');
                            // document.location.href = 'index.php';
                        </script>            
                    ";
                    return false;
                    }  
        $sql = "INSERT INTO kecamatan (namaKecamatan) VALUES ('$kecamatan')";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

        // hapus kec
        function deleteKecamatan($id){
            global $conn;
            $sql = "DELETE FROM kecamatan WHERE idkecamatan=$id";
            mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        // edit kec
        function updateKecamatan($data){
            global $conn;
            $id = $data["idkecamatan"];
            $kecamatan = $data["namaKecamatan"];
    
   
    
            $sql = "UPDATE kecamatan SET 
                    namaKecamatan='$kecamatan'     
                    WHERE idkecamatan=$id";
        
            mysqli_query($conn,$sql);
        
            return mysqli_affected_rows($conn);
        
        }




                // tambah kab
    function tambahKabupaten($data){
        $kabupaten = $data["namaKabupaten"];
        global $conn;
                    // cek username sudah ada/belum
                    $result=mysqli_query($conn,"SELECT namaKabupaten FROM kabupaten WHERE namaKabupaten='$kabupaten'");
                    if (mysqli_fetch_assoc($result)) {
                        echo "
                        <script>
                            alert('nama kabupaten yang anda masukkan sudah ada');
                            // document.location.href = 'index.php';
                        </script>            
                    ";
                    return false;
                    }    
        $sql = "INSERT INTO kabupaten (namaKabupaten) VALUES ('$kabupaten')";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

        // hapus kab
        function deleteKabupaten($id){
            global $conn;
            $sql = "DELETE FROM kabupaten WHERE idkabupaten=$id";
            mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        // edit kab
        function updateKabupaten($data){
            global $conn;
            $id = $data["idkabupaten"];
            $kabupaten = $data["namaKabupaten"];
    
 
    
            $sql = "UPDATE kabupaten SET 
                    namaKabupaten='$kabupaten'     
                    WHERE idkabupaten=$id";
        
            mysqli_query($conn,$sql);
        
            return mysqli_affected_rows($conn);
        
        }




        // tambah prov
    function tambahProvinsi($data){
        $provinsi = $data["namaProvinsi"];
        global $conn;
                    // cek username sudah ada/belum
                    $result=mysqli_query($conn,"SELECT namaProvinsi FROM provinsi WHERE namaProvinsi='$provinsi'");
                    if (mysqli_fetch_assoc($result)) {
                        echo "
                        <script>
                            alert('nama provinsi yang anda masukkan sudah ada');
                            // document.location.href = 'index.php';
                        </script>            
                    ";
                    return false;
                    }  
        $sql = "INSERT INTO provinsi (namaProvinsi) VALUES ('$provinsi')";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

        // hapus prov
        function deleteProvinsi($id){
            global $conn;
            $sql = "DELETE FROM provinsi WHERE idprovinsi=$id";
            mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        // edit prov
        function updateProvinsi($data){
            global $conn;
            $id = $data["idprovinsi"];
            $provinsi = $data["namaProvinsi"];
    
   
    
            $sql = "UPDATE provinsi SET 
                    namaProvinsi='$provinsi'     
                    WHERE idprovinsi=$id";
        
            mysqli_query($conn,$sql);
        
            return mysqli_affected_rows($conn);
        
        }



        // tambah metode 
    function tambahMetodePembayaran($data){
        $metodepembayaran = $data["namametodepembayaran"];
        global $conn;
                    // cek username sudah ada/belum
                    $result=mysqli_query($conn,"SELECT namametodepembayaran FROM metodepembayaran WHERE namametodepembayaran='$metodepembayaran'");
                    if (mysqli_fetch_assoc($result)) {
                        echo "
                        <script>
                            alert('nama metode pembayaran yang anda masukkan sudah ada');
                            // document.location.href = 'index.php';
                        </script>            
                    ";
                    return false;
                    } 
        $sql = "INSERT INTO metodepembayaran (namametodepembayaran) VALUES ('$metodepembayaran')";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

        // hapus metode
        function deletemetodepembayaran($id){
            global $conn;
            $sql = "DELETE FROM metodepembayaran WHERE idmetodepembayaran=$id";
            mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        // edit metode
        function updatemetodepembayaran($data){
            global $conn;
            $id = $data["idmetodepembayaran"];
            $metodepembayaran = $data["namametodepembayaran"];
    
    
    
            $sql = "UPDATE metodepembayaran SET 
                    namametodepembayaran='$metodepembayaran'     
                    WHERE idmetodepembayaran=$id";
        
            mysqli_query($conn,$sql);
        
            return mysqli_affected_rows($conn);
        
        }


    // tambah krisar
    function tambahKritikSaran($data){
        $idkrisar = $data["id"];
        $kritik = $data["kritik"];
        $saran = $data["saran"];
        global $conn;
        $sql = "INSERT INTO review (id,kritik,saran) VALUES ($idkrisar,'$kritik','$saran')";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }

    function updateKritikSaran($data){
        $kritiklama = $data['kritiklama'];
        $kritik = $data["kritik"];
        $saran = $data["saran"];
        global $conn;
        $sql = "UPDATE review set kritik='$kritik',saran='$saran' WHERE kritik='$kritiklama'";
        $result = mysqli_query($conn,$sql);
        return mysqli_affected_rows($conn);
    }


        // hapus krisar
        function deleteKritikSarann($kritik){
            global $conn;
            $sql = "DELETE FROM review WHERE kritik='$kritik'";
            mysqli_query($conn,$sql);
                return mysqli_affected_rows($conn);
         }

         function tambahPelaksanaan($data){
            $iduser = $data["id"];
            $iddusun = $data["dusun"];
            $iddesa = $data["desa"];
            $idkecamatan = $data["kecamatan"];
            $idkabupaten = $data["kabupaten"];
            $idprovinsi = $data["provinsi"];

            global $conn;
            $sql = "INSERT INTO pelaksanaan (id,iddusun,iddesa,idkecamatan,idkabupaten,idprovinsi) VALUES ($iduser,$iddusun,$iddesa,$idkecamatan,$idkabupaten,$idprovinsi)";
            $result = mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        function editPelaksanaan($data){
            $idpelaksanaan = $data["id"];
            $iddusun = $data["dusun"];
            $iddesa = $data["desa"];
            $idkecamatan = $data["kecamatan"];
            $idkabupaten = $data["kabupaten"];
            $idprovinsi = $data["provinsi"];

            global $conn;
            $sql = "UPDATE pelaksanaan SET iddusun=$iddusun,iddesa=$iddesa,idkecamatan=$idkecamatan,
            idkabupaten=$idkabupaten,idprovinsi=$idprovinsi WHERE idpelaksanaan=$idpelaksanaan";
            $result = mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }


        function tambahpesanan($data){
            $iduser = $data["id"];
            $idpelaksanaan = $data['idpelaksanaan'];
            $idpaket = $data["paket"];
            $idlayanan = $data["layanan"];
            $iddurasiacara = $data["durasiacara"];
            $idpromo = $data["promo"];
            $keterangan = $data["keterangan"];

            global $conn;
            $sql = "INSERT INTO pesanan (idpelaksanaan,id,idpaket,id_layanantambahan,iddurasiacara,idpromo,keterangan) VALUES ($idpelaksanaan,$iduser,$idpaket,$idlayanan,$iddurasiacara,$idpromo,'$keterangan')";
            $result = mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }


        function editpesanan($data){
            $id = $data["id"];
            $idpaket = $data["paket"];
            $idlayanan = $data["layanan"];
            $iddurasiacara = $data["durasiacara"];
            $idpromo = $data["promo"];
            $keterangan = $data["keterangan"];

            global $conn;
            $sql = "UPDATE pesanan SET idpaket=$idpaket,id_layanantambahan=$idlayanan,iddurasiacara=$iddurasiacara,idpromo=$idpromo,keterangan='$keterangan' WHERE idpesanan=$id";
            $result = mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        function deletepesanan($idpesanan){
            global $conn;
            $sql = "DELETE FROM pesanan WHERE idpesanan=$idpesanan";
            mysqli_query($conn,$sql);
                return mysqli_affected_rows($conn);
         }

         function tambahpembayaran($data){
            $idpesanan = $data["idpesanan"];
            $iduser = $data["id"];
            $metodepembayaran = $data["metodepembayaran"];
            $hargatotal = $data["harga"];

            global $conn;
            $sql = "INSERT INTO pembayaran (idpesanan,id,idmetodepembayaran,hargatotal) VALUES ($idpesanan,$iduser,'$metodepembayaran','$hargatotal')";
            $result = mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        function editpembayaran($data){
            $id = $data["id"];
            $metodepembayaran = $data["metodepembayaran"];
            $hargatotal = $data["harga"];

            global $conn;
            $sql = "UPDATE pembayaran SET idmetodepembayaran=$metodepembayaran,hargatotal=$hargatotal WHERE idpembayaran=$id";
            $result = mysqli_query($conn,$sql);
            return mysqli_affected_rows($conn);
        }

        function deletepembayaran($pembayaran){
            global $conn;
            $sql = "DELETE FROM pembayaran WHERE idpembayaran=$pembayaran";
            mysqli_query($conn,$sql);
                return mysqli_affected_rows($conn);
         }

         function deletepelaksanaan($pelaksanaan){
            global $conn;
            $sql = "DELETE FROM pelaksanaan WHERE idpelaksanaan=$pelaksanaan";
            mysqli_query($conn,$sql);
                return mysqli_affected_rows($conn);
         }

         function deletebuktipembayaran($id){
            global $conn;
            $sql = "DELETE FROM buktipembayaran WHERE idbuktipembayaran=$id";
            mysqli_query($conn,$sql);
                return mysqli_affected_rows($conn);
         }

         function deleteportofolio($id){
            global $conn;
            $sql = "DELETE FROM portofolio WHERE idportofolio=$id";
            mysqli_query($conn,$sql);
                return mysqli_affected_rows($conn);
         }
?>