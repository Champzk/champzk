<?php
// config.php

$host = 'localhost';        // Database host
$dbname = 'emailus';        // Database name
$username = 'root';         // Database username (default 'root' for local server)
$password = 'root';             // Database password (leave empty for local servers)

try {
    // Establish a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
