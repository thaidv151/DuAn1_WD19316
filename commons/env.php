<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL'       , 'http://localhost/DA1_WD19316/');
define('BASE_URL_ADMIN'       , 'http://localhost/DA1_WD19316/admin/');
define('BASE_URL_CLIENT'       , 'http://localhost/DA1_WD19316/client/');

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'tnm_clothes_db');  // Tên database

define('PATH_ROOT'    , __DIR__ . '/../');
