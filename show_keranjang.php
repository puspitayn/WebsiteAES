<?php

require_once('dbConnect.php');
if($_SERVER['REQUEST_METHOD']=='POST') {
 
    $ID_CUSTOMER = $_POST['ID_CUSTOMER'];
    
  $sql = "SELECT ID_PEMESANAN, ID_CUSTOMER, GAMBAR_PESAN, JUDUL_PESAN, PENGARANG_PESAN, JUMLAH_PESAN, HARGA_PESAN, TOTAL_PESAN FROM PEMESANAN WHERE ID_CUSTOMER = '$ID_CUSTOMER'";
  
  $res = mysqli_query($connect,$sql);
  $result = array();
  while($row = mysqli_fetch_array($res)){
    array_push($result, array(
    'ID_PEMESANAN'=>$row['ID_PEMESANAN'],
    'ID_CUSTOMER'=>$row['ID_CUSTOMER'],
    'GAMBAR_PESAN'=>$row['GAMBAR_PESAN'],
    'JUDUL_PESAN'=>$row['JUDUL_PESAN'], 
    'PENGARANG_PESAN'=>$row['PENGARANG_PESAN'], 
    'JUMLAH_PESAN'=>$row['JUMLAH_PESAN'], 
    'HARGA_PESAN'=>$row['HARGA_PESAN'],
    'TOTAL_PESAN'=>$row['TOTAL_PESAN']));
  }
  echo json_encode(array("value"=> 1,"result"=>$result));
  mysqli_close($connect);
}