<?php
// core.php holds pagination variables
include_once '../oop/config/core.php';
 
// include database and object files
include_once '../oop/config/database.php';
include_once '../oop/objects/fasilitas.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$fasilitas = new fasilitas($db);
 
$page_title = "Jaya Abadi Audio";
 
// query products
$stmt = $fasilitas->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "viewfasilitastst.php?";
 
// count total rows - used for pagination
$total_rows=$fasilitas->countAll();
 
// read_template.php controls how the product list will be rendered
include_once "tstview.php";
 
// layout_footer.php holds our javascript and closing html tags

?>
