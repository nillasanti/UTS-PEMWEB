<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once 'config/database.php';
    include_once 'objects/penginapan.php';
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare product object
    $penginapan = new Penginapan($db);
     
    // set product id to be deleted
    $penginapan->id_penginapan = $_POST['object_id'];
     
    // delete the product
    if($penginapan->delete()){
        echo "Data Penginapan telah dihapus.";
    }
     
    // if unable to delete the product
    else{
        echo "Tidak dapat menghapus data penginapan.";
    }
}
?>