<?php
 include ("AES2/AES.php");

 $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $IV = substr(str_shuffle($permitted_chars), 0, 16);
 echo $IV; 
  $aes = new AES('abcdefghi1234567', 'ECB');
  $encrIV=$aes->encrypt($IV);
 $encIV = base64_encode($encrIV);
 echo "\n\n Hasil enkrip:\n" ,($encIV),"\n";

 $aes = new AES('abcdefghi1234567', 'ECB');
 $enc1IV = base64_decode($encIV);
 echo $enc1IV;
 $encr1IV=$aes->decrypt($enc1IV);
 echo "\n\n Hasil dekrip:\n",stripslashes($encr1IV),"\n";

?>