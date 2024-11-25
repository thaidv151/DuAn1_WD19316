<?php
class clientProductController{
    public $modelProduct;
    public function __construct()
    {
        $this->modelProduct = new modelProduct;
    }
}