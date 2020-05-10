<?php
include"config/koneksi.php";

if(isset($_GET['kode_akun'])){
$query = mysqli_query ($connect,"Select * FROM akun where kode_akun='$_GET[kode_akun]'") or die (mysqli_error());
$result_edit = mysqli_fetch_array($query);
}
?>
<body>
<div class="stambah">
<form action="halweb.php?pages=akun_proses" method="POST" enctype="multipart/form-data">
<?php
	if(isset($_GET['kode_akun'])){
		echo "<input type='hidden' name='status' value='edit'>";
	}else {
		echo "<input type='hidden' name='status' value='add'>";
	}
?>

  <div class="table-responsive table-striped table-hover">
        <table class="table " id="table" width="100%" cellspacing="0" text-white>
            <thead style="text-align: center">
                <th colspan="2">
                    <h2 align="center"><?php if(isset($_GET['kode_akun'])){ echo"Edit Data Akun";} else {echo"Tambah Data Akun";}  ?></h2>
                </th>
            </thead>
<input type="hidden" name="txtid" value="<?php if(isset($result_edit['kode_akun'])) echo $result_edit['kode_akun'] ?>">
	
	<tr>
		<td><label>Kode akun</label></td>
		<td ><input type="text" name="txtakun" value="<?php if(isset($result_edit['kode_akun'])) echo $result_edit['kode_akun']; ?>" checked></td>
	</tr>
	<tr>
		<td><label>Nama akun</label></td>
		<td><input type="text" class="form-control" name="txtnama" placeholder="Nama akun...." value="<?php if(isset($result_edit['nama_akun'])) echo $result_edit['nama_akun']; ?>"></td>
	</tr>
	
	<tr>
		<td><label>Posisi</label></td>
		<td><select class="form-control"id="posisi" name="posisi" >
		<option  value="<?php if(isset($result_edit['laba_rugi'])) {echo $result_edit['laba_rugi'];}else {echo "";} ?>"><?php if(isset($result_edit['posisi'])) {echo $result_edit['posisi'];}else {echo "Pilih Posisi";} ?></option>

		<option value="L">Debit</option>
		<option value="R">Kredit</option>
		</select>
		</td>
	</tr>

	<tr>
		<td><label>Laba Rugi</label></td>
		<td><select class="form-control"id="labarugi" name="labarugi" >
		<option  value="<?php if(isset($result_edit['laba_rugi'])) echo $result_edit['laba_rugi']; ?>"><?php if(isset($result_edit['laba_rugi'])) {echo $result_edit['laba_rugi'];}else {echo "Pilih Laba Rugi";} ?></option>

		<option value="N">N</option>
		<option value="T">T</option>
		<option value="B">B</option>
		</select>
		</td>
	</tr>

	<tr>
		<td><label>Posisi Modal</label></td>
		<td><select class="form-control"id="posisimodal" name="posisimodal" >
		<option  value="<?php if(isset($result_edit['pm'])) echo $result_edit['pm']; ?>"><?php if(isset($result_edit['pm'])) {echo $result_edit['pm'];}else {echo "Pilih Posisi Modal";} ?></option>
		
		<option value="0">0</option>
		<option value="1">1</option>
		</select>
		</td>
	</tr>

	<tr>
		<td><label>Grup</label></td>
		<td><select class="form-control" id="grup" name="grup" >
		<option  value="<?php if(isset($result_edit['grup'])) echo $result_edit['grup']; ?>"><?php if(isset($result_edit['grup'])) {echo $result_edit['grup'];}else {echo "Pilih Grup";} ?></option>

		<option value="Debit">Debit</option>
		<option value="Kredit">Kredit</option>
		</select>
		</td>
	</tr>


	<tr>
		<td><button class="btn btn-success"><i class="fas fa-fw fa-save"></i><?php if(isset($_GET['kode_akun'])){ echo"Edit ";} else {echo"Tambah";} ?></button></td>
		<td ><a class="btn btn-primary" href="halweb.php?pages=akun"> kembali </button></td>
	</tr>
	</table>
</form>
</div>
</body>