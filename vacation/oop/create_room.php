<?php
$id = isset($_GET['id_penginapan'])? $_GET['id_penginapan'] : '';
// include database and object files
include_once 'config/database.php';
include_once 'objects/room.php';
include_once 'objects/fasilitas.php';
include_once 'objects/penginapan.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
// pass connection to objects
$kamar = new Room($db);
$fasilitas = new Fasilitas($db);
$penginapan = new Penginapan($db);
// set page headers
$page_title = "Tambahkan Kamar";
include_once "layout_header.php";
 
// contents will be here

?>
<!-- 'create product' html form will be here -->
<!-- PHP post code will be here -->
 <?php 
// if the form was submitted - PHP OOP CRUD Tutorial
$kamar->id_penginapan = $id;
if($_POST){
 
    // set product property values
    $kamar->nama_kamar = $_POST['nama_kamar'];
    $kamar->harga = $_POST['harga'];
    $kamar->deskripsi_kamar = $_POST['deskripsi_kamar'];
    $kamar->id_fasilitas = $_POST['id_fasilitas'];
    $kamar->id_penginapan = $_POST['id_penginapan'];
    $image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
	$kamar->image = $image;
 	// try to upload the submitted file
	// uploadPhoto() method will return an error message, if any.
		echo $kamar->uploadPhoto();
		
    // create the product
    if($kamar->create()){
        echo "<div class='alert alert-success'>Produk telah ditambahkan.</div>";
    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Tidak dapat menambahkan produk.</div>";
    }
}
?>
<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
                <input type="text" class="form-control hidden" id="exampleInputEmail1" aria-describedby="emailHelp" name="id_penginapan" value="<?php echo $id; ?>">
        </div>

        <div class="form-group">
                <label for="exampleInputEmail1">Nama Kamar</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama_kamar">
        </div>
 
        <div class="form-group">
                <label for="exampleInputEmail1">Harga</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="harga">
        </div>
 
        <div class="form-group">
                <label for="exampleInputEmail1">Deskripsi</label>
                <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="deskripsi_kamar"></textarea>
        </div>
 
        <div class="form-group">
                <label for="exampleInputEmail1">Fasilitas</label>
            <!-- categories from database will be here -->
            <?php
			// read the product categories from the database
			$stmt = $fasilitas->read();
 
			// put them in a select drop-down
			echo "<select class='form-control' name='id_fasilitas'>";
    		echo "<option>Pilih Tipe Kamar || Fasilitas</option>";
 
   			while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
       		extract($row_category);
        	echo "<option value='{$id_fasilitas}'>{$nama_fasilitas} || {$deskripsi}</option>";
   			}
 
            echo "</select>";
            ?>
        </div>

        <div class="form-group">
                <label for="exampleInputEmail1">Deskripsi</label>
                <input type="file" name="image"/>
        </div>
        
        <button type="Simpan" class="btn btn-success mr-2">Submit</button>
        <a href='view_penginapan.php' class='btn btn-danger ml-2'>Kembali</a>
 
    </table>
</form>
<?php
// footer
include_once "layout_footer.php";
?>