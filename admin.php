<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Press Releases</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Manage Press Releases</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Link</th>
                <th>Image</th>
                <th>Category</th>
                <th>Posted On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT id, title, content, link, image, category, created_at FROM press_releases ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["content"] . "</td>";
                    echo "<td><a href='" . $row["link"] . "'>" . $row["link"] . "</a></td>";
                    echo "<td>";
                    if ($row["image"]) {
                        echo "<img src='" . $row["image"] . "' alt='Image' style='max-width: 100px;'>";
                    }
                    echo "</td>";
                    echo "<td>" . $row["category"] . "</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td><a href='edit_press_release.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_press_release.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No press releases found.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>