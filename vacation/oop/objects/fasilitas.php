<?php

class fasilitas{

	public $id_fasilitas, $nama_fasilitas, $deskripsi;
	private $conn;
    private $table_name = "fasilitas";

		public function __construct($db){
			$this->conn = $db;
		}
	    function create(){
        //write query
       // insert query
        $query = "INSERT INTO " . $this->table_name . "
            SET nama_fasilitas=:nama_fasilitas, deskripsi=:deskripsi";
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->nama_fasilitas=htmlspecialchars(strip_tags($this->nama_fasilitas));
        $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));
 
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":nama_fasilitas", $this->nama_fasilitas);
        $stmt->bindParam(":deskripsi", $this->deskripsi);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
	}
	function read(){
        //select all data
        $query = "SELECT
                    id_fasilitas, nama_fasilitas, deskripsi
                FROM
                    " . $this->table_name . "
                ORDER BY
                    nama_fasilitas";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
	}
	function readName(){
     
		$query = "SELECT deskripsi FROM " . $this->table_name . " WHERE id_fasilitas = ? limit 0,1";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id_fasilitas);
		$stmt->execute();
	 
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		 
		$this->deskripsi = $row['deskripsi'];
	}
	function readAll($from_record_num, $records_per_page){
 
		$query = "SELECT
					id, nama_fasilitas, deskripsi
				FROM
					" . $this->table_name . "
				ORDER BY
					nama_fasilitas ASC
				LIMIT
					{$from_record_num}, {$records_per_page}";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
	 
		return $stmt;
	}
	// used for paging products
    public function countAll(){
 
		$query = "SELECT id FROM " . $this->table_name . "";
	 
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
	 
		$num = $stmt->rowCount();
	 
		return $num;
		}
	   function readOne(){
	 
			$query = "SELECT nama_fasilitas, deskripsi
				FROM " . $this->table_name . "
				WHERE id = ?
				LIMIT 0,1";
		 
			$stmt = $this->conn->prepare( $query );
			$stmt->bindParam(1, $this->id);
			$stmt->execute();
		 
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		 
			$this->name_fasilitas = $row['nama_fasilitas'];
			$this->deskripsi = $row['deskripsi'];
		}

    public function update(){
 
	    $query = "UPDATE
	                " . $this->table_name . "
	            SET
	                fname = :parent::getFname(),
                    lname = :parent::getLname(),
                    email = :parent::getEmail(),
                    status = :parent::getLname(),
	                alamat = :alamat,
                    telepon = :telepon,
	            WHERE
	                id = :id";
	 
	    $stmt = $this->conn->prepare($query);
	 
	    // posted values
	    $this->name=htmlspecialchars(strip_tags($this->name));
	    $this->price=htmlspecialchars(strip_tags($this->price));
	    $this->description=htmlspecialchars(strip_tags($this->description));
	    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
	    $this->id=htmlspecialchars(strip_tags($this->id));

	 
	    // bind parameters
	    $stmt->bindParam(':name', $this->name);
	    $stmt->bindParam(':price', $this->price);
	    $stmt->bindParam(':description', $this->description);
	    $stmt->bindParam(':category_id', $this->category_id);


	    $stmt->bindParam(':id', $this->id);
	 
	    // execute the query
	    if($stmt->execute()){
	        return true;
	    }
	 
	    return false;
    }
// delete the product
	public function delete(){
	 
	    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
	     
	    $stmt = $this->conn->prepare($query);
	    $stmt->bindParam(1, $this->id);
	 
	    if($result = $stmt->execute()){
	        return true;
	    }else{
	        return false;
	    }
	}
	public function search($search_term, $from_record_num, $records_per_page){
 
		// select query
		$query = "SELECT
					p.id, p.nama_fasilitas, p.deskripsi
				FROM
					" . $this->table_name . " p
				WHERE
					p.nama_fasilitas LIKE ? OR p.deskripsi LIKE ?
				ORDER BY
					p.nama_fasilitas ASC
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
					p.nama_fasilitas LIKE ? OR p.deskripsi LIKE ?";
	 
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


}