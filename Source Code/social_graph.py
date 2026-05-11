import mysql.connector
import networkx as nx
import matplotlib.pyplot as plt

# =========================
# CONNECT TO MYSQL
# =========================

db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="social_db"
)

cursor = db.cursor(dictionary=True)

# Directed graph because relationships point from one thing to another
G = nx.DiGraph()

# =========================
# USERS
# =========================

cursor.execute("SELECT * FROM Users")
users = cursor.fetchall()

for user in users:
    G.add_node(
        f"User_{user['user_id']}",
        label=user["username"],
        node_type="User"
    )

# =========================
# POSTS
# =========================

cursor.execute("SELECT * FROM Posts")
posts = cursor.fetchall()

for post in posts:
    post_node = f"Post_{post['post_id']}"

    G.add_node(
        post_node,
        label=f"Post {post['post_id']}",
        node_type="Post"
    )

    G.add_edge(
        f"User_{post['user_id']}",
        post_node,
        relationship="POSTED"
    )

# =========================
# FOLLOWS
# =========================

cursor.execute("SELECT * FROM Follows")
follows = cursor.fetchall()

for follow in follows:
    G.add_edge(
        f"User_{follow['follower_id']}",
        f"User_{follow['following_id']}",
        relationship="FOLLOWS"
    )

# =========================
# LIKES
# =========================

cursor.execute("SELECT * FROM Likes")
likes = cursor.fetchall()

for like in likes:
    G.add_edge(
        f"User_{like['user_id']}",
        f"Post_{like['post_id']}",
        relationship="LIKED"
    )

# =========================
# COMMENTS
# =========================

cursor.execute("SELECT * FROM Comments")
comments = cursor.fetchall()

for comment in comments:
    G.add_edge(
        f"User_{comment['user_id']}",
        f"Post_{comment['post_id']}",
        relationship="COMMENTED"
    )

# =========================
# CLUBS
# =========================

cursor.execute("SELECT * FROM Clubs")
clubs = cursor.fetchall()

for club in clubs:
    G.add_node(
        f"Club_{club['club_id']}",
        label=club["club_name"],
        node_type="Club"
    )

# =========================
# CLUB MEMBERS
# =========================

cursor.execute("SELECT * FROM ClubMembers")
club_members = cursor.fetchall()

for member in club_members:
    G.add_edge(
        f"User_{member['user_id']}",
        f"Club_{member['club_id']}",
        relationship="MEMBER_OF"
    )

# =========================
# HASHTAGS
# =========================

cursor.execute("SELECT * FROM Hashtags")
hashtags = cursor.fetchall()

for hashtag in hashtags:
    G.add_node(
        f"Hashtag_{hashtag['hashtag_id']}",
        label=hashtag["hashtag_name"],
        node_type="Hashtag"
    )

# =========================
# POST HASHTAGS
# =========================

cursor.execute("SELECT * FROM PostHashtags")
post_hashtags = cursor.fetchall()

for post_hashtag in post_hashtags:
    G.add_edge(
        f"Post_{post_hashtag['post_id']}",
        f"Hashtag_{post_hashtag['hashtag_id']}",
        relationship="HAS_HASHTAG"
    )

# =========================
# EXPORT GRAPHML
# =========================

nx.write_graphml(G, "social_media_graph.graphml")
print("GraphML exported successfully as social_media_graph.graphml")

# =========================
# DRAW GRAPH IN PYTHON
# =========================

plt.figure(figsize=(18, 12))

pos = nx.spring_layout(G, k=1.0, iterations=50)

labels = nx.get_node_attributes(G, "label")

nx.draw(
    G,
    pos,
    labels=labels,
    with_labels=True,
    node_size=2200,
    font_size=7,
    arrows=True
)

edge_labels = nx.get_edge_attributes(G, "relationship")

nx.draw_networkx_edge_labels(
    G,
    pos,
    edge_labels=edge_labels,
    font_size=5
)

plt.title("Social Media Graph Database with Clubs and Hashtags")
plt.show()

cursor.close()
db.close()
