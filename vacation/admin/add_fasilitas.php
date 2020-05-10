<?php
include_once '../oop/config/database.php';
include_once '../oop/objects/fasilitas.php';

$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$fasilitas = new fasilitas($db);

?>
<body>
<div class="stambah">
<form action="halweb.php?pages=fasilitas_proses" method="POST" enctype="multipart/form-data">

 <div class="table-responsive table-striped table-hover">
        <table class="table " id="table" width="100%" cellspacing="0" text-white>
            <thead style="text-align: center">
                <th colspan="2">
                    Tambah data
                </th>
            </thead>
            <tbody>
				<input type="hidden" name="txtid">
					<tr>
						<td><label>Nama Fasilitas</label></td>
						<td><input type="text" class="form-control" name="nama_fasilitas" placeholder="Nama Fasilitas"></td>
					</tr>	
						<td><label>Deskripsi</label></td>
						<td><textarea class="form-control" name="deskripsi" placeholder="Deskripsi"></textarea></td>
					</tr>	
					<tr>
						<td><button class="btn btn-success"><i class="fas fa-fw fa-save"></i>Save</button></td>
						<td ><a href="halweb.php?pages=view_fasilitas" class="btn btn-danger"> Cancel </button></td>
					</tr>
            </tbody>
	</table>
</form>
</div>
</body>