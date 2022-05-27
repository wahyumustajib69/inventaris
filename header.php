<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login");
}
function tgl_ind($tanggal){
        $bulan = array(
        1=>'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
  $pecah = explode("-", $tanggal);
  return $pecah[2].' '.$bulan[(int)$pecah[1]].' '.$pecah[0];
}
?>
<?php
function duit($nilai){
    return number_format ($nilai, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>INVENTARIS BARANG BKKBN</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> 
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="icon" type="icon" href="fpdf/logo.png">
    <style>
        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
        }
        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
        }
        .autocomplete-selected {
            background: #F0F0F0;
            cursor: pointer;
        }
        .autocomplete-suggestions strong {
            font-weight: bold;
            color: red;
        }
        .autocomplete-group {
            padding: 2px 5px;
        }
        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
        }
    </style> 
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home"><img src="fpdf/logo_menu.png" style="width: 130px; height: 60px; margin-top: -13px;"></a>
            </div>

        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
		<div id="sideNav" href=""><i class="fa fa-caret-right"></i></div>
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a class="" href="home"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a class="" href="ruangan"><i class="fa fa-home"></i> Ruangan</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-desktop"></i> Menu Inventaris<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="inventaris_barang"><i class="fa fa-laptop"></i> Barang</a>
                            </li>
                            <li>
                                <a href="kategori"><i class="fa fa-list"></i> Kategori & Satuan</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="barang_masuk?bln=ALL"><i class="fa fa-truck"></i> Barang Masuk</a>
                    </li>
                    <li>
                        <a href="barang_keluar?bln=ALL"><i class="fa fa-share"></i> Barang Keluar</a>
                    </li>
                    <li>
                        <a href="barang_rusak?bln=ALL"><i class="fa fa-flash"></i> Barang Rusak</a>
                    </li>
                    <li>
                        <a href="logout" onclick="return confirm('Apakah Anda Yakin???')"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </nav>