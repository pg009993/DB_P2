<?php
// lines below create variables for server name, db, username, password
//common.php creates the connection to the employee database. 
$servername = 'localhost';
$dbname = 'employees';
$username = 'root';
$password = 'root';
try {
    $conn = new PDO("mysql:host=" . $GLOBALS['servername'] . ";dbname=" . $GLOBALS['dbname'], $GLOBALS['username'], $GLOBALS['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
$conn = null;
?>