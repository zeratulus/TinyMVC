<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);

//get root app path
define('APP_DIR', __DIR__ . '/');

require_once 'vendor/autoload.php';
require_once 'config/config.php';
require_once 'src/framework.php';