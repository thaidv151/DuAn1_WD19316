<?php
class adminModel{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
}