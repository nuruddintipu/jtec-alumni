<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'jtec_alumni';

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname; charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    echo 'Connected successfully';
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>