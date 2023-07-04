<?php
class Employee{
    // Connection
    private $conn;
    // Table
    private $db_table = "Employee";
    // Columns
    public $id;
    public $nama_tanaman;
    public $deskripsi;
    public $media_tanam;
    public $masalah_umum;
    public $created;
    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }
    // GET ALL
    public function getEmployees(){
        $sqlQuery = "SELECT id, nama_tanaman, deskripsi, media_tanam, masalah_umum, created FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
    public function createEmployee(){
        $sqlQuery = "INSERT INTO
                    ". $this->db_table ."
                SET
                    nama_tanaman = :nama_tanaman, 
                    deskripsi = :deskripsi, 
                    media_tanam = :media_tanam, 
                    masalah_umum = :masalah_umum, 
                    created = :created";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->nama_tanaman=htmlspecialchars(strip_tags($this->nama_tanaman));
        $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));
        $this->media_tanam=htmlspecialchars(strip_tags($this->media_tanam));
        $this->masalah_umum=htmlspecialchars(strip_tags($this->masalah_umum));
        $this->created=htmlspecialchars(strip_tags($this->created));

        // bind data
        $stmt->bindParam(":nama_tanaman", $this->nama_tanaman);
        $stmt->bindParam(":deskripsi", $this->deskripsi);
        $stmt->bindParam(":media_tanam", $this->media_tanam);
        $stmt->bindParam(":masalah_umum", $this->masalah_umum);
        $stmt->bindParam(":created", $this->created);

        if($stmt->execute()){
           return true;
        }
        return false;
    }
    // READ single
    public function getSingleEmployee(){
        $sqlQuery = "SELECT
                    id, 
                    nama_tanaman, 
                    deskripsi, 
                    media_tanam, 
                    masalah_umum, 
                    created
                  FROM
                    ". $this->db_table ."
                WHERE 
                   id = ?
                LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->nama_tanaman = $dataRow['nama_tanaman'];
        $this->deskripsi = $dataRow['deskripsi'];
        $this->media_tanam = $dataRow['media_tanam'];
        $this->masalah_umum = $dataRow['masalah_umum'];
        $this->created = $dataRow['created'];
    }        
    // UPDATE
     // UPDATE
     public function updateEmployee(){
        $sqlQuery = "UPDATE
                    ". $this->db_table ."
                SET
                    nama_tanaman = :nama_tanaman, 
                    deskripsi = :deskripsi, 
                    media_tanam = :media_tanam, 
                    masalah_umum = :masalah_umum , 
                    created = :created
                WHERE 
                    id = :id";
    
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->nama_tanaman=htmlspecialchars(strip_tags($this->nama_tanaman));
        $this-> deskripsi =htmlspecialchars(strip_tags($this-> deskripsi ));
        $this->media_tanam=htmlspecialchars(strip_tags($this->media_tanam));
        $this->masalah_umum=htmlspecialchars(strip_tags($this->masalah_umum));
        $this->created=htmlspecialchars(strip_tags($this->created));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind data
        $stmt->bindParam(":nama_tanaman", $this->nama_tanaman);
        $stmt->bindParam(":deskripsi", $this->deskripsi);
        $stmt->bindParam(":media_tanam", $this->age);
        $stmt->bindParam(":masalah_umum", $this->masalah_umum);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":id", $this->id);
    
        if($stmt->execute()){
           return true;
        }
        return false;
    }
    // DELETE
    public function deleteEmployee(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>
