<?php
include"config/koneksi.php";

if(isset($_GET['id'])){
$query = mysqli_query ($connect,"Select * FROM supplier where id='$_GET[id]'") or die (mysqli_error());
$result_edit = mysqli_fetch_array($query);
}
?>
<body>
<div class="stambah">
<form action="halweb.php?pages=sup_proses" method="POST" enctype="multipart/form-data">
<?php
    if(isset($_GET['id'])){
        echo "<input type='hidden' name='status' value='edit'>";
    }else {
        echo "<input type='hidden' name='status' value='add'>";
    }
?>

  <div class="table-responsive table-striped table-hover">
        <table class="table " id="table" width="100%" cellspacing="0" text-white>
            <thead style="text-align: center">
                <th colspan="2">
                    <h2 align="center"><?php if(isset($_GET['id'])){ echo"Edit Data Supplier";} else {echo"Tambah Data Supplier";}  ?></h2>
                </th>
            </thead>
<input type="hidden" name="txtid" value="<?php if(isset($result_edit['id'])) echo $result_edit['id'] ?>">
        <tr>
            <td><label>Nama Lengkap</label></td>
            <td><input type="text" class="form-control" name="txtnama" placeholder="nama" value="<?php if(isset($result_edit['nama'])) echo $result_edit['nama'] ?>"></td>
        </tr>
        
        <tr>
            <td><label>Alamat</label></td>
            <td ><input type="text" class ="form-control" name="txtjk" placeholder="Alamat" value="<?php if(isset($result_edit['alamat'])) echo $result_edit['alamat'] ?>"></td>
        </tr>
        <tr>
            <td><label>Email</label></td>
            <td><input type="text" class="form-control" name="txtalamat" placeholder="Email" value="<?php if(isset($result_edit['email'])) echo $result_edit['email'] ?>"></textarea></td>
        </tr>
        <tr>
            <td><label>No Telepon</label></td>
            <td><input type="text" class="form-control" name="txttelepon" placeholder="Telepon" value="<?php if(isset($result_edit['telepon'])) echo $result_edit['telepon'] ?>"required></td>
        </tr>
        <tr>
            <td><button class="btn btn-success"><i class="fas fa-fw fa-save"></i><?php if(isset($_GET['id'])){ echo"Edit ";} else {echo"Tambah";} ?></button></td>
            <td ><a class="btn btn-primary" href="halweb.php?pages=supplier"> kembali </button></td>
        </tr>
    </table>
</form>
</div>
</body>