<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "accounts";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->error) {
die("Connection failed: " . $conn->error);
}

?>