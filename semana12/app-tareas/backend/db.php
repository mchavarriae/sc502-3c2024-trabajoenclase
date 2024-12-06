<?php
require "message_log.php";

$host = getenv('DB_HOST') !== false ? getenv('DB_HOST') : 'localhost';
$dbname = getenv('DB_NAME') !== false ? getenv('DB_NAME') : 'todo_app';
$user = getenv('DB_USER') !== false ? getenv('DB_USER') : 'dbuser';
$password = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : 'mysqlpass';

try{

    $pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    logDebug("DB: Conexion Exitosa");


}catch(PDOException $e){
    logError($e -> getMessage());
    die("Error de conexion: " . $e -> getMessage());
}