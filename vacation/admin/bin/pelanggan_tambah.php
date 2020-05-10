<?php
include_once '../oop/config/database.php';
include_once '../oop/objects/fasilitas.php';

if(isset($_GET['id_pelanggan'])){
$query = mysqli_query ($connect,"Select * FROM pelanggan where id_pelanggan='$_GET[id_pelanggan]'") or die (mysqli_error());
$result_edit = mysqli_fetch_array($query);
}
?>
<body>
<div class="stambah">
<form action="halweb.php?pages=pelanggan_proses" method="POST" enctype="multipart/form-data">
<?php
	if(isset($_GET['id_pelanggan'])){
		echo "<input type='hidden' name='status' value='edit'>";
	}else {
		echo "<input type='hidden' name='status' value='add'>";
	}
?>
 <div class="table-responsive table-striped table-hover">
        <table class="table " id="table" width="100%" cellspacing="0" text-white>
            <thead style="text-align: center">
                <th colspan="2">
                    <h2 align="center"><?php if(isset($_GET['id_pelanggan'])){ echo"Edit Data Pelanggan";} else {echo"Tambah Data Pelanggan";}  ?></h2>
                </th>
            </thead>
            <tbody>
				<input type="hidden" name="txtid" value="<?php if(isset($result_edit['id_pelanggan'])) echo $result_edit['id_pelanggan'] ?>">
					<tr>
						<td><label>Nama</label></td>
						<td><input type="text" class="form-control" name="txtnama" placeholder="nama" value="<?php if(isset($result_edit['nama_pelanggan'])) echo $result_edit['nama_pelanggan'] ?>"></td>
					</tr>	
					<tr>
						<td><label>Jenis Kelamin</label></td>
						<td ><input type="radio" name="txtjk" value="Laki - Laki" checked>Laki - laki
				<input type="radio" name="txtjk" value="Perempuan" <?php if(@$result_edit['jk_pelanggan'] == 'Perempuan') echo "checked"; ?>>Perempuan</td>
					</tr>
					<tr>
						<td><label>Alamat</label></td>
						<td><textarea class="form-control" name="txtalamat"><?php if(isset($result_edit['alamat'])) echo $result_edit['alamat'] ?></textarea></td>
					</tr>
					<tr>
						<td><label>No Telepon</label></td>
						<td><input type="text" class="form-control" name="txttelepon" placeholder="Telepon" value="<?php if(isset($result_edit['telp_pelanggan'])) echo $result_edit['telp_pelanggan'] ?>"required></td>
					</tr>
	
					<tr>
						<td><button class="btn btn-success"><i class="fas fa-fw fa-save"></i> <?php if(isset($_GET['id_pelanggan'])){ echo"Edit ";} else {echo"Tambah";} ?></button></td>
						<td ><a href="halweb.php?pages=pelanggan" class="btn btn-primary"> kembali </button></td>
					</tr>
            </tbody>
	</table>
</form>
</div>
</body>