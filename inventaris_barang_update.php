<?php
session_start();
include "koneksi.php";

$kd = $_POST['kode'];
$nm = strtoupper($_POST['nama']);
$kt = $_POST['ktg'];
$jm = $_POST['jml'];
$st = $_POST['stn'];
$lk = $_POST['lok'];
$kn = $_POST['knd'];
$ss = $_POST['sts'];

$sql = mysqli_query($konek,"UPDATE inv_brg SET nama='$nm',kategori='$kt',jumlah='$jm',satuan='$st',lokasi='$lk',kondisi='$kn',status='$ss' WHERE kode='$kd' ");
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan']='Update Inventaris Barang Berhasil disimpan !!!';
	header("location:inventaris_barang");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:inventaris_barang");
}
?>