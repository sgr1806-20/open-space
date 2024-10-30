<?php

class Media
{
    #[\Attribute]
    private int $mediaId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $filePath;
    #[\Attribute]
    private string $fileType;
    #[\Attribute]
    private string $createdAt;

    public function __construct(
        int $mediaId,
        int $userId,
        string $filePath,
        string $fileType,
        string $createdAt
    ) {
        $this->mediaId = $mediaId;
        $this->userId = $userId;
        $this->filePath = $filePath;
        $this->fileType = $fileType;
        $this->createdAt = $createdAt;
    }

    public function uploadMedia(int $userId, string $filePath, string $fileType): void
    {
        $this->userId = $userId;
        $this->filePath = $filePath;
        $this->fileType = $fileType;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new media file into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO media (user_id, file_path, file_type, created_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('isss', $this->userId, $this->filePath, $this->fileType, $this->createdAt);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function retrieveMedia(int $mediaId): array
    {
        $this->mediaId = $mediaId;

        // Code to retrieve a media file from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM media WHERE media_id = ?");
        $stmt->bind_param('i', $this->mediaId);
        $stmt->execute();
        $result = $stmt->get_result();
        $media = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $media;
    }

    public function manageMedia(int $mediaId, string $action): void
    {
        $this->mediaId = $mediaId;

        // Code to manage a media file (e.g., delete, update)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        match ($action) {
            'delete' => $stmt = $db->prepare("DELETE FROM media WHERE media_id = ?"),
            'update' => $stmt = $db->prepare("UPDATE media SET file_path = ?, file_type = ? WHERE media_id = ?"),
            default => throw new InvalidArgumentException("Invalid action: $action")
        };

        if ($action === 'update') {
            $stmt->bind_param('ssi', $this->filePath, $this->fileType, $this->mediaId);
        } else {
            $stmt->bind_param('i', $this->mediaId);
        }

        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getMediaId(): int
    {
        return $this->mediaId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function getFileType(): string
    {
        return $this->fileType;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
