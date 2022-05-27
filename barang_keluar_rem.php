<?php
session_start();
include "koneksi.php";

$id = $_GET['id'];
$sql = mysqli_query($konek,"DELETE FROM brg_keluar WHERE id='$id'");
if($sql){
	$_SESSION['pesan']='Hapus data BERHASIL !!';
	header("location:barang_keluar");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:barang_keluar");
}
?>