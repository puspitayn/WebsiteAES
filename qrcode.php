<?php
//library phpqrcode
include "phpqrcode/qrlib.php";
include 'dbConnect.php';

//direktory tempat menyimpan hasil generate qrcode jika folder belum dibuat maka secara otomatis akan membuat terlebih dahulu
$tempdir = "temp/"; 
if (!file_exists($tempdir))
    mkdir($tempdir);

?>
<html>
<head>
</head>
<body>
    <div align="center" style="margin-top: 50px;">

        <tbody>
        <?php
            $no = 1;
            $query = "SELECT * FROM produk";
            $arsip1 = $connect->prepare($query);
            $arsip1->execute();
            $res1 = $arsip1->get_result();
            while ($row = $res1->fetch_assoc()) {
                $teks = $row['ID_PRODUK'];

                //Isi dari QRCode Saat discan
                $isi_qr = $teks;
                //Nama file yang akan disimpan pada folder temp 
                $namafile1 = $teks.".png";
                //Kualitas dari QRCode 
                $quality1 = 'H'; 
                //Ukuran besar QRCode
                $ukuran1 = 4; 
                $padding1 = 0; 
                QRCode::png($isi_qr,$tempdir.$namafile1,$quality1,$ukuran1,$padding1);
        ?>
            <tr>
                <td style="padding: 10px;"><img src="temp/<?php echo $namafile1; ?>" width="100px"></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</body>
</html>
<?php mysqli_close($connect); ?>