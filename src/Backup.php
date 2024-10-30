<?php

class Backup
{
    #[\Attribute]
    private int $backupId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $backupData;
    #[\Attribute]
    private string $createdAt;

    public function __construct(
        int $backupId,
        int $userId,
        string $backupData,
        string $createdAt
    ) {
        $this->backupId = $backupId;
        $this->userId = $userId;
        $this->backupData = $backupData;
        $this->createdAt = $createdAt;
    }

    public function createBackup(int $userId, string $backupData): void
    {
        $this->userId = $userId;
        $this->backupData = $backupData;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new backup into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO security (user_id, backup_info, created_at) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $this->userId, $this->backupData, $this->createdAt);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function manageBackup(int $backupId, string $action): void
    {
        $this->backupId = $backupId;

        // Code to manage a backup (e.g., delete, restore)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($action === 'delete') {
            $stmt = $db->prepare("DELETE FROM security WHERE security_id = ?");
            $stmt->bind_param('i', $this->backupId);
        } elseif ($action === 'restore') {
            // Code to restore the backup
            // This is a placeholder, actual implementation may vary
            $stmt = $db->prepare("UPDATE security SET backup_info = ? WHERE security_id = ?");
            $stmt->bind_param('si', $this->backupData, $this->backupId);
        }

        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getBackup(int $backupId): array
    {
        $this->backupId = $backupId;

        // Code to retrieve a backup
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM security WHERE security_id = ?");
        $stmt->bind_param('i', $this->backupId);
        $stmt->execute();
        $result = $stmt->get_result();
        $backup = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $backup;
    }

    public function getBackupId(): int
    {
        return $this->backupId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getBackupData(): string
    {
        return $this->backupData;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
