<?php
class Penginapan{
 
    // database connection and table name
    private $conn;
    private $table_name = "penginapan";
 
    // object properties
    public $id_penginapan;
    public $nama_penginapan;
    public $email;
    public $telepon;
    public $alamat;
    public $image;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create product
    function create(){
 
        //write query
       // insert query
        $query = "INSERT INTO " . $this->table_name . "
            SET nama_penginapan=:nama_penginapan, alamat=:alamat, email=:email,
                telepon=:telepon, image=:image";
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->nama_penginapan=htmlspecialchars(strip_tags($this->nama_penginapan));
        $this->alamat=htmlspecialchars(strip_tags($this->alamat));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->telepon=htmlspecialchars(strip_tags($this->telepon));
        $this->image=htmlspecialchars(strip_tags($this->image));
 
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":nama_penginapan", $this->nama_penginapan);
        $stmt->bindParam(":alamat", $this->alamat);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telepon", $this->telepon);
        $stmt->bindParam(":image", $this->image);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
    function readAll($from_record_num, $records_per_page){
 
    $query = "SELECT
                id_penginapan, nama_penginapan, alamat, email, telepon
            FROM
                " . $this->table_name . "
            ORDER BY
                nama_penginapan ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}
// used for paging products
    public function countAll(){
 
    $query = "SELECT id_penginapan FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    $num = $stmt->rowCount();
 
    return $num;
    }
   function readOne(){
 
        $query = "SELECT nama_penginapan, alamat, email, telepon, image
            FROM " . $this->table_name . "
            WHERE id_penginapan = ?
            LIMIT 0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id_penginapan);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->nama_penginapan = $row['nama_penginapan'];
        $this->alamat = $row['alamat'];
        $this->email = $row['email'];
        $this->telepon = $row['telepon'];
        $this->image = $row['image'];
    }
    function update(){
 
    $query = "UPDATE
                " . $this->table_name . "
            SET
                nama_penginapan = :nama_penginapan,
                alamat = :alamat,
                email = :email,
                telepon  = :telepon,
            WHERE
                id_penginapan = :id_penginapan";
 
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->nama_penginapan=htmlspecialchars(strip_tags($this->nama_penginapan));
    $this->alamat=htmlspecialchars(strip_tags($this->alamat));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->telepon=htmlspecialchars(strip_tags($this->telepon));
    $this->id_penginapan=htmlspecialchars(strip_tags($this->id_penginapan));

 
    // bind parameters
    $stmt->bindParam(':nama_penginapan', $this->nama_penginapan);
    $stmt->bindParam(':alamat', $this->alamat);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':telepon', $this->telepon);


    $stmt->bindParam(':id_penginapan', $this->id_penginapan);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
// delete the product
function delete(){
 
    $query = "DELETE FROM " . $this->table_name . " WHERE id_penginapan = ?";
     
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id_penginapan);
 
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
                p.id_penginapan, p.nama_penginapan, p.alamat, p.email, p.telepon
            FROM
                " . $this->table_name . " p
            WHERE
                p.nama_penginapan LIKE ? OR p.email LIKE ?
            ORDER BY
                p.a_penginapan ASC
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
                p.nama_penginapan LIKE ? OR p.email LIKE ?";
 
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