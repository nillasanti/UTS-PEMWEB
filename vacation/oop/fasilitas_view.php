<?php
include_once '../oop/config/core.php';
include_once '../oop/config/database.php';
include_once '../oop/objects/fasilitas.php';
 
// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
 
$fasilitas = new fasilitas($db);
 // query products
$stmt = $fasilitas->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "index.php?";
 
// count total rows - used for pagination
$total_rows=$fasilitas->countAll();

// search form
echo "<form role='search' action='search.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Ketik produk yang dicari..' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
 
// create product button
echo "<div class='right-button-margin'>";
    echo "<a href='create_product.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Tambah Produk";
    echo "</a>";
    echo "<a href='create_member.php' class='btn btn-primary pull-right ml-2'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Tambah Member";
    echo "</a>";
echo "</div>";
 
// display the products if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Nama Produk</th>";
            echo "<th>Harga</th>";
            echo "<th>Aksi</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$nama_fasilitas}</td>";
                echo "<td>{$deskripsi}</td>";
                echo "<td>";
 
                    // read product button
                    echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> View";
                    echo "</a>";
 
                    // edit product button
                    echo "<a href='update_product.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
 
                    // delete product button
                    echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a>";
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    // paging buttons
    include_once '../oop/paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>Tidak ada produk.</div>";
}
?>