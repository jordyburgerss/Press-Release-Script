<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Press Releases</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<body>
    <h1>Create a Press Release</h1>
    <form action="submit_press_release.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
        <label for="link">Link:</label>
        <input type="url" id="link" name="link" required>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        <button type="submit">Submit</button>
    </form>
    <script>
        CKEDITOR.replace('content');
    </script>

    <h1>Press Releases</h1>
    <?php
    $sql = "SELECT title, content, link, image, created_at FROM press_releases ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='press-release'>";
            echo "<h2>" . $row["title"] . "</h2>";
            echo "<p>" . $row["content"] . "</p>";
            echo "<p><a href='" . $row["link"] . "'>" . $row["link"] . "</a></p>";
            if ($row["image"]) {
                echo "<p><img src='" . $row["image"] . "' alt='Image' style='max-width: 200px;'></p>";
            }
            echo "<p>Posted on: " . $row["created_at"] . "</p>";
            echo "</div><hr>";
        }
    } else {
        echo "No press releases found.";
    }

    $conn->close();
    ?>
</body>
</html>