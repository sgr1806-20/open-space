<?php

class Media
{
    private $mediaId;
    private $userId;
    private $filePath;
    private $fileType;
    private $createdAt;

    public function __construct($mediaId, $userId, $filePath, $fileType, $createdAt)
    {
        $this->mediaId = $mediaId;
        $this->userId = $userId;
        $this->filePath = $filePath;
        $this->fileType = $fileType;
        $this->createdAt = $createdAt;
    }

    public function uploadMedia($userId, $filePath, $fileType)
    {
        // Code to upload a media file
    }

    public function retrieveMedia($mediaId)
    {
        // Code to retrieve a media file
    }

    public function manageMedia($mediaId, $action)
    {
        // Code to manage a media file (e.g., delete, update)
    }

    public function getMediaId()
    {
        return $this->mediaId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function getFileType()
    {
        return $this->fileType;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
