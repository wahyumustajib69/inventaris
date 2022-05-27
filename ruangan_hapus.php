<?php
session_start();
include_once "koneksi.php";
$id = $_GET['id'];
$sql = mysqli_query($konek,"DELETE FROM ruangan WHERE id='$id'");
if($sql){
	$_SESSION['pesan']='Hapus Data Berhasil';
	header("location:ruangan");
}else{
	$_SESSION['pesan']='Terjadi Kesalaham';
	header("location:ruangan");
}
?>