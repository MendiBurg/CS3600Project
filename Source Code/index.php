<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Social Media Graph Database</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Social Media Graph Database</h1>
    <p>Users, follows, posts, clubs, and hashtags</p>
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
    <h2>All Users</h2>

    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Join Date</th>
        </tr>

        <?php
        $sql = "SELECT * FROM Users";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["join_date"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>