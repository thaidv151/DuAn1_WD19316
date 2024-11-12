<?php 

class HomeController
{   
    public $model;
    public function __construct()
    {
        $this->model = new Home;
    }
    function home(){
        require './views/home.php';
    }

}