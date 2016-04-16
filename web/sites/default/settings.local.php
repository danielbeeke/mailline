<?php
//
//$databases['default']['default'] = array (
//    'database' => 'mailline',
//    'username' => 'root',
//    'password' => 'jos-lite-k',
//    'prefix' => '',
//    'host' => 'localhost',
//    'port' => '3306',
//    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
//    'driver' => 'mysql',
//);

$settings['trusted_host_patterns'] = array(
    'mailline.daniel'
);

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$settings['container_yamls'][] = 'sites/development.services.yml';
$settings['cache']['bins']['render'] = 'cache.backend.null';
$config['system.logging']['error_level'] = 'verbose';
