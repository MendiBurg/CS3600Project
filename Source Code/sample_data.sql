-- =========================
-- USERS
-- =========================

INSERT INTO Users (username, email, join_date) VALUES
('Alice', 'alice@email.com', '2024-01-10'),
('Bob', 'bob@email.com', '2024-01-12'),
('Charlie', 'charlie@email.com', '2024-02-01'),
('Diana', 'diana@email.com', '2024-02-15'),
('Ethan', 'ethan@email.com', '2024-03-01'),
('Fiona', 'fiona@email.com', '2024-03-05'),
('George', 'george@email.com', '2024-03-07'),
('Hannah', 'hannah@email.com', '2024-03-10'),
('Ian', 'ian@email.com', '2024-03-12'),
('Julia', 'julia@email.com', '2024-03-14'),
('Kevin', 'kevin@email.com', '2024-03-16'),
('Lily', 'lily@email.com', '2024-03-18'),
('Mike', 'mike@email.com', '2024-03-20'),
('Nina', 'nina@email.com', '2024-03-22'),
('Oscar', 'oscar@email.com', '2024-03-25');

-- =========================
-- POSTS
-- =========================

INSERT INTO Posts (user_id, content, post_date) VALUES
(1, 'Alice first post', '2024-03-10'),
(2, 'Bob vacation photo', '2024-03-11'),
(3, 'Charlie project update', '2024-03-12'),
(4, 'Diana likes databases', '2024-03-13'),
(5, 'Ethan playing games', '2024-03-14'),
(6, 'Fiona studying Python', '2024-03-15'),
(7, 'George learning SQL', '2024-03-16'),
(8, 'Hannah posted a selfie', '2024-03-17'),
(9, 'Ian watching movies', '2024-03-18'),
(10, 'Julia practicing coding', '2024-03-19'),
(11, 'Kevin at the beach', '2024-03-20'),
(12, 'Lily reading a book', '2024-03-21'),
(13, 'Mike building a PC', '2024-03-22'),
(14, 'Nina cooking dinner', '2024-03-23'),
(15, 'Oscar hiking mountains', '2024-03-24');

-- =========================
-- FOLLOWS
-- =========================

INSERT INTO Follows (follower_id, following_id, follow_date) VALUES
(1, 2, '2024-03-01'),
(1, 3, '2024-03-01'),
(2, 1, '2024-03-02'),
(2, 4, '2024-03-03'),
(3, 1, '2024-03-04'),
(4, 5, '2024-03-05'),
(5, 1, '2024-03-06'),
(6, 2, '2024-03-07'),
(7, 3, '2024-03-08'),
(8, 4, '2024-03-09'),
(9, 5, '2024-03-10'),
(10, 6, '2024-03-11'),
(11, 7, '2024-03-12'),
(12, 8, '2024-03-13'),
(13, 9, '2024-03-14'),
(14, 10, '2024-03-15'),
(15, 11, '2024-03-16');

-- =========================
-- LIKES
-- =========================

INSERT INTO Likes (user_id, post_id, like_date) VALUES
(2, 1, '2024-03-15'),
(3, 1, '2024-03-15'),
(1, 2, '2024-03-16'),
(4, 3, '2024-03-16'),
(5, 4, '2024-03-17'),
(6, 5, '2024-03-18'),
(7, 6, '2024-03-19'),
(8, 7, '2024-03-20'),
(9, 8, '2024-03-21'),
(10, 9, '2024-03-22'),
(11, 10, '2024-03-23'),
(12, 11, '2024-03-24'),
(13, 12, '2024-03-25'),
(14, 13, '2024-03-26'),
(15, 14, '2024-03-27');

-- =========================
-- COMMENTS
-- =========================

INSERT INTO Comments (user_id, post_id, comment_text, comment_date) VALUES
(2, 1, 'Nice post!', '2024-03-15'),
(3, 1, 'I agree!', '2024-03-15'),
(1, 2, 'Looks fun!', '2024-03-16'),
(5, 3, 'Good update.', '2024-03-17'),
(6, 4, 'Very interesting!', '2024-03-18'),
(7, 5, 'Awesome picture!', '2024-03-19'),
(8, 6, 'Great work!', '2024-03-20'),
(9, 7, 'I learned this too.', '2024-03-21'),
(10, 8, 'Cool selfie!', '2024-03-22'),
(11, 9, 'Nice movie choice.', '2024-03-23'),
(12, 10, 'Coding is fun!', '2024-03-24'),
(13, 11, 'Wish I was there.', '2024-03-25'),
(14, 12, 'That book sounds good.', '2024-03-26'),
(15, 13, 'Nice PC build!', '2024-03-27'),
(1, 14, 'Looks delicious!', '2024-03-28');

-- =========================
-- CLUBS
-- =========================

INSERT INTO Clubs (club_name, club_description) VALUES
('Tech Club', 'Users interested in technology and programming'),
('Gaming Club', 'Users interested in video games'),
('Travel Club', 'Users interested in travel and adventures'),
('Food Club', 'Users interested in cooking and food'),
('Study Club', 'Users interested in school and learning');

-- =========================
-- CLUB MEMBERS
-- =========================

INSERT INTO ClubMembers (club_id, user_id, join_date) VALUES
(1, 1, '2024-04-01'),
(1, 2, '2024-04-01'),
(1, 3, '2024-04-01'),

(2, 4, '2024-04-02'),
(2, 5, '2024-04-02'),
(2, 6, '2024-04-02'),

(3, 7, '2024-04-03'),
(3, 8, '2024-04-03'),
(3, 9, '2024-04-03'),

(4, 10, '2024-04-04'),
(4, 11, '2024-04-04'),
(4, 12, '2024-04-04'),

(5, 13, '2024-04-05'),
(5, 14, '2024-04-05'),
(5, 15, '2024-04-05');

-- =========================
-- HASHTAGS
-- =========================

INSERT INTO Hashtags (hashtag_name) VALUES
('#coding'),
('#databases'),
('#travel'),
('#food'),
('#gaming'),
('#school'),
('#python'),
('#mysql'),
('#hiking'),
('#books');

-- =========================
-- POST HASHTAGS
-- =========================

INSERT INTO PostHashtags (post_id, hashtag_id) VALUES
(1, 1),
(1, 7),
(2, 3),
(3, 2),
(3, 8),
(4, 2),
(5, 5),
(6, 7),
(7, 8),
(8, 6),
(9, 5),
(10, 1),
(11, 3),
(12, 10),
(13, 1),
(14, 4),
(15, 9);