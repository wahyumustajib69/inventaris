<?php
session_start();
include_once "koneksi.php";

$id = $_GET['id'];
$sql = mysqli_query($konek,"SELECT * FROM brg_keluar WHERE id='$id'");
$tm = mysqli_fetch_assoc($sql);
	$nm = $tm['nm_brg'];
	$jm = $tm['jml'];

mysqli_query($konek,"UPDATE inv_brg SET jumlah=(jumlah+$jm) WHERE nama='$nm'");
$sq = mysqli_query($konek,"UPDATE brg_keluar SET status='KEMBALI' WHERE id='$id'");
if($sq){
	$_SESSION['pesan']='Barang Telah Dikembalikan !!';
	header("location:barang_keluar");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:barang_keluar");
}
?>