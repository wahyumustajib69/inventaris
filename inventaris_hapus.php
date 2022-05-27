<?php
session_start();
include_once "koneksi.php";

$kode = $_GET['id'];
$sql = mysqli_query($konek,"DELETE FROM inv_brg WHERE kode='$kode'");
if($sql){
	$_SESSION['pesan']='Hapus Data Berhasil';
	header("location:inventaris_barang");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:inventaris_barang");
}
?>