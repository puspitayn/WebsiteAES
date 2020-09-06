<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<?php
// error_reporting(0);
// session_start();
include 'dbConnect.php'
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Administrator</h3><!-- /.menu-title -->
                    <li>
                        <a href="administrator-users.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-id-card-o"></i>Users</a>
                        <a href="product.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Product</a>
                        <a href="toko.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Toko</a>
                        <a href="report-data-penjualan.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-pie-chart"></i>Report</a>
                    </li>
                    <h3 class="menu-title">Transaction</h3><!-- /.menu-title -->
                    <li>
                        <a href="customers-users.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-id-card-o"></i>Customers</a>
                        <!-- <a href="topUp.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Top up</a> -->
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <!-- <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </div> -->
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="index.php"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <!-- <h1>Dashboard</h1> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Penjualan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                       
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Penjualan</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>

                                            <th><center>Toko ID</center></th>
                                            <th><center>Nama Toko</center></th>
                                            <th><center>Pemilik Toko</center></th>
                                            <th><center>Nama Pembeli</center></th>
                                            <th><center>Judul Produk</center></th>
                                            <th><center>Pengarang</center></th>
                                            <th><center>Jumlah Pembeliaan</center></th>
                                            <th><center>Total Pembelian</center></th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $tampil = "select id_customer,nm_customer,alamat_customer,telp_customer,email_customer,
                                        // SUBSTRING(saldo, -10) as saldoHas,SUBSTRING(username_customer, -10) as usernameHas,SUBSTRING(password_customer, -10) as passHas
                                        // from customer";
                                        $tampil = "SELECT TK.ID_TOKO as idToko, TK.NAMA_TOKO as namaToko, TK.NAMA_PEMILIK_TOKO as pemilikToko, CR.NM_CUSTOMER as namaCustomer, PM.JUDUL_PESAN as judul, PM.PENGARANG_PESAN as pengarang, PM.JUMLAH_PESAN as jumlah, PM.TOTAL_PESAN as total
                                                FROM PEMESANAN PM JOIN CUSTOMER CR ON CR.ID_CUSTOMER = PM.ID_CUSTOMER JOIN TOKO TK ON TK.ID_TOKO = PM.ID_TOKO";
                                        $hasil = mysqli_query($connect, $tampil);
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($hasil)) {
                                        ?>
                                            <tr>
                                                 <td scope="col" >
                                                    <center>
                                                        <?php echo $data['idToko']; ?>
                                                    </center>
                                                </td>
                                                <td scope="col" >
                                                    <center>
                                                        <?php echo $data['namaToko']; ?>
                                                    </center>
                                                </td>
                                                <td scope="col">
                                                    <center>
                                                        <?php echo $data['pemilikToko']; ?>
                                                    </center>
                                                </td>
                                                <td scope="col">
                                                    <center>
                                                        <?php echo $data['namaCustomer']; ?>
                                                    </center>
                                                </td>
                                                <td scope="col">
                                                    <center>
                                                        <?php echo $data['judul']; ?>
                                                    </center>
                                                </td>
                                                <td scope="col">
                                                    <center>
                                                        <?php echo $data['pengarang']; ?>
                                                    </center>
                                                </td>
                                                <!-- <td scope="col">
                                                    <center>
                                                        <?php //echo $data['saldoHas']; 
                                                        ?>
                                                    </center>
                                                </td> -->
                                                <td scope="col">
                                                    <center>
                                                        <?php echo $data['jumlah']; ?>
                                                    </center>
                                                </td>
                                                <td scope="col">
                                                    <center>
                                                        <?php echo $data['total']; ?>
                                                    </center>
                                                </td>
                                

                                                <!--<td>-->
                                                <!--    <center>-->
                                                <!--        <a href="update-customer.php?id=<?php //echo $data['ID_CUSTOMER']; ?>">-->
                                                <!--            <button type="submit" class="btn btn-warning btn-sm" name="aksi">-->
                                                <!--                <i class="fa fa-dot-circle-o"></i> Edit-->
                                                <!--            </button>-->
                                                <!--        </a>-->
                                                <!--        <a href="deleteCustomer.php?id=<?php// echo $data['ID_CUSTOMER']; ?>">-->
                                                <!--            <button type="submit" class="btn btn-danger btn-sm" name="aksi">-->
                                                <!--                <i class="fa fa-dot-circle-o"></i> Delete-->
                                                <!--            </button>-->
                                                <!--        </a>-->
                                                <!--    </center>-->
                                                <!--</td>-->
                                            </tr>
                                        <?php $no++;
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>


</body>

</html>