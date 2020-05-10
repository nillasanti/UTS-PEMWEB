<?php
include "config/koneksi.php";

if(isset($_GET['username'])){
$query = mysqli_query ($connect,"Select * FROM user where username='$_GET[username]'") or die (mysqli_error());
$result_edit = mysqli_fetch_array($query);
}
?>
<body>
<div class="stambah">
<form action="halweb.php?pages=userp_proses" method="POST" enctype="multipart/form-data">
<?php
    if(isset($_GET['username'])){
        echo "<input type='hidden' name='status' value='edit'>";
    }else {
        echo "<input type='hidden' name='status' value='add'>";
    }
?>

    <div class="table-responsive table-striped table-hover">
        <table class="table " id="table" width="100%" cellspacing="0" text-white>
            <thead style="text-align: center">
                <h2 align="center"><?php if(isset($_GET['username'])){ echo"Edit Data User";} else {echo"Tambah Data User";}  ?></h2>
            </thead>

    <tr>
        <td><label>Nama Lengkap</label></td>
        <td><input type="text" class="form-control" name="txtnama" placeholder="nama" value="<?php if(isset($result_edit['nama'])) echo $result_edit['nama'] ?>"></td>
    </tr>
    <tr>
        <td><label>Usernames</label></td>
        <td><input type="text" class="form-control" name="txtuser" placeholder="username" value="<?php if(isset($result_edit['username'])) echo $result_edit['username'] ?>" required></td>
    </tr>
    
    <tr>
        <td><label>Password</label></td>
        <td><input type="password" class="form-control" name="txtpass" placeholder="password" value="<?php if(isset($result_edit['password'])) echo $result_edit['password'] ?>" <?php if(isset($result_edit['password'])) echo "disabled"?>></td>
    </tr>
    <tr>
        <td>Level</td>
        <td>
        <select class="form-control" name="txtlevel">
        <option value="admin" <?php if(@result_edit['level']=='admin') echo'selected'; ?> >Admin</option>
        <option value="akuntan" <?php if(@result_edit['level']=='akuntan') echo'selected'; ?> >Akuntan</option>
        <option value="owner" <?php if(@result_edit['level']=='owner') echo'selected'; ?> >Owner</option>
        </td>
        </select>
    </tr>
   


    <tr>
        <td><button class="btn btn-success"><i class="fas fa-fw fa-save"></i><?php if(isset($_GET['username'])){ echo"Edit ";} else {echo"Tambah";} ?></button></td>
        <td style="text-align: center"><a class="btn btn-primary" href="halweb.php?pages=user"> Kembali </button></td>
    </tr>
    </table>
</form>
</div>
</body>