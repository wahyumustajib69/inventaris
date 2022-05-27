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

mysqli_query($konek,"UPDATE brg_masuk SET inventaris='SUDAH' WHERE nama='$nm'");
$sql = mysqli_query($konek,"INSERT INTO inv_brg VALUES('$kd','$nm','$kt','$jm','$st','$lk','$kn','$ss')");
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan']='Inventaris Barang Berhasil disimpan !!!';
	header("location:inventaris_barang");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:inventaris_barang");
}
?>