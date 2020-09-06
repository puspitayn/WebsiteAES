<?php

if($_SERVER['REQUEST_METHOD']=='POST') {

   $response = array();
   //mendapatkan data
   
   $id_produk = $_POST['id_produk'];
  $ID_CUSTOMER = $_POST['ID_CUSTOMER'];
//   $ID_TOKO = $_POST['ID_TOKO'];

   require_once('dbConnect.php');
   //Cek npm sudah terdaftar apa belum
   
    $sqlGetDataProduk = "SELECT ID_PRODUK,ID_TOKO, JUDUL_PRODUK, PENGARANG_PRODUK, JUMLAH_PRODUK, HARGA_PRODUK, GAMBAR FROM PRODUK WHERE ID_PRODUK = '$id_produk'";
    $cekGetDataProduk = mysqli_query($connect, $sqlGetDataProduk);
    
    $sqlGetDataProdukKeranjang = "SELECT * FROM PEMESANAN WHERE ID_PRODUK = '$id_produk'";
    $cekGetDataProdukKeranjang = mysqli_query($connect, $sqlGetDataProdukKeranjang);
    
   if ($cekGetDataProduk){
       $row = mysqli_fetch_array($cekGetDataProduk);
       
        @$ID_TOKO = $row['ID_TOKO'];       
        @$JUDUL_PESAN = $row['JUDUL_PRODUK']; 
        @$PENGARANG_PESAN = $row['PENGARANG_PRODUK'];
        @$JUMLAH_PESAN = $row['JUMLAH_PRODUK'];
        @$HARGA_PESAN = $row['HARGA_PRODUK'];
        @$GAMBAR_PESAN = $row['GAMBAR'];
        // @$TOTAL_PESAN = $row['TOTAL_PESAN'];
        

    //     if(isset($cekGetDataProduk)){
    //         $response["value"] = 1;
    //         $response["message"] =  "Sudah ada dalam di dalam keranjang, Silahkan edit di menu keranjang!";
    //         echo json_encode($response);
            

         
    //   } 
    if(isset($cekGetDataProduk)) {
            $sql = "INSERT INTO PEMESANAN (ID_PEMESANAN,ID_CUSTOMER,ID_TOKO,GAMBAR_PESAN,JUDUL_PESAN,PENGARANG_PESAN,JUMLAH_PESAN,HARGA_PESAN) VALUES (NULL,'$ID_CUSTOMER','$ID_TOKO','$GAMBAR_PESAN','$JUDUL_PESAN','$PENGARANG_PESAN',0,'$HARGA_PESAN')";
       
            if(mysqli_query($connect,$sql)) {
                $response["value"] = 1;
                $response["message"] = "Berhasil ditambah ke keranjang!";
                echo json_encode($response);
            
                
            } else {
                $response["value"] = 0;
                $response["message"] = $sql;
                echo json_encode($response);
            
            }
         
        }
       
    }
   
   
   
   
   
   
  
     
     
   }
   // tutup database
   mysqli_close($connect);
