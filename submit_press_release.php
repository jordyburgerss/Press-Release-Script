<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST["title"]);
    $content = $conn->real_escape_string($_POST["content"]);
    $link = $conn->real_escape_string($_POST["link"]);
    $category = $conn->real_escape_string($_POST["category"]);

    $image = null;
    if ($_FILES["image"]["name"]) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image = $target_file;
    }

    $sql = "INSERT INTO press_releases (title, content, link, image, category) VALUES ('$title', '$content', '$link', '$image', '$category')";
    if ($conn->query($sql) === TRUE) {
        echo "New press release created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>