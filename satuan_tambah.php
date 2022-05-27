<?php
session_start();
include "koneksi.php";

$nm = $_POST['nama'];
$kt = $_POST['ket'];
$sql = mysqli_query($konek,"INSERT INTO satuan VALUES('','$nm','$kt')");
if($sql){
	$_SESSION['pesan-st']='Simpan Data BERHASIL';
	header("location:kategori");
}else{
	$_SESSION['pesan-st']='Terjadi Kesalahan';
	header("location:kategori");
}
?>