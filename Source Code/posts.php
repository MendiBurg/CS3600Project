<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Posts and Engagement</h1>
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
    <h2>Post Engagement</h2>

    <table>
        <tr>
            <th>Post ID</th>
            <th>Posted By</th>
            <th>Content</th>
            <th>Post Date</th>
            <th>Likes</th>
            <th>Comments</th>
        </tr>

        <?php
        $sql = "
            SELECT p.post_id,
                   u.username,
                   p.content,
                   p.post_date,
                   COUNT(DISTINCT l.like_id) AS total_likes,
                   COUNT(DISTINCT c.comment_id) AS total_comments
            FROM Posts p
            JOIN Users u ON p.user_id = u.user_id
            LEFT JOIN Likes l ON p.post_id = l.post_id
            LEFT JOIN Comments c ON p.post_id = c.post_id
            GROUP BY p.post_id, u.username, p.content, p.post_date
            ORDER BY p.post_id
        ";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["post_id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["content"] . "</td>";
            echo "<td>" . $row["post_date"] . "</td>";
            echo "<td>" . $row["total_likes"] . "</td>";
            echo "<td>" . $row["total_comments"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>