<?php
session_start();
include_once "koneksi.php";

$nm = $_POST['nama'];
$st = $_POST['stts'];
$kt = $_POST['ket'];

$sql = "INSERT INTO ruangan VALUES ('','$nm','$st','$kt')";
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan'] ='Simpan Data BERHASIL !!';
	header("location:ruangan");
}else{
	$_SESSION['pesan'] ='Terjadi Kesalahan !!';
	header("location:ruangan");
}

?>