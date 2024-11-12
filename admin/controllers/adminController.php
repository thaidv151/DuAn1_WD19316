<?php

class adminController {
    public $model;
    public function __construct()
    {
        $this->model = new adminModel;
    }
    public function homeAdmin(){
        require './views/homeAdmin.php';
    }
}