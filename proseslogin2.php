<?php
     @ob_start();
  error_reporting(0);
     session_start();
    include('dbConnect.php');
    //include('methodAes.php');
    include ("AES2/AES.php");

    $aes = new AES('abcdefgh01234567', 'CBC', '1234567890abcdef');
    $username = $_POST['username'];
   // $email = $_POST['email'];
    @$pass=$_POST["password"];
    $passs=$aes->encrypt($pass);
$sql = "SELECT * FROM usersadmin WHERE username = '" . $username . "' AND password = '" . $passs . "'";
// $sql = "SELECT * FROM USERSADMIN WHERE USERNAME = '" . $username . "' AND PASSWORD = '" . $passs . "'";
    $result = mysqli_query($connect, $sql);
    $countResult = mysqli_num_rows($result);

    if($result){
        if ($countResult == 1) {
            $row = mysqli_fetch_array($result);
            $tes = $row['username'];
            $tes = $row['email'];
        
                echo ("<META HTTP-EQUIV=\"Refresh\"CONTENT=\"0;URL=dashboard.php\">");
        } else {
        // echo ("<META HTTP-EQUIV=\"Refresh\"CONTENT=\"0;URL=index.php\">");
?>
    <script>
        alert('Maaf username dan password yang di masukkan salah.');
        document.location = "index.php";
    </script>
<?php
        }
   // echo 'ERROR 01';
    }
   // echo 'ERROR 02';
?>
