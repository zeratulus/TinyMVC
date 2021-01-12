<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = isFrameworkDebug() ? true : false;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$doctrine_config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/Entity/"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

// database configuration parameters
$db_config = array(
	'dbname' => DB_DATABASE,
	'user' => DB_USER,
	'password' => DB_PASSWORD,
	'host' => DB_HOST,
	'driver' => DB_DRIVER,
	'charset' => DB_CHARSET
);

// obtaining the entity manager
$entityManager = EntityManager::create($db_config, $doctrine_config);