<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $conn->real_escape_string($_POST["id"]);
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

    $sql = "UPDATE press_releases SET title='$title', content='$content', link='$link', image='$image', category='$category' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Press release updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    $id = $_GET["id"];
    $sql = "SELECT * FROM press_releases WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Press Release</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Edit Press Release</h1>
    <form action="edit_press_release.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?php echo $row['content']; ?></textarea>
        <label for="link">Link:</label>
        <input type="url" id="link" name="link" value="<?php echo $row['link']; ?>" required>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="News" <?php if ($row['category'] == 'News') echo 'selected'; ?>>News</option>
            <option value="Updates" <?php if ($row['category'] == 'Updates') echo 'selected'; ?>>Updates</option>
            <option value="Events" <?php if ($row['category'] == 'Events') echo 'selected'; ?>>Events</option>
        </select>
        <button type="submit">Update</button>
    </form>
</body>
</html>