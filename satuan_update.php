<?php
session_start();
include_once "koneksi.php";

$id = $_POST['id'];
$nm = $_POST['nama'];
$kt = $_POST['ket'];

$sql = "UPDATE satuan SET nama='$nm',ket='$kt' WHERE id='$id'";
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan-st'] ='Update Data BERHASIL !!';
	header("location:kategori");
}else{
	$_SESSION['pesan-st'] ='Terjadi Kesalahan !!';
	header("location:kategori");
}

?>