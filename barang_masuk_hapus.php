<?php
session_start();
include_once "koneksi.php";

$id = $_GET['id'];
$sql = "DELETE FROM brg_masuk WHERE no_faktur='$id'";
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan']='Hapus Data Berhasil';
	header("location:barang_masuk");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:barang_masuk");
}
?>