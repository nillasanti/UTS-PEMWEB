<?php
// search form
echo "<form role='search' action='#'>";
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
    echo "<a href='create_room.php?id={$id}' class='btn btn-primary left-margin'>";
    echo "<span class='glyphicon glyphicon-plus'></span> Add";
    echo "</a>";
    echo "<a href='view_penginapan.php' class='btn btn-danger ml-2'>";
    echo " Kembali";
echo "</a>";
echo "</div>";
 
// display the products if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Nama Ruangan</th>";
            echo "<th>Deskripsi</th>";
            echo "<th>Fasilitas</th>";
            echo "<th>Harga</th>";
            echo "<th>Aksi</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$nama_kamar}</td>";
                echo "<td>{$deskripsi_kamar}</td>";
                echo "<td>";
                $fasilitas->id_fasilitas=$id_fasilitas;
                $fasilitas->readName();
                echo $fasilitas->deskripsi;
                echo "</td>";
                echo "<td>{$harga}</td>";
                echo "<td>";
 
                    // edit product button
                    echo "<a href='update_kamar.php?id_kamar={$id_kamar}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
 
                    // delete product button
                    echo "<a delete-id_kamar='{$id_kamar}' class='btn btn-danger delete-object'>";
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