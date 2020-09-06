<?php

if($_SERVER['REQUEST_METHOD']=='POST') {
    
    require_once('AES.php');
    $aes = new AES('abcdefgh01234567', 'CBC', '1234567890abcdef');
    @$hasusername = $_POST['USERNAME_CUSTOMER'];
    $cipheruser=$aes->encrypt($hasusername);
    @$plaintextPassword = $_POST['PASSWORD_CUSTOMER'];
    $cipherpass=$aes->encrypt($plaintextPassword);

$message = "";
$value = false;
$result = array();

require_once('dbConnect.php');

$query = "SELECT * FROM customer WHERE USERNAME_CUSTOMER = '".$cipheruser."' AND PASSWORD_CUSTOMER = '".$cipherpass."'";
$hasil = mysqli_query($connect, $query);
if($hasil){
    
    $data = mysqli_fetch_array($hasil);
    $cek = mysqli_num_rows($hasil);
    if($cek > 0){
               
    $value = true;
    $message = "Login Berhasil";
        $ID_CUSTOMER = $data['ID_CUSTOMER'];
        $NM_CUSTOMER = $data['NM_CUSTOMER'];
        $ALAMAT_CUSTOMER = $data['ALAMAT_CUSTOMER'];
        $TELP_CUSTOMER = $data['TELP_CUSTOMER'];
        $EMAIL_CUSTOMER = $data['EMAIL_CUSTOMER'];
        $SALDO = $data['SALDO'];
    
     array_push($result, array('ID_CUSTOMER'=>$ID_CUSTOMER,'NM_CUSTOMER'=>$NM_CUSTOMER,'ALAMAT_CUSTOMER'=>$ALAMAT_CUSTOMER,'TELP_CUSTOMER'=>$TELP_CUSTOMER, 'EMAIL_CUSTOMER'=>$EMAIL_CUSTOMER, 'SALDO'=>$SALDO));
    }else{
        $value= false;
     $message= "Login Gagal, Coba lagi";
    }
        
    
    
}
    else{
$value= false;
     $message= "Login GAGAL";


        }
        
        
                echo json_encode(array("value" => $value,"message"=>$message,"result"=>$result ));


}
?>