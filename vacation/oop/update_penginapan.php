<?php
// retrieve one product will be here
 // get ID of the product to be edited
 $id_penginapan = isset($_GET['id_penginapan'])? $_GET['id_penginapan'] : '';
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/fasilitas.php';
include_once 'objects/penginapan.php';
 // set page header
$page_title = "Edit Data Penginapan";
include_once "layout_header.php";
 
// contents will be here
 echo "<div class='right-button-margin'>";
    echo "<a href='view_penginapan.php' class='btn btn-default pull-right'>Back</a>";
echo "</div>";
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$fasilitas = new Fasilitas($db);
$penginapan = new Penginapan($db);
// set ID property of product to be edited
$penginapan->id_penginapan = $id_penginapan;
 
// read the details of product to be edited
$penginapan->readOne();
 
?>
<!-- 'update product' form will be here -->
<!-- post code will be here -->
 <?php 
// if the form was submitted
if($_POST){
 
    // set product property values
    $penginapan->nama_penginapan = $_POST['nama_penginapan'];
    $penginapan->alamat = $_POST['alamat'];
    $penginapan->email = $_POST['email'];
    $penginapan->telepon = $_POST['telepon'];
 
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id_penginapan={$id_penginapan}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Nama Penginapan</td>
            <td><input type='text' name='nama_penginapan' value='<?php echo $penginapan->nama_penginapan; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Email</td>
            <td><input type='text' name='email' value='<?php echo $penginapan->email; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Alamat</td>
            <td><textarea name='alamat' class='form-control'><?php echo $penginapan->alamat; ?></textarea></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td><input type='text' name='telepon' value='<?php echo $penginapan->telepon; ?>' class='form-control' /></td>
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
$page_title = "Edit Data Penginapan";
include_once "layout_header.php";
 
// contents will be here
// set page footer
include_once "layout_footer.php";
?>