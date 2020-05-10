<?php
session_start();

include'config/koneksi.php';

$username=@$_POST['username'];
$password=@$_POST['password'];

$login =mysqli_query($connect,"select * from user where email='$username' and password='$password'");
$cek =mysqli_num_rows($login);

if($cek>0){
	$data = mysqli_fetch_assoc($login);
	if($data['status']=="admin"){
		$_SESSION['username']=$data['email'];
		$_SESSION['status']="admin";
		echo"<script>alert('Berhasil login')</script>";
		header("location:halweb.php");
	}elseif($data['status']=="akuntan"){
		$_SESSION['username']=$data['email'];
		$_SESSION['status']="akuntan";
		echo"<script>alert('Berhasil login')</script>";
		header("location:halweb.php");
	}elseif($data['status']=="owner"){
		$_SESSION['username']=$data['email'];
		$_SESSION['status']="owner";
		echo"<script>alert('Berhasil login')</script>";
		header("location:halweb.php");
	}
		
}else{
		echo "<script>alert('".$username." - ".$password."'tidak sesuai!');
				window.location.href='index.html';</script>";}
?>
<meta http-equiv="refresh" content="3,URL=index.php">