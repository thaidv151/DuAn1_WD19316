<?php

class adminController {
    public $modelHomeAdmin;
    public function __construct()
    {
        $this->modelHomeAdmin = new adminModel;
    }
    public function homeAdmin(){
        $orderInDay = $this->modelHomeAdmin->getOrderByDayNow();
        debug($orderInDay);
        $orderInWeek = $this->modelHomeAdmin->getOrderByWeekNow();
        $orderInMonth = $this->modelHomeAdmin->getOrderByMonthNow();

      
        require './views/homeAdmin.php';
    }
    
}