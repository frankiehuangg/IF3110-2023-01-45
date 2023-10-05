DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS post_reports;
DROP TABLE IF EXISTS posting;
DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS resource;
DROP TABLE IF EXISTS user_reports;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    username VARCHAR(45) PRIMARY KEY,
    password VARCHAR(256) NOT NULL,
    email VARCHAR(45) UNIQUE NOT NULL,
    description VARCHAR(280),
    follower_count INTEGER DEFAULT 0,
    following_count INTEGER DEFAULT 0,
    join_date TIMESTAMP DEFAULT NOW(),
    birthday DATE,
    profile_picture_path VARCHAR(256),
    is_admin BOOLEAN DEFAULT FALSE NOT NULL
);

INSERT INTO users (username, password, email, is_admin) VALUES 
    ('user1', 'user1', 'user1@gmail.com', FALSE),
    ('user2', 'user2', 'user2@gmail.com', FALSE),
    ('admin1', 'admin1', 'admin1@gmail.com', TRUE);

CREATE TABLE user_reports (
    user_id VARCHAR(45) PRIMARY KEY REFERENCES users(username),
    description TEXT NOT NULL
);

CREATE TABLE posts (
    post_id SERIAL PRIMARY KEY,
    post_content VARCHAR(280) NOT NULL,
    post_timestamp TIMESTAMP DEFAULT NOW(),
    likes INTEGER DEFAULT 0,
    replies INTEGER DEFAULT 0,
    shares INTEGER DEFAULT 0
);

INSERT INTO posts VALUES
    (1, 'New post!', NOW(), 1, 1, 1),
    (2, 'post of the week!', NOW(), 0, 1, 1);

CREATE TABLE resources (
    post_id INTEGER REFERENCES posts(post_id),
    resource_path VARCHAR(256) NOT NULL,
    PRIMARY KEY (post_id, resource_path)
);

CREATE TABLE posting (
    username VARCHAR(45) REFERENCES users(username),
    post_id INTEGER REFERENCES posts(post_id),
    PRIMARY KEY (username, post_id)
);

CREATE TABLE post_reports (
    post_id INTEGER PRIMARY KEY REFERENCES posts(post_id),
    reporter VARCHAR(45) REFERENCES users(username),
    description TEXT NOT NULL
);

CREATE TABLE likes (
    username VARCHAR(45) REFERENCES users(username),
    post_id INTEGER REFERENCES posts(post_id),
    PRIMARY KEY (username, post_id)
);

CREATE TABLE replies (
    post_parent_id INTEGER REFERENCES posts(post_id),
    post_child_id INTEGER REFERENCES posts(post_id),
    PRIMARY KEY (post_parent_id, post_child_id)
);

CREATE TABLE follows (
    following_user VARCHAR(45) REFERENCES users(username),
    followed_user VARCHAR(45) REFERENCES users(username),
    PRIMARY KEY (following_user, followed_user)
);
