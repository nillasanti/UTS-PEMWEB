<?php
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
echo "<div class='right-button-margin text-right'>";
    echo "<a href='..\create_penginapan.php' class='btn btn-primary mr-2'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Tambah Penginapan";
    echo "</a>";
    echo "<a href='..\mitramain.php' class='btn btn-danger ml-2'>";
    echo " Kembali";
echo "</a>";
echo "</div>";
 
// display the products if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Nama Penginapan</th>";
            echo "<th>Alamat</th>";
            echo "<th>Telepon</th>";
            echo "<th>Email</th>";
            echo "<th>Aksi</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$nama_penginapan}</td>";
                echo "<td>{$alamat}</td>";
                echo "<td>{$telepon}</td>";
                echo "<td>{$email}</td>";
                echo "<td>";
                    // read product button
                    echo "<a href='view_kamar.php?id_penginapan={$id_penginapan}' class='btn btn-success left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Room List";
                    echo "</a>";
 
                    // edit product button
                    echo "<a href='update_penginapan.php?id_penginapan={$id_penginapan}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
 
                    // delete product button
                    echo "<a delete-id='{$id_penginapan}' class='btn btn-danger delete-object' >";
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