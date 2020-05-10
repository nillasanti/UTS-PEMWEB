<?php
include "config/koneksi.php";

$status = @$_POST['status'];

$id= @$_POST['txtid'];
$nama   = @$_POST['txtnama'];
$jk     = @$_POST['txtjk'];
$alamat = @$_POST['txtalamat'];
$telepon = @$_POST['txttelepon'];
    
switch($status) {
    case 'add':
        $tambah = mysqli_query($connect,"INSERT INTO supplier VALUES ('','$nama','$jk','$alamat','$telepon')")or die (mysqli_error($connect));
        if ($tambah=true){
            echo"<script>alert('Tambah Data Berhasil');</script>";
        }else {
            echo"<script>alert('Tambah Data Tidak Berhasil');</script>";
        }
    break;
    
    case 'edit':
        $edit   = "UPDATE supplier SET nama='$nama', alamat='$jk',email='$alamat', telepon='$telepon'";
        $edit .="WHERE id='$id'";
        $edit   = mysqli_query($connect,$edit) or die (mysqli_error());
        if ($edit=true){
            echo"<script>alert('Update Data Berhasil');</script>";
        }else {
            echo"<script>alert('Update Data Tidak Berhasil');</script>";
        }
    break;
    
    default:
    $id =$_GET['id'];
    $tambah = mysqli_query ($connect,"DELETE FROM supplier WHERE id ='$id'")or die (mysql_error());
        if ($tambah=true){
            echo"<script>alert('Delete Data Berhasil');</script>";
        }else {
            echo"<script>alert('Delete Data Tidak Berhasil');</script>";
        }
    break;
}
?>
<meta http-equiv="refresh" content="0; url=halweb.php?pages=supplier">