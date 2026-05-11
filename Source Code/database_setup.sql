CREATE DATABASE social_db;

USE social_db;

-- =========================
-- USERS
-- =========================

CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    join_date DATE
);

-- =========================
-- POSTS
-- =========================

CREATE TABLE Posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT,
    post_date DATE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- =========================
-- FOLLOWS
-- =========================

CREATE TABLE Follows (
    follow_id INT AUTO_INCREMENT PRIMARY KEY,
    follower_id INT NOT NULL,
    following_id INT NOT NULL,
    follow_date DATE,
    FOREIGN KEY (follower_id) REFERENCES Users(user_id),
    FOREIGN KEY (following_id) REFERENCES Users(user_id)
);

-- =========================
-- LIKES
-- =========================

CREATE TABLE Likes (
    like_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    like_date DATE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (post_id) REFERENCES Posts(post_id)
);

-- =========================
-- COMMENTS
-- =========================

CREATE TABLE Comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    comment_text TEXT,
    comment_date DATE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (post_id) REFERENCES Posts(post_id)
);

-- =========================
-- CLUBS
-- =========================

CREATE TABLE Clubs (
    club_id INT AUTO_INCREMENT PRIMARY KEY,
    club_name VARCHAR(100) NOT NULL,
    club_description TEXT
);

-- =========================
-- CLUB MEMBERS
-- =========================

CREATE TABLE ClubMembers (
    club_member_id INT AUTO_INCREMENT PRIMARY KEY,
    club_id INT NOT NULL,
    user_id INT NOT NULL,
    join_date DATE
);

-- =========================
-- HASHTAGS
-- =========================

CREATE TABLE Hashtags (
    hashtag_id INT AUTO_INCREMENT PRIMARY KEY,
    hashtag_name VARCHAR(50) NOT NULL
);

-- =========================
-- POST HASHTAGS
-- =========================

CREATE TABLE PostHashtags (
    post_hashtag_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    hashtag_id INT NOT NULL
);