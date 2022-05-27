<?php
session_start();
include_once "koneksi.php";

$id = $_POST['id'];
$tg = $_POST['tgl'];
$nm = $_POST['nm_brg'];
$jm = $_POST['jml'];
$jl = $_POST['jm'];
$st = $_POST['stts'];
$kt = $_POST['ket'];

mysqli_query($konek,"UPDATE inv_brg SET jumlah=(jumlah+$jl)-$jm WHERE nama='$nm'");
$sql = "UPDATE brg_keluar SET tgl='$tg',nm_brg='$nm',jml='$jm',status='$st',ket='$kt' WHERE id='$id'";
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan']='Update Data BERHASIL !!';
	header("location:barang_keluar");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:barang_keluar");
}
?>