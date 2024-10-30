CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    profile_info TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE friends (
    user_id INT,
    friend_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, friend_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (friend_id) REFERENCES users(user_id)
);

CREATE INDEX idx_friends_user_id ON friends(user_id);
CREATE INDEX idx_friends_friend_id ON friends(friend_id);

CREATE TABLE messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    receiver_id INT,
    group_id INT,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    read_status BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (sender_id) REFERENCES users(user_id),
    FOREIGN KEY (receiver_id) REFERENCES users(user_id),
    FOREIGN KEY (group_id) REFERENCES groups(group_id)
);

CREATE INDEX idx_messages_sender_id ON messages(sender_id);
CREATE INDEX idx_messages_receiver_id ON messages(receiver_id);
CREATE INDEX idx_messages_group_id ON messages(group_id);

CREATE TABLE posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    content TEXT,
    media_attachments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    privacy_settings VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE INDEX idx_posts_user_id ON posts(user_id);

CREATE TABLE comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    user_id INT,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE INDEX idx_comments_post_id ON comments(post_id);
CREATE INDEX idx_comments_user_id ON comments(user_id);

CREATE TABLE likes (
    like_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_id INT,
    comment_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (comment_id) REFERENCES comments(comment_id)
);

CREATE INDEX idx_likes_user_id ON likes(user_id);
CREATE INDEX idx_likes_post_id ON likes(post_id);
CREATE INDEX idx_likes_comment_id ON likes(comment_id);

CREATE TABLE notifications (
    notification_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    read_status BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE INDEX idx_notifications_user_id ON notifications(user_id);

CREATE TABLE search_index (
    search_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_id INT,
    keywords TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (post_id) REFERENCES posts(post_id)
);

CREATE INDEX idx_search_index_user_id ON search_index(user_id);
CREATE INDEX idx_search_index_post_id ON search_index(post_id);

CREATE TABLE privacy_settings (
    setting_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    privacy_option VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE INDEX idx_privacy_settings_user_id ON privacy_settings(user_id);

CREATE TABLE media (
    media_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    file_path TEXT,
    file_type VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE INDEX idx_media_user_id ON media(user_id);

CREATE TABLE events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    event_details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    participant_info TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE INDEX idx_events_user_id ON events(user_id);

CREATE TABLE groups (
    group_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    group_details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE INDEX idx_groups_user_id ON groups(user_id);

CREATE TABLE polls (
    poll_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    poll_details TEXT,
    options TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE INDEX idx_polls_user_id ON polls(user_id);

CREATE TABLE hashtags (
    hashtag_id INT AUTO_INCREMENT PRIMARY KEY,
    hashtag_text VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE analytics (
    analytics_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    activity_type VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    metrics TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE INDEX idx_analytics_user_id ON analytics(user_id);

CREATE TABLE advertisements (
    ad_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    ad_content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    targeting_info TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE INDEX idx_advertisements_user_id ON advertisements(user_id);

CREATE TABLE api_keys (
    key_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    api_key VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE INDEX idx_api_keys_user_id ON api_keys(user_id);

CREATE TABLE security (
    security_id INT AUTO_INCREMENT PRIMARY KEY,
    encryption_key TEXT,
    rate_limiting_data TEXT,
    content_moderation_reports TEXT,
    backup_info TEXT,
    performance_metrics TEXT
);
