<?php 
class modelProduct {
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
}