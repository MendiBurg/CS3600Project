<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Database Queries</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Database Queries</h1>
    <p>Select a query to display graph database results</p>
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

    <form method="GET" action="queries.php">
        <label for="query_choice"><strong>Choose a query:</strong></label>

        <select name="query_choice" id="query_choice">
            <option value="most_followed">Most Followed Users</option>
            <option value="most_active">Most Active Users</option>
            <option value="post_engagement">Post Engagement</option>
            <option value="post_interactions">Who Interacted With Each Post</option>
        </select>

        <button type="submit">Run Query</button>
    </form>

    <hr>

    <?php
    $query_choice = isset($_GET["query_choice"]) ? $_GET["query_choice"] : "most_followed";

    if ($query_choice == "most_followed") {
        echo "<h2>Most Followed Users</h2>";

        $sql = "
            SELECT u.username, COUNT(f.follower_id) AS follower_count
            FROM Users u
            LEFT JOIN Follows f ON u.user_id = f.following_id
            GROUP BY u.user_id, u.username
            ORDER BY follower_count DESC
        ";

        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        echo "<table>";
        echo "<tr><th>Username</th><th>Follower Count</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["follower_count"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }

    else if ($query_choice == "most_active") {
        echo "<h2>Most Active Users</h2>";

        $sql = "
            SELECT u.username,
                   COUNT(DISTINCT l.like_id) AS likes_given,
                   COUNT(DISTINCT c.comment_id) AS comments_made,
                   COUNT(DISTINCT l.like_id) + COUNT(DISTINCT c.comment_id) AS total_activity
            FROM Users u
            LEFT JOIN Likes l ON u.user_id = l.user_id
            LEFT JOIN Comments c ON u.user_id = c.user_id
            GROUP BY u.user_id, u.username
            ORDER BY total_activity DESC
        ";

        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        echo "<table>";
        echo "<tr><th>Username</th><th>Likes Given</th><th>Comments Made</th><th>Total Activity</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["likes_given"] . "</td>";
            echo "<td>" . $row["comments_made"] . "</td>";
            echo "<td>" . $row["total_activity"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }

    else if ($query_choice == "post_engagement") {
        echo "<h2>Post Engagement</h2>";

        $sql = "
            SELECT p.post_id,
                   u.username AS posted_by,
                   p.content,
                   COUNT(DISTINCT l.like_id) AS total_likes,
                   COUNT(DISTINCT c.comment_id) AS total_comments,
                   COUNT(DISTINCT l.like_id) + COUNT(DISTINCT c.comment_id) AS engagement_score
            FROM Posts p
            JOIN Users u ON p.user_id = u.user_id
            LEFT JOIN Likes l ON p.post_id = l.post_id
            LEFT JOIN Comments c ON p.post_id = c.post_id
            GROUP BY p.post_id, u.username, p.content, p.post_date
            ORDER BY engagement_score DESC
        ";

        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        echo "<table>";
        echo "<tr><th>Post ID</th><th>Posted By</th><th>Content</th><th>Likes</th><th>Comments</th><th>Engagement Score</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["post_id"] . "</td>";
            echo "<td>" . $row["posted_by"] . "</td>";
            echo "<td>" . $row["content"] . "</td>";
            echo "<td>" . $row["total_likes"] . "</td>";
            echo "<td>" . $row["total_comments"] . "</td>";
            echo "<td>" . $row["engagement_score"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }

    else if ($query_choice == "post_interactions") {
        echo "<h2>Who Interacted With Each Post</h2>";

        $sql = "
            SELECT p.post_id,
                   p.content,
                   u.username AS interacted_user,
                   'Liked' AS interaction_type
            FROM Likes l
            JOIN Users u ON l.user_id = u.user_id
            JOIN Posts p ON l.post_id = p.post_id

            UNION

            SELECT p.post_id,
                   p.content,
                   u.username AS interacted_user,
                   'Commented' AS interaction_type
            FROM Comments c
            JOIN Users u ON c.user_id = u.user_id
            JOIN Posts p ON c.post_id = p.post_id

            ORDER BY post_id, interacted_user
        ";

        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        echo "<table>";
        echo "<tr><th>Post ID</th><th>Content</th><th>User</th><th>Interaction Type</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["post_id"] . "</td>";
            echo "<td>" . $row["content"] . "</td>";
            echo "<td>" . $row["interacted_user"] . "</td>";
            echo "<td>" . $row["interaction_type"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>

</div>

</body>
</html>