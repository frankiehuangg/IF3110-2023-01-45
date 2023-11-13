DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS post_reports;
DROP TABLE IF EXISTS posting;
DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS resource;
DROP TABLE IF EXISTS user_reports;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(45) UNIQUE NOT NULL,
    password VARCHAR(256) NOT NULL,
    email VARCHAR(45) UNIQUE NOT NULL,
    description VARCHAR(280),
    display_name VARCHAR(45),
    follower_count INTEGER DEFAULT 0,
    following_count INTEGER DEFAULT 0,
    join_date TIMESTAMP DEFAULT NOW(),
    birthday_date INTEGER,
    birthday_month INTEGER,
    birthday_year INTEGER,
    profile_picture_path VARCHAR(256) DEFAULT '/public/images/default.jpg',
    is_admin BOOLEAN DEFAULT FALSE NOT NULL
);

CREATE TABLE user_reports (
    report_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(user_id) ON DELETE CASCADE,
    reporter INT REFERENCES users(user_id) ON DELETE CASCADE,
    description TEXT NOT NULL,
    status TEXT NOT NULL DEFAULT 'waiting', 
    CHECK(status = 'waiting' OR status = 'rejected' OR status = 'accepted')
);


CREATE TABLE posts (
    post_id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(user_id) ON DELETE CASCADE,
    post_content VARCHAR(280) NOT NULL,
    post_timestamp TIMESTAMP DEFAULT NOW(),
    likes INTEGER DEFAULT 0,
    replies INTEGER DEFAULT 0,
    shares INTEGER DEFAULT 0
);

CREATE TABLE resources (
    post_id INTEGER REFERENCES posts(post_id) ON DELETE CASCADE,
    resource_path VARCHAR(256) NOT NULL,
    PRIMARY KEY (post_id, resource_path)
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

-- INSERT

INSERT INTO users (username, password, email, is_admin) VALUES 
    ('user1', 'user1', 'user1@gmail.com', FALSE),
    ('user2', 'user2', 'user2@gmail.com', FALSE),
    ('admin1', 'admin1', 'admin1@gmail.com', TRUE);

INSERT INTO posts VALUES
    (1, 1, 'New post!', NOW(), 1, 1, 1),
    (2, 1, 'post of the week!', NOW(), 0, 1, 1),
    (3, 2, 'amongus', NOW(), 0, 1, 1);

INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');
INSERT INTO user_reports (user_id, reporter, description) VALUES (1, 2, 'test');

-- TRIGGER

UPDATE posts AS p
SET likes = (
    SELECT COUNT(*)
    FROM likes AS l
    WHERE l.post_id = p.post_id
);

CREATE OR REPLACE FUNCTION increase_likes_count()
RETURNS TRIGGER
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE posts AS p
    SET likes = likes + 1
    WHERE p.post_id = NEW.post_id;
    RETURN NEW;
END;
$$;

CREATE TRIGGER increase_likes_count_trigger
AFTER INSERT ON likes
FOR EACH ROW
EXECUTE FUNCTION increase_likes_count();

CREATE OR REPLACE FUNCTION decrease_likes_count()
RETURNS TRIGGER
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE posts AS p
    SET likes = likes - 1
    WHERE p.post_id = OLD.post_id;
    RETURN OLD;
END;
$$;

CREATE TRIGGER decrease_likes_count_trigger
AFTER DELETE ON likes
FOR EACH ROW
EXECUTE FUNCTION decrease_likes_count();
