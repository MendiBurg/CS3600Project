<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Hashtags</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Post Hashtags</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="following.php">Following</a>
    <a href="posts.php">Posts</a>
    <a href="hashtags.php">Hashtags</a>
    <a href="clubs.php">Clubs</a>
    <a href="queries.php">Queries</a>
</nav>

<div class="container">
    <h2>Hashtags Assigned to Posts</h2>

    <table>
        <tr>
            <th>Post ID</th>
            <th>Post Content</th>
            <th>Hashtag</th>
        </tr>

        <?php
        $sql = "
            SELECT p.post_id,
                   p.content,
                   h.hashtag_name
            FROM PostHashtags ph
            JOIN Posts p ON ph.post_id = p.post_id
            JOIN Hashtags h ON ph.hashtag_id = h.hashtag_id
            ORDER BY p.post_id
        ";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["post_id"] . "</td>";
            echo "<td>" . $row["content"] . "</td>";
            echo "<td>" . $row["hashtag_name"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>