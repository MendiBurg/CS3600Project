<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Following Relationships</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Following Relationships</h1>
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
    <h2>Who Follows Who</h2>

    <table>
        <tr>
            <th>Follower</th>
            <th>Following</th>
            <th>Follow Date</th>
        </tr>

        <?php
        $sql = "
            SELECT u1.username AS follower,
                   u2.username AS following,
                   f.follow_date
            FROM Follows f
            JOIN Users u1 ON f.follower_id = u1.user_id
            JOIN Users u2 ON f.following_id = u2.user_id
            ORDER BY f.follow_date
        ";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["follower"] . "</td>";
            echo "<td>" . $row["following"] . "</td>";
            echo "<td>" . $row["follow_date"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>