<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include 'dbConnect.php';
// Load Composer's autoloader
require 'vendor/autoload.php';
//$mode = $_GET['mode'];
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$id_cust = $_GET['id'];
$kueri = "SELECT ID_CUSTOMER,NM_CUSTOMER, EMAIL_CUSTOMER FROM CUSTOMER WHERE ID_CUSTOMER='$id_cust' ";
$hasil = mysqli_query($connect, $kueri);
$data = mysqli_fetch_array($hasil);
    $email=$data['EMAIL_CUSTOMER'];
    $nama=$data['NM_CUSTOMER'];
    

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'puspitayun@gmail.com';                     // SMTP username
    $mail->Password   = 'irfanramadhan11';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('puspitayun@gmail.com', 'Puspita Admin Bazaar');
    $mail->addAddress($email, $nama);     // Add a recipient
    $mail->addAddress($email);        
           // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Pengembalian Dana Acara';
    $mail->Body    = 'Anda masih memiliki sisa dana pada akun Bazaar hari ini. Untuk melakukan pengembalian sisa dana pada acara yang telah dilangsungkan hari ini silahkan hubungi panitia acara untuk mendapatkan info lebih lanjut.';

  if($mail->Send()){
        echo"<script>alert('Email berhasil dikirim');document.location='customers-users.php'</script>";
    }
    else{
        echo"<script>alert('Error !!');document.location='customers-users'</script>";
    }
    
    } catch(Exception $e){
        // Something went bad
        echo "Fail :( : {$mail->ErrorInfo}";
    }
    ?>
/*
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}