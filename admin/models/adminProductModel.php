<?php
class adminProductModel{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllCategories(){
        try {
            $sql = "SELECT * FROM categories";
            $stmt =$this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();

        } catch (Exception $e) {
            echo "Error".$e->getMessage();
        }
    }
}