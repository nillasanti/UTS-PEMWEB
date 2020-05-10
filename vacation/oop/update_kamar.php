<?php
// retrieve one product will be here
 // get ID of the product to be edited
 $id_kamar = isset($_GET['id_kamar'])? $_GET['id_kamar'] : '';
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/room.php';
include_once 'objects/fasilitas.php';
include_once 'objects/penginapan.php';
 // set page header
$page_title = "Edit Data Kamar";
include_once "layout_header.php";
 
// contents will be here
 echo "<div class='right-button-margin'>";
    echo "<a href='view_kamar.php' class='btn btn-default pull-right'>Back</a>";
echo "</div>";
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$kamar = new Room($db);
$fasilitas = new Fasilitas($db);
$penginapan = new Penginapan($db);
// set ID property of product to be edited
$kamar->id_kamar = $id_kamar;
 
// read the details of product to be edited
$kamar->readOne();
 
?>
<!-- 'update product' form will be here -->
<!-- post code will be here -->
 <?php 
// if the form was submitted
if($_POST){
 
    // set product property values
    $kamar->nama_kamar = $_POST['nama_kamar'];
    $kamar->harga = $_POST['harga'];
    $kamar->deskripsi_kamar = $_POST['deskripsi_kamar'];
    $kamar->id_fasilitas = $_POST['id_fasilitas'];
 
    // update the product
    if($kamar->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Data kamar telah diperbarui.";
        echo "</div>";
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Tidak dapat memperbarui data kamar.";
        echo "</div>";
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id_kamar={$id_kamar}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Nama Kamar</td>
            <td><input type='text' name='nama_kamar' value='<?php echo $kamar->nama_kamar; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Harga</td>
            <td><input type='text' name='harga' value='<?php echo $kamar->harga; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Deskripsi</td>
            <td><textarea name='deskripsi_kamar' class='form-control'><?php echo $kamar->deskripsi_kamar; ?></textarea></td>
        </tr>
 
        <tr>
            <td>Fasilitas</td>
            <td>
                <!-- categories select drop-down will be here -->
                <?php
				$stmt = $fasilitas->read();
               
				// put them in a select drop-down
                echo "<select class='form-control' name='id_fasilitas'>";
                echo "<option>Pilih Tipe Kamar || Fasilitas</option>";
    			while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
        		$id_fasilitas=$row_category['id_fasilitas'];
                $nama_fasilitas = $row_category['nama_fasilitas'];
                $deskripsi=$row_category['deskripsi'];
        		// current category of the product must be selected
        		if($kamar->id_fasilitas==$id_fasilitas){
            	echo "<option value='$id_fasilitas' selected>";
        		}else{
            	echo "<option value='$id_fasilitas'>";
        		}
	 
        		echo "$nama_fasilitas || $deskripsi</option>";
    			}
				echo "</select>";
				?>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
// set page header
$page_title = "Edit Data Kamar";
include_once "layout_header.php";
 
// contents will be here
// set page footer
include_once "layout_footer.php";
?>