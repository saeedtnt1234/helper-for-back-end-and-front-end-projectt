<?php

global $conn;

$servername = "localhost";
$username = "root";
$password = "";

try {
    $options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION , PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];
    $conn = new PDO("mysql:host=$servername;dbname=mydb", $username, $password,$options);
    //echo "New record created successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}