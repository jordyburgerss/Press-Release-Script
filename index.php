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
        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="News">News</option>
            <option value="Updates">Updates</option>
            <option value="Events">Events</option>
        </select>
        <button type="submit">Submit</button>
    </form>
    <script>
        CKEDITOR.replace('content');
    </script>

    <h1>Press Releases</h1>
    <input type="text" id="search" placeholder="Search press releases">
    <select id="filter" onchange="filterPressReleases()">
        <option value="">All Categories</option>
        <option value="News">News</option>
        <option value="Updates">Updates</option>
        <option value="Events">Events</option>
    </select>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Link</th>
                <th>Image</th>
                <th>Category</th>
                <th>Posted On</th>
            </tr>
        </thead>
        <tbody id="press-releases">
            <?php
            $sql = "SELECT title, content, link, image, category, created_at FROM press_releases ORDER BY created_at DESC";
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
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No press releases found.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        function filterPressReleases() {
            var search = document.getElementById('search').value.toLowerCase();
            var filter = document.getElementById('filter').value;
            var rows = document.getElementById('press-releases').getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                var title = rows[i].getElementsByTagName('td')[0].innerText.toLowerCase();
                var category = rows[i].getElementsByTagName('td')[4].innerText;
                if ((title.indexOf(search) > -1 || search === "") && (category === filter || filter === "")) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
        document.getElementById('search').addEventListener('keyup', filterPressReleases);
    </script>
</body>
</html>