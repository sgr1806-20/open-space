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
        // Code to create a new post
    }

    public function editPost($postId, $content, $mediaAttachments, $privacySettings)
    {
        // Code to edit an existing post
    }

    public function deletePost($postId)
    {
        // Code to delete a post
    }

    public function getPost($postId)
    {
        // Code to retrieve a post
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
