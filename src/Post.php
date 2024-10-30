<?php

class Post
{
    #[\Attribute]
    private int $postId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $content;
    #[\Attribute]
    private string $mediaAttachments;
    #[\Attribute]
    private string $createdAt;
    #[\Attribute]
    private string $updatedAt;
    #[\Attribute]
    private string $privacySettings;

    public function __construct(
        int $postId,
        int $userId,
        string $content,
        string $mediaAttachments,
        string $createdAt,
        string $updatedAt,
        string $privacySettings
    ) {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->content = $content;
        $this->mediaAttachments = $mediaAttachments;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->privacySettings = $privacySettings;
    }

    public function createPost(int $userId, string $content, string $mediaAttachments, string $privacySettings): void
    {
        $this->userId = $userId;
        $this->content = $content;
        $this->mediaAttachments = $mediaAttachments;
        $this->privacySettings = $privacySettings;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new post into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO posts (user_id, content, media_attachments, created_at, privacy_settings) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('issss', $this->userId, $this->content, $this->mediaAttachments, $this->createdAt, $this->privacySettings);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function editPost(int $postId, string $content, string $mediaAttachments, string $privacySettings): void
    {
        $this->postId = $postId;
        $this->content = $content;
        $this->mediaAttachments = $mediaAttachments;
        $this->privacySettings = $privacySettings;
        $this->updatedAt = date('Y-m-d H:i:s');

        // Code to update the existing post in the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE posts SET content = ?, media_attachments = ?, updated_at = ?, privacy_settings = ? WHERE post_id = ?");
        $stmt->bind_param('ssssi', $this->content, $this->mediaAttachments, $this->updatedAt, $this->privacySettings, $this->postId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function deletePost(int $postId): void
    {
        $this->postId = $postId;

        // Code to delete the post from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("DELETE FROM posts WHERE post_id = ?");
        $stmt->bind_param('i', $this->postId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getPost(int $postId): array
    {
        $this->postId = $postId;

        // Code to retrieve the post from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM posts WHERE post_id = ?");
        $stmt->bind_param('i', $this->postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $post;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getMediaAttachments(): string
    {
        return $this->mediaAttachments;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getPrivacySettings(): string
    {
        return $this->privacySettings;
    }
}
