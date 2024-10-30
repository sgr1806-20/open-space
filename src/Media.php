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
        $this->userId = $userId;
        $this->filePath = $filePath;
        $this->fileType = $fileType;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new media file into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO media (user_id, file_path, file_type, created_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $this->userId, $this->filePath, $this->fileType, $this->createdAt);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function retrieveMedia($mediaId)
    {
        $this->mediaId = $mediaId;

        // Code to retrieve a media file from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM media WHERE media_id = ?");
        $stmt->bind_param("i", $this->mediaId);
        $stmt->execute();
        $result = $stmt->get_result();
        $media = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $media;
    }

    public function manageMedia($mediaId, $action)
    {
        $this->mediaId = $mediaId;

        // Code to manage a media file (e.g., delete, update)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($action === 'delete') {
            $stmt = $db->prepare("DELETE FROM media WHERE media_id = ?");
            $stmt->bind_param("i", $this->mediaId);
        } elseif ($action === 'update') {
            // Code to update the media file
            // This is a placeholder, actual implementation may vary
            $stmt = $db->prepare("UPDATE media SET file_path = ?, file_type = ? WHERE media_id = ?");
            $stmt->bind_param("ssi", $this->filePath, $this->fileType, $this->mediaId);
        }

        $stmt->execute();
        $stmt->close();
        $db->close();
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
