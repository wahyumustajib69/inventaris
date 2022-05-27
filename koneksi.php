<?php
$konek = mysqli_connect("localhost","root","","inventaris");

if(mysqli_connect_errno()){
	echo 'Database Tidak Ditemukan'.mysqli_errno();
	exit();
}
?>