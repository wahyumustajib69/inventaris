<?php
session_start();
include_once "koneksi.php";

$id = $_POST['id'];
$tg = $_POST['tgl'];
$in = $_POST['inv'];
$nm = $_POST['nama'];
$kt = $_POST['ktg'];
$st = $_POST['stn'];
$jm = $_POST['jml'];
$jl = $_POST['jm'];
$ke = $_POST['ket'];

mysqli_query($konek,"UPDATE inv_brg SET jumlah=(jumlah+$jl)-$jm WHERE kode='$in'");
$sql = "UPDATE brg_rusak SET tgl='$tg',kd_inv='$in',nm_brg='$nm',kategori='$kt',satuan='$st',jml='$jm',ket='$ke' WHERE id='$id'";
mysqli_query($konek,$sql);
if($sql){
	$_SESSION['pesan']='Simpan Data BERHASIL !!';
	header("location:barang_rusak");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:barang_rusak");
}
?>