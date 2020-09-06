<?php
include 'dbConnect.php';
include ("AES2/AES.php");
// require_once('methodAes.php');
    $mode = $_GET['mode'];
    if ($mode == 'simpanRegistration') {
        $aes = new AES('abcdefgh01234567', 'CBC', '1234567890abcdef');
        //$z="abcdefgh01234567"; //key(kuncinya)
        //$aes=new AES($z);
        @$NAMA_LENGKAP = $_POST['NAMA_LENGKAP'];
        @$ALAMAT_LENGKAP = $_POST['ALAMAT_LENGKAP'];
        @$BAGIAN = $_POST['BAGIAN'];
        @$TELP_ADMIN = $_POST['TELP_ADMIN'];
        @$EMAIL_ADMIN = $_POST['EMAIL_ADMIN'];
        @$USERNAME = $_POST['USERNAME'];
        //$plainUSERNAME=$aes->encrypt($plainUSERNAME);
        @$pass=$_POST["PASSWORD"];
        $passs=$aes->encrypt($pass);
        
        $insert = "INSERT INTO USERSADMIN (NAMA_LENGKAP,ALAMAT_LENGKAP,BAGIAN,TELP_ADMIN,EMAIL_ADMIN,USERNAME,PASSWORD) VALUES ('$NAMA_LENGKAP','$ALAMAT_LENGKAP','$BAGIAN','$TELP_ADMIN','$EMAIL_ADMIN','$USERNAME','$passs')";
        $hsl = mysqli_query($connect, $insert);

    } elseif ($mode == 'deleteRegistration') {
        $ID_ADMIN = $_GET['$ID_ADMIN'];
        echo $delete1 = "delete from USERSADMIN where ID_ADMIN='$ID_ADMIN'";
        echo $dele = mysqli_query($connect, $delete1);
        
    } elseif ($mode == 'updateRegistration') {
        @$ID_ADMIN = $_POST['ID_ADMIN'];
        @$NAMA_LENGKAP = $_POST['NAMA_LENGKAP'];
        @$ALAMAT_LENGKAP = $_POST['ALAMAT_LENGKAP'];
        @$BAGIAN = $_POST['BAGIAN'];
        @$TELP_ADMIN = $_POST['TELP_ADMIN'];
        @$EMAIL_ADMIN = $_POST['EMAIL_ADMIN'];
        @$USERNAME = $_POST['USERNAME'];
        @$PASSWORDhas = $_POST['PASSWORD'];
        
        //$encryptedPasswordUP = base64_encode(openssl_encrypt($PASSWORDhas, $method, $password, OPENSSL_RAW_DATA, $iv));
        //$encryptedPasswordUP = openssl_encrypt($PASSWORDhas, $cipher, $password, $options=0, $iv, $tag);

        $update1 = "UPDATE USERSADMIN SET ID_ADMIN='$ID_ADMIN', NAMA_LENGKAP='$NAMA_LENGKAP',ALAMAT_LENGKAP='$ALAMAT_LENGKAP',BAGIAN='$BAGIAN',TELP_ADMIN='$TELP_ADMIN',EMAIL_ADMIN='$EMAIL_ADMIN', USERNAME='$USERNAME', PASSWORD='$$PASSWORDhas' WHERE ID_ADMIN='$ID_ADMIN'";
        $upa = mysqli_query($connect, $update1);

    } elseif ($mode == 'simpanCustomer') {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $IV = substr(str_shuffle($permitted_chars), 0, 16); 
        echo $IV ;
        
        $start = microtime(true);
        $aes = new AES('abcdefgh01234567', 'CBC', '1234567890abcdef');
        // $z="abcdefgh01234567"; //key(kuncinya)
        // $aes=new AES($z);
        @$ID_CUSTOMER = $_POST['ID_CUSTOMER'];
        @$NM_CUSTOMER = $_POST['NM_CUSTOMER'];
        @$plainALAMAT_CUSTOMER = $_POST['ALAMAT_CUSTOMER'];
        //$encalmt=$aes->encrypt($plainALAMAT_CUSTOMER);
        @$plainTELP_CUSTOMER = $_POST['TELP_CUSTOMER'];
        //$enctlp=$aes->encrypt($plainTELP_CUSTOMER);
        @$plainEMAIL_CUSTOMER = $_POST['EMAIL_CUSTOMER'];
        //$encemail=$aes->encrypt($plainEMAIL_CUSTOMER);
        @$SALDO = $_POST['SALDO'];
        @$plainuser = $_POST['USERNAME_CUSTOMER'];
        $encuserr=$aes->encrypt($plainuser);
        
        @$plainpass=$_POST["PASSWORD_CUSTOMER"];
        $encpass=$aes->encrypt($plainpass);
        $end = microtime(true);
        $time = ($end - $start);
    
        $insert = "INSERT INTO CUSTOMER VALUES ('$ID_CUSTOMER','$NM_CUSTOMER','$plainALAMAT_CUSTOMER','$plainTELP_CUSTOMER','$plainEMAIL_CUSTOMER','$SALDO','$encuserr','$encpass',$time)";
        $hsl = mysqli_query($connect, $insert);
       
    } elseif ($mode == 'updateSaldo') {
        @$ID_CUSTOMER = $_POST['ID_CUSTOMER'];
        @$NM_CUSTOMER = $_POST['NM_CUSTOMER'];
        @$EMAIL_CUSTOMER = $_POST['EMAIL_CUSTOMER'];
        @$SALDO = $_POST['SALDO'];
        @$SALDO_TOP = $_POST['SALDO_TOP'];

        @$UP = $SALDO + $SALDO_TOP;

        // $encryptedPassword = base64_encode(openssl_encrypt($saldoUpHas, $method, $password, OPENSSL_RAW_DATA, $iv));


        $update = "UPDATE CUSTOMER SET ID_CUSTOMER='$ID_CUSTOMER', NM_CUSTOMER='$NM_CUSTOMER', EMAIL_CUSTOMER='$EMAIL_CUSTOMER', SALDO='$UP' WHERE ID_CUSTOMER='$ID_CUSTOMER'";
        $upi = mysqli_query($connect, $update);
        
    }elseif ($mode == 'deleteCustomer') {
        @$ID_CUSTOMER = $_GET['$ID_CUSTOMER'];
       echo $delete221 = "delete from CUSTOMER where ID_CUSTOMER='$ID_CUSTOMER'";
       echo $dele2 = mysqli_query($connect, $delete221);
        
    }elseif ($mode == 'updateCustomer') {
        @$ID_CUSTOMER = $_POST['ID_CUSTOMER'];
        @$NM_CUSTOMER = $_POST['NM_CUSTOMER'];
        @$ALAMAT_CUSTOMER = $_POST['ALAMAT_CUSTOMER'];
        @$TELP_CUSTOMER = $_POST['TELP_CUSTOMER'];
        @$EMAIL_CUSTOMER = $_POST['EMAIL_CUSTOMER'];
        @$SALDO = $_POST['SALDO'];
        @$USERNAME_CUSTOMER = $_POST['USERNAME_CUSTOMER'];
        @$plaintextPasswordUP = $_POST['PASSWORD_CUSTOMER'];
        
        //$encryptedPasswordUPP = base64_encode(openssl_encrypt($plaintextPasswordUP, $method, $password, OPENSSL_RAW_DATA, $iv));
        //$encryptedPasswordUPP = openssl_encrypt($plaintextPasswordUP, $cipher, $password, $options=0, $iv, $tag);

        $update = "UPDATE CUSTOMER SET ID_CUSTOMER='$ID_CUSTOMER', NM_CUSTOMER='$NM_CUSTOMER', ALAMAT_CUSTOMER='$ALAMAT_CUSTOMER', TELP_CUSTOMER='$TELP_CUSTOMER', EMAIL_CUSTOMER='$EMAIL_CUSTOMER', SALDO='$SALDO', USERNAME_CUSTOMER='$USERNAME_CUSTOMER', PASSWORD_CUSTOMER='$plaintextPasswordUP' WHERE ID_CUSTOMER='$ID_CUSTOMER'";
        $up = mysqli_query($connect, $update);

    } elseif ($mode == 'simpanToko') {
        @$ID_TOKO = $_POST['ID_TOKO'];
        @$ID_ADMIN = $_POST['ID_ADMIN'];
        @$NAMA_TOKO = $_POST['NAMA_TOKO'];
        @$NAMA_PEMILIK_TOKO = $_POST['NAMA_PEMILIK_TOKO'];

        $insertToko = "INSERT INTO TOKO VALUES ('$ID_TOKO','$ID_ADMIN','$NAMA_TOKO','$NAMA_PEMILIK_TOKO')";
        $hslToko = mysqli_query($connect, $insertToko);

    } elseif ($mode == 'updateToko') {
        @$ID_TOKO = $_POST['ID_TOKO'];
        @$ID_ADMIN = $_POST['ID_ADMIN'];
        @$NAMA_TOKO = $_POST['NAMA_TOKO'];
        @$NAMA_PEMILIK_TOKO = $_POST['NAMA_PEMILIK_TOKO'];

        $updateToko = "UPDATE TOKO SET ID_TOKO='$ID_TOKO', ID_ADMIN='$ID_ADMIN', NAMA_TOKO='$NAMA_TOKO', NAMA_PEMILIK_TOKO='$NAMA_PEMILIK_TOKO' WHERE ID_TOKO='$ID_TOKO'";
        $upToko = mysqli_query($connect, $updateToko);
    
    } elseif ($mode == 'simpanProduct') {
        @$id_produk = $_POST['id_produk'];
        @$id_admin = $_POST['id_admin'];
        @$judul_produk = $_POST['judul_produk'];
        @$pengarang_produk = $_POST['pengarang_produk'];
        @$jumlah_produk = $_POST['jumlah_produk'];
        @$harga_produk = $_POST['harga_produk'];

        $tipe    = $_FILES['filefoto']['type'];
        if ($tipe == 'image/gif' || $tipe == 'image/png' || $tipe == 'image/jpeg') {

            $ukuran    = $_FILES['filefoto']['size'];
            if ($ukuran < 100000) {
                //buat folder foto
                if (!file_exists("images")) {
                    mkdir("images");
                }
                $asal    = $_FILES['filefoto']['tmp_name'];
                $tujuan    = "images/" . $_FILES['filefoto']['name'];
                // $img_url = "http://hamtaroo.000webhostapp.com/RisetApiProduct/" . $tujuan;
                 $img_url = "http://localhost:82/RISET-PENS-2020/" . $tujuan;
                move_uploaded_file($asal, $tujuan);

                $str = "INSERT INTO product (id,judul,pengarang,harga,jumlah,gambar) VALUES ('$id', '$judul', '$pengarang', '$harga','$jumlah','$img_url')";
                $query = mysqli_query($connect, $str);

                if ($query) {
                    echo "<script>alert('Berhasil')</script>";
                } else {
                    echo "<script>alert('Gagal')</script>";
                }
            } else {
                echo "<script>alert('Gambar terlalu besar')</script>";
            }
        } else {
            echo "<script>alert('Type harus gambar')</script>";
        }
   
    }

    echo ("<META HTTP-EQUIV=\"Refresh\"CONTENT=\"0;URL=dashboard.php\">");

?>