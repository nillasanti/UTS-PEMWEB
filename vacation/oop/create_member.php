<?php
// include database and object files
include_once 'config/database.php';
include_once 'objects/member.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$member = new member($db);
$category = new Category($db);
// set page headers
$page_title = "Register";
include_once "layout_header.php";
 
// contents will be here
 echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>List Produk</a>";
echo "</div>";
 
?>
<!-- 'create product' html form will be here -->
<!-- PHP post code will be here -->
 <?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
 
    // set product property values
    $member->fname = $_POST['fname'];
    $member->lname = $_POST['lname'];
    $member->email = $_POST['email'];
    $member->password = $_POST['password'];
    $member->alamat = $_POST['alamat'];
    $member->status= $_POST['status'];
    $member->telepon= $_POST['telepon'];
    $image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
	$member->image = $image;
 	// try to upload the submitted file
	// uploadPhoto() method will return an error message, if any.
		echo $member->uploadPhoto();
		
    // create the product
    if($member->create()){
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
                <input type="text" class="form-control hidden" id="exampleInputEmail1" aria-describedby="emailHelp" value="member" name="status">
              </div>
             <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="fname">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="lname">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
             </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="alamat">
              </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nomor Telepon</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="telepon">
            </div>

              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Foto Profile</span>
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

              <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
// footer
include_once "layout_footer.php";
?>