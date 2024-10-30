<?php

class Post
{
    private $postId;
    private $userId;
    private $content;
    private $mediaAttachments;
    private $createdAt;
    private $updatedAt;
    private $privacySettings;

    public function __construct($postId, $userId, $content, $mediaAttachments, $createdAt, $updatedAt, $privacySettings)
    {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->content = $content;
        $this->mediaAttachments = $mediaAttachments;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->privacySettings = $privacySettings;
    }

    public function createPost($userId, $content, $mediaAttachments, $privacySettings)
    {
        $this->userId = $userId;
        $this->content = $content;
        $this->mediaAttachments = $mediaAttachments;
        $this->privacySettings = $privacySettings;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new post into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO posts (user_id, content, media_attachments, created_at, privacy_settings) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $this->userId, $this->content, $this->mediaAttachments, $this->createdAt, $this->privacySettings);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function editPost($postId, $content, $mediaAttachments, $privacySettings)
    {
        $this->postId = $postId;
        $this->content = $content;
        $this->mediaAttachments = $mediaAttachments;
        $this->privacySettings = $privacySettings;
        $this->updatedAt = date('Y-m-d H:i:s');

        // Code to update the existing post in the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE posts SET content = ?, media_attachments = ?, updated_at = ?, privacy_settings = ? WHERE post_id = ?");
        $stmt->bind_param("ssssi", $this->content, $this->mediaAttachments, $this->updatedAt, $this->privacySettings, $this->postId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function deletePost($postId)
    {
        $this->postId = $postId;

        // Code to delete the post from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("DELETE FROM posts WHERE post_id = ?");
        $stmt->bind_param("i", $this->postId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getPost($postId)
    {
        $this->postId = $postId;

        // Code to retrieve the post from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM posts WHERE post_id = ?");
        $stmt->bind_param("i", $this->postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $post;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getMediaAttachments()
    {
        return $this->mediaAttachments;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getPrivacySettings()
    {
        return $this->privacySettings;
    }
}
