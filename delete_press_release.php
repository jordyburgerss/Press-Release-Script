<?php
include 'config.php';

$id = $_GET["id"];
$sql = "DELETE FROM press_releases WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    echo "Press release deleted successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
header("Location: admin.php");
exit();
?>