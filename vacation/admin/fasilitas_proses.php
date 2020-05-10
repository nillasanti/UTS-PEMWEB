<?php
// include database and object files
include_once '../oop/config/database.php';
include_once '../oop/objects/fasilitas.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$fasilitas = new fasilitas($db);

$fasilitas->nama_fasilitas = $_POST['nama_fasilitas'];
$fasilitas->deskripsi = $_POST['deskripsi'];
    
// create the product
if($fasilitas->create()){
    echo "<div class='alert alert-success'>Data Fasilitas Telah Ditambahkan.</div>";
}

// if unable to create the product, tell the user
else{
    echo "<div class='alert alert-danger'>Tidak dapat menambahkan Data Fasilitas.</div>";
}

 
// contents will be here
 
?>
<!-- 'create product' html form will be here -->
<!-- PHP post code will be here -->
 