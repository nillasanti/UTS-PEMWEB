<?php
include "objects/penginapan.php";
class Room extends Penginapan{
 
    // database connection and table name
    private $conn;
    private $table_name = "kamar";
 
    // object properties
    public $id_kamar;
    public $nama_kamar;
    public $harga;
    public $deskripsi_kamar;
    public $id_fasilitas;
    public $id_penginapan;
    public $image;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create product
    function create(){
 
        //write query
       // insert query
        $query = "INSERT INTO " . $this->table_name . "
            SET nama_kamar=:nama_kamar, harga=:harga, deskripsi_kamar=:deskripsi_kamar,
                id_fasilitas=:id_fasilitas,id_penginapan=:id_penginapan, image=:image";
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->nama_kamar=htmlspecialchars(strip_tags($this->nama_kamar));
        $this->harga=htmlspecialchars(strip_tags($this->harga));
        $this->deskripsi_kamar=htmlspecialchars(strip_tags($this->deskripsi_kamar));
        $this->id_fasilitas=htmlspecialchars(strip_tags($this->id_fasilitas));
        $this->id_penginapan=htmlspecialchars(strip_tags($this->id_penginapan));
        $this->image=htmlspecialchars(strip_tags($this->image));
 
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":nama_kamar", $this->nama_kamar);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":deskripsi_kamar", $this->deskripsi_kamar);
        $stmt->bindParam(":id_fasilitas", $this->id_fasilitas);
        $stmt->bindParam(":id_penginapan", $this->id_penginapan);
        $stmt->bindParam(":image", $this->image);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
    function readAll($from_record_num, $records_per_page){
 
    $query = "SELECT
                id_kamar, nama_kamar, deskripsi_kamar, harga, id_fasilitas
            FROM
                " . $this->table_name . "
            ORDER BY
                nama_kamar ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}
// used for paging products
    public function countAll(){
 
    $query = "SELECT id_kamar FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    $num = $stmt->rowCount();
 
    return $num;
    }
   function readOne(){
 
        $query = "SELECT nama_kamar, harga, deskripsi_kamar, id_fasilitas, image
            FROM " . $this->table_name . "
            WHERE id_kamar = ?
            LIMIT 0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id_kamar);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->nama_kamar = $row['nama_kamar'];
        $this->harga = $row['harga'];
        $this->deskripsi_kamar = $row['deskripsi_kamar'];
        $this->id_fasilitas = $row['id_fasilitas'];
        $this->image = $row['image'];
    }
    function update(){
 
    $query = "UPDATE
                " . $this->table_name . "
            SET
                nama_kamar = :nama_kamar,
                harga = :harga,
                deskripsi_kamar = :deskripsi_kamar,
                id_fasilitas  = :id_fasilitas,
            WHERE
                id_kamar = :id_kamar";
 
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->nama_kamar=htmlspecialchars(strip_tags($this->nama_kamar));
    $this->harga=htmlspecialchars(strip_tags($this->harga));
    $this->deskripsi_kamar=htmlspecialchars(strip_tags($this->deskripsi_kamar));
    $this->id_fasilitas=htmlspecialchars(strip_tags($this->id_fasilitas));
    $this->id_kamar=htmlspecialchars(strip_tags($this->id_kamar));

 
    // bind parameters
    $stmt->bindParam(':nama_kamar', $this->nama_kamar);
    $stmt->bindParam(':harga', $this->harga);
    $stmt->bindParam(':deskripsi_kamar', $this->deskripsi_kamar);
    $stmt->bindParam(':id_fasilitas', $this->id_fasilitas);


    $stmt->bindParam(':id_kamar', $this->id_kamar);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
// delete the product
function delete(){
 
    $query = "DELETE FROM " . $this->table_name . " WHERE id_kamar = ?";
     
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id_kamar);
 
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// read products by search term
public function search($search_term, $from_record_num, $records_per_page){
 
    // select query
    $query = "SELECT
                c.nama_fasilitas as nama_fasilitas, p.id_kamar, p.nama_kamar, p.deskripsi_kamar, p.harga_kamar, p.id_fasilitas, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    fasilitas c
                        ON p.id_fasilitas = c.id_fasilitas
            WHERE
                p.nama_kamar LIKE ? OR p.deskripsi_kamar LIKE ?
            ORDER BY
                p.nama_kamar ASC
            LIMIT
                ?, ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $search_term);
    $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values from database
    return $stmt;
}
 
public function countAll_BySearch($search_term){
 
    // select query
    $query = "SELECT
                COUNT(*) as total_rows
            FROM
                " . $this->table_name . " p 
            WHERE
                p.nama_kamar LIKE ? OR p.deskripsi_kamar LIKE ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $search_term);
 
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    return $row['total_rows'];
}

// will upload image file to server
    // will upload image file to server
    function uploadPhoto()
    {
     
        $result_message="";
     
        // now, if image is not empty, try to upload the image
        if($this->image){
     
            // sha1_file() function is used to make a unique file name
            $target_directory = "uploads/";
            $target_file = $target_directory . $this->image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
     
            // error message is empty
            $file_upload_error_messages="";
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
                    // submitted file is an image
                }else{
                    $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
                }
                 
                // make sure certain file types are allowed
                $allowed_file_types=array("jpg", "jpeg", "png", "gif");
                if(!in_array($file_type, $allowed_file_types)){
                    $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
                }
                 
                // make sure file does not exist
                if(file_exists($target_file)){
                    $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
                }
                 
                // make sure submitted file is not too large, can't be larger than 1 MB
                if($_FILES['image']['size'] > (1024000)){
                    $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
                }
                 
                // make sure the 'uploads' folder exists
                // if not, create it
                if(!is_dir($target_directory)){
                    mkdir($target_directory, 0777, true);
                }
                // if $file_upload_error_messages is still empty
                if(empty($file_upload_error_messages)){
                    // it means there are no errors, so try to upload the file
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                        // it means photo was uploaded
                    }else{
                        $result_message.="<div class='alert alert-danger'>";
                            $result_message.="<div>Unable to upload photo.</div>";
                            $result_message.="<div>Update the record to upload photo.</div>";
                        $result_message.="</div>";
                    }
                }
                 
                // if $file_upload_error_messages is NOT empty
                else{
                    // it means there are some errors, so show them to user
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="{$file_upload_error_messages}";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
                 
            }
     
            return $result_message;
    }

}
?>
