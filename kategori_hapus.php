<?php
session_start();
include "koneksi.php";

$id = $_GET['id'];
$sql = mysqli_query($konek,"DELETE FROM kategori WHERE id='$id'");
if($sql){
	$_SESSION['pesan-ktg']='Hapus Data BERHASIL';
	header("location:kategori");
}else{
	$_SESSION['pesan-ktg']='Terjadi Kesalahan';
	header("location:kategori");
}
?>