<?php   //pdo DB handler

$host = 'database'; //localhost
$dbname = 'db';
$dsn = "mysql:host=$host;port=3306;dbname=$dbname;";
$dbUserName = 'admin';
$dbPassword = '123123';


try {
    $pdo = new PDO($dsn, $dbUserName, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}