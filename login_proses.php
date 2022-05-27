<?php
   session_start();
   require_once("koneksi.php");
   $username = $_POST['username'];
   $pass = $_POST['password'];   
   
   $sql = mysqli_query($konek,"SELECT * FROM pengguna WHERE username = '$username' AND password='$pass'");
   $hasil = mysqli_fetch_assoc($sql);
   $x = mysqli_num_rows($sql);

   if($x == 0) {
      header('location:login');
   }else {
       $_SESSION['username'] = $hasil['username'];
       header('location:home');
  }
   
?>