<?php
session_start();
include "koneksi.php";

$nm = $_POST['nama'];
$kt = $_POST['ket'];
$sql = mysqli_query($konek,"INSERT INTO kategori VALUES('','$nm','$kt')");
if($sql){
	$_SESSION['pesan-ktg']='Simpan Data BERHASIL';
	header("location:kategori");
}else{
	$_SESSION['pesan-ktg']='Terjadi Kesalahan';
	header("location:kategori");
}
?>