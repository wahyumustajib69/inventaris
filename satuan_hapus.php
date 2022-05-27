<?php
session_start();
include "koneksi.php";

$id = $_GET['id'];
$sql = mysqli_query($konek,"DELETE FROM satuan WHERE id='$id'");
if($sql){
	$_SESSION['pesan-st']='Hapus Data BERHASIL';
	header("location:kategori");
}else{
	$_SESSION['pesan-st']='Terjadi Kesalahan';
	header("location:kategori");
}
?>