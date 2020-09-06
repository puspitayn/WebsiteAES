<?php

//define('HOST','localhost');
//define('USER','root');
//define('PASS','');
//define('DB1', 'databasenew');
 
//$db1 = new mysqli(HOST, USER, PASS, DB1);

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'databasenew';

$connect = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connect->connect_error) {
    die('Maaf Gagal:' . $connect->connect_error);
}

/*
 $dbhost = 'localhost';
 $dbuser = 'root';
 $dbpass = '123456789';
 $dbname = 'DATABASENEW';

 $connect = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
 if ($connect->connect_error) {
     die('Maaf Gagal:' . $connect->connect_error);
 }
*/