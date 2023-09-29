DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS post_reports;
DROP TABLE IF EXISTS posting;
DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS resource;
DROP TABLE IF EXISTS user_reports;
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS pengguna;

CREATE TABLE pengguna (
    username VARCHAR(45) PRIMARY KEY,
    email VARCHAR(45) UNIQUE NOT NULL,
    password VARCHAR(256) NOT NULL
);

INSERT INTO pengguna VALUES 
    ('user1', 'user1@gmail.com', 'user1'),
    ('user2', 'user2@gmail.com', 'user2'),
    ('admin1', 'admin1@gmail.com', 'admin1');

CREATE TABLE users (
    username VARCHAR(45) PRIMARY KEY REFERENCES pengguna(username),
    description TEXT,
    birthday DATE NOT NULL,
    profile_picture_path VARCHAR(256)
);

CREATE TABLE admin (
    username VARCHAR(45) PRIMARY KEY REFERENCES pengguna(username)
);

CREATE TABLE user_reports (
    user_id VARCHAR(45) PRIMARY KEY REFERENCES users(username),
    description TEXT NOT NULL
);

CREATE TABLE resource (
    resource_id SERIAL PRIMARY KEY,
    resource_path VARCHAR(256) NOT NULL
);

CREATE TABLE post (
    post_id SERIAL PRIMARY KEY,
    post_text TEXT NOT NULL,
    like_count INTEGER DEFAULT 0,
    post_time TIMESTAMP NOT NULL,
    resource_id INTEGER REFERENCES resource(resource_id)
);

CREATE TABLE posting (
    username VARCHAR(45) REFERENCES users(username),
    post_id INTEGER REFERENCES post(post_id),
    PRIMARY KEY (username, post_id)
);

CREATE TABLE post_reports (
    post_id INTEGER PRIMARY KEY REFERENCES post(post_id),
    description TEXT NOT NULL
);

CREATE TABLE likes (
    username VARCHAR(45) REFERENCES users(username),
    post_id INTEGER REFERENCES post(post_id),
    PRIMARY KEY (username, post_id)
);

