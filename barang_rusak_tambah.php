<?php
session_start();
include_once "koneksi.php";

$tg = $_POST['tgl'];
$in = $_POST['inv'];
$nm = $_POST['nama'];
$kt = $_POST['ktg'];
$st = $_POST['stn'];
$jm = $_POST['jml'];
$ke = $_POST['ket'];

mysqli_query($konek,"UPDATE inv_brg SET jumlah=(jumlah-$jm) WHERE kode='$in'");
$sql = "INSERT INTO brg_rusak VALUES ('','$tg','$in','$nm','$kt','$st','$jm','$ke')";
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan']='Simpan Data BERHASIL !!';
	header("location:barang_rusak");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:barang_rusak");
}
?>