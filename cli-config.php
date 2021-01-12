<?php

define('APP_DIR', __DIR__ . '/');

//Doctrine CLI Config file
require_once 'vendor/autoload.php';
require_once 'config/config.php';
require_once 'src/Helpers/general.php';
require_once 'src/doctrine.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);