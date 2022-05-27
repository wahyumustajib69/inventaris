<?php
session_start();
include_once "koneksi.php";

$fk = $_POST['fak'];
$tg = $_POST['tgl'];
$nm = strtoupper($_POST['nama']);
$as = $_POST['asl'];
$jm = $_POST['jml'];
$hg = $_POST['hrg'];
$tl = $jm*$hg;
$kt = $_POST['ktg'];
$ke = $_POST['ket'];

$sql = "INSERT INTO brg_masuk VALUES('$fk','$tg','$nm','$as','$jm','$hg','$tl','$kt','$ke','BELUM')";
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan']='Simpan Data BERHASIL !!!';
	header("location:barang_masuk");
}else{
	$_SESSION['pesan']='Terjad Kesalahan !!!';
	header("location:barang_masuk");
}
?>