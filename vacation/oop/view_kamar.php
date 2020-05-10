<?php
$id = isset($_GET['id_penginapan'])? $_GET['id_penginapan'] : '';
// core.php holds pagination variables
include_once '../oop/config/core.php';
 
// include database and object files
include_once '../oop/config/database.php';


include_once '../oop/objects/room.php';
include_once '../oop/objects/fasilitas.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$kamar = new Room($db);
$fasilitas = new Fasilitas($db);
 
$page_title = "Daftar Kamar";
include_once "../oop/layout_header.php";
 
// query products
$stmt = $kamar->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "view_kamar.php?";
 
// count total rows - used for pagination
$total_rows=$kamar->countAll();
 
// read_template.php controls how the product list will be rendered
include_once "list_kamar.php";
 
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>
