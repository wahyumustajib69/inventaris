<?php
session_start();
include_once "koneksi.php";

$id = $_POST['id'];
$nm = $_POST['nama'];
$st = $_POST['stts'];
$kt = $_POST['ket'];

$sql = "UPDATE ruangan SET nama='$nm',status='$st',ket='$kt' WHERE id='$id'";
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan'] ='Update Data BERHASIL !!';
	header("location:ruangan");
}else{
	$_SESSION['pesan'] ='Terjadi Kesalahan !!';
	header("location:ruangan");
}

?>