<?php
$servername = "localhost";
$username = "backlink";
$password = "Jordy353740";
$dbname = "backlink";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>