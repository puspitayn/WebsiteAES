<?php
    
    // require_once('methodAes.php');
    include ("AES/AES.class.php");
    $z="abcdefgh01234567"; //key(kuncinya)
    $aes=new AES($z);
    $enkrip=$aes->encrypt('puspita');
    echo "\n\n Hasil enkrip:\n" ,($enkrip),"\n";
    //$passfromDB = $_POST['passwordAes'];
//    $decrypted=$aes->decrypt('Åe.p2ÙáhÔ÷ð³Mø');
$decrypted=$aes->decrypt($enkrip); 
echo $decrypted;
// if($decrypted != false){
//     $decString = $decrypted;
//     $stringType =  "Deskripsi Berhasil";
//      echo json_encode(array("status" => true, "AES" => $passfromDB, "DESC" => $decString,"String"=>$stringType ));

// } else {
//          echo json_encode(array("status" => $decrypted, "AES" => $passfromDB));
//}

?>