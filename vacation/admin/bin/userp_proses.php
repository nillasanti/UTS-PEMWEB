<?php
include "config/koneksi.php";

if(isset($_GET['username'])){
$query = mysqli_query ($connect,"Select * FROM user where username='$_GET[username]'") or die (mysqli_error());
$result_edit = mysqli_fetch_array($query);
}

$status = @$_POST['status'];
$user   = @$_POST['txtuser'];
$pass   = md5(@$_POST['txtpass']);
$nama   = @$_POST['txtnama'];
$level  = @$_POST['txtlevel'];
    
switch($status) {
    case 'add':
        $tambah = mysqli_query ($connect,"INSERT INTO user VALUES ('','$nama','$user','$pass','$level','')")or die (mysqli_error());
        if ($tambah=true){
            echo"<script>alert('Tambah Data Berhasil');</script>";
        }else {
            echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
        }
    break;
    
    case 'edit':
        $edit   = "UPDATE user SET username='$user',password='$pass', nama='$nama', level='$level'";
        $edit .="WHERE username='$user'";
        $edit   = mysqli_query($connect,$edit) or die (mysqli_error());
        if ($edit=true){
            echo"<script>alert('Update Data Berhasil');</script>";
        }else {
            echo"<script>alert('Update Data Tidak Berhasil');</script>";
        }
    break;
    
    default:
    $id = @$_GET['username'];
    $del = mysqli_query ($connect,"DELETE FROM user WHERE username ='$id'")or die (mysqli_error());
        if ($tambah=true){
            echo"<script>alert('Delete Data Berhasil');</script>";
        }else {
            echo"<script>alert('Delete Data Tidak Berhasil');</script>";
        }
    break;
}
?>
<meta http-equiv="refresh" content="0; url=halweb.php?pages=user">