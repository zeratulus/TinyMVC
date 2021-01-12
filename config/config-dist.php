<?php

define('MYSQL_TIMESTAMP', 'Y-m-d H:i:s');

define('DIR_CACHE', APP_DIR . 'storage/cache/');
define('DIR_LOG', APP_DIR . 'storage/logs/');
define('DIR_UPLOAD', APP_DIR . 'storage/uploads/');

//define('TWIG_CACHE', DIR_CACHE . '/twig/');
define('TWIG_CACHE', false);
define('DEV', true);

define('LOG_MAIN', DIR_LOG . 'main.log');

//DB
define('DB_DRIVER', 'pdo_mysql');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_DATABASE', 'database');
define('DB_USER', 'root');
define('DB_PASSWORD', 'password');
define('DB_CHARSET', 'utf8mb4');

//Mail
define('SMTP_HOST', '');
define('SMTP_PORT', '');
define('SMTP_USER', '');
define('SMTP_PASSWORD', '');