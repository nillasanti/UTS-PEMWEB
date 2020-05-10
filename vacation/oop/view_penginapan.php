<?php
// core.php holds pagination variables
include_once '../oop/config/core.php';
 
// include database and object files
include_once '../oop/config/database.php';
include_once '../oop/objects/penginapan.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$penginapan = new Penginapan($db);
 
$page_title = "Daftar Penginapan Saya";
include_once "../oop/layout_header.php";
 
// query products
$stmt = $penginapan->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "view_penginapan.php?";
 
// count total rows - used for pagination
$total_rows=$penginapan->countAll();
 
// read_template.php controls how the product list will be rendered
include_once "list_penginapan.php";
 
// layout_footer.php holds our javascript and closing html tags
include_once "laypeng.php";
?>
