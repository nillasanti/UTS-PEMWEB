<?php
include "config/koneksi.php";

if(isset($_GET['username'])){
$query = mysqli_query ($connect,"Select * FROM user where username='$_GET[username]'") or die (mysqli_error());
$result_edit = mysqli_fetch_assoc($query);
}
?>
<body>
<div class="stambah">
<form action="halweb.php?pages=userp_proses" method="POST">

    <div class="table-responsive table-striped table-hover">
        <table class="table " id="table" width="100%" cellspacing="0" text-white>
            <thead style="text-align: center">
                <th colspan="2">View Data User</th>
            </thead>

    <tr>
        <td><label>Nama Lengkap</label></td>
        <td><input type="text" class="form-control" name="txtnama" value="<?php if(isset($result_edit['nama'])) echo $result_edit['nama'] ?>"></td>
    </tr>
    <tr>
        <td><label>Usernames</label></td>
        <td><input type="text" class="form-control" name="txtuser" value="<?php if(isset($result_edit['username'])) echo $result_edit['username'] ?>"></td>
    </tr>
    
    <tr>
        <td><label>Password</label></td>
        <td><input type="password" class="form-control" name="txtpass"  value="<?php if(isset($result_edit['password'])) echo $result_edit['password'] ?>" <?php if(isset($result_edit['password'])) echo "disabled"?>></td>
    </tr>
    <tr>
        <td><label>level</label></td>
        <td><input type="text" class="form-control" name="txtlevel" value="<?php if(isset($result_edit['level'])) echo $result_edit['level'] ?>" </td>
        </td>
        </select>
    </tr>

    <tr>
        <td style="text-align: center" colspan="2"><a class="btn btn-primary" href="halweb.php?pages=user">kembali </button></td>
    </tr>
    </table>
</form>
</div>
</body>