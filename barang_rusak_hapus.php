<?php
session_start();
include_once "koneksi.php";

$id = $_GET['id'];
$sql = "DELETE FROM brg_rusak WHERE id='$id'";
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan']='Hapus Data Berhasil';
	header("location:barang_rusak");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:barang_rusak");
}
?>