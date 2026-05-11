<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Clubs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Clubs and Members</h1>
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
    <h2>Club Memberships</h2>

    <table>
        <tr>
            <th>Club</th>
            <th>Description</th>
            <th>Member</th>
            <th>Join Date</th>
        </tr>

        <?php
        $sql = "
            SELECT c.club_name,
                   c.club_description,
                   u.username,
                   cm.join_date
            FROM ClubMembers cm
            JOIN Clubs c ON cm.club_id = c.club_id
            JOIN Users u ON cm.user_id = u.user_id
            ORDER BY c.club_id, u.username
        ";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["club_name"] . "</td>";
            echo "<td>" . $row["club_description"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["join_date"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>