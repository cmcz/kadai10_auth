<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$config = require 'config.php';

try {
    $pdo = new PDO(
        'mysql:dbname=' . $config['dbname'] . ';charset=utf8;host=' . $config['host'],
        $config['username'],
        $config['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('DB_CONNECTION_ERROR' . $e->getMessage());
}
?>