<?php
session_start();
include_once "koneksi.php";

$tg = $_POST['tgl'];
$nm = $_POST['nm_brg'];
$jm = $_POST['jml'];
$st = $_POST['stts'];
$kt = $_POST['ket'];

mysqli_query($konek,"UPDATE inv_brg SET jumlah=(jumlah-$jm) WHERE nama='$nm'");
$sql = "INSERT INTO brg_keluar VALUES ('','$tg','$nm','$jm','$st','$kt')";
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan']='Simpan Data BERHASIL !!';
	header("location:barang_keluar");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:barang_keluar");
}
?>