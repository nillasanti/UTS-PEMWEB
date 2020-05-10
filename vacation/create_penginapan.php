<?php
// include database and object files
include_once 'oop/config/database.php';
include_once 'oop/objects/penginapan.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$penginapan = new Penginapan($db);
// set page headers
$page_title = "Tambah penginapan";
include_once "oop/layout_header.php";
 
// contents will be here
 
 
?>
<!-- 'create product' html form will be here -->
<!-- PHP post code will be here -->
 <?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
 
    // set product property values
    $penginapan->nama_penginapan = $_POST['nama_penginapan'];
    $penginapan->alamat = $_POST['alamat'];
    $penginapan->email = $_POST['email'];
    $penginapan->telepon = $_POST['telepon'];
    $image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
	$penginapan->image = $image;
 	// try to upload the submitted file
	// uploadPhoto() method will return an error message, if any.
		echo $penginapan->uploadPhoto();
		
    // create the product
    if($penginapan->create()){
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
                <label for="exampleInputEmail1">Nama Penginapan</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama_penginapan">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat Penginapan</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="alamat">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Telepon</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="telepon">
              </div>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Gambar Penginapan</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
                  </div>
            </div>
            <br/>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>

              <button type="submit" class="btn btn-success mr-2">Submit</button>
              <a href='oop/view_penginapan.php' class='btn btn-danger ml-2'>Cancel</a>
</form>
<?php
// footer
include_once "oop/layout_footer.php";
?>