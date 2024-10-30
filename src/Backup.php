<?php

class Backup
{
    private $backupId;
    private $userId;
    private $backupData;
    private $createdAt;

    public function __construct($backupId, $userId, $backupData, $createdAt)
    {
        $this->backupId = $backupId;
        $this->userId = $userId;
        $this->backupData = $backupData;
        $this->createdAt = $createdAt;
    }

    public function createBackup($userId, $backupData)
    {
        // Code to create a new backup
    }

    public function manageBackup($backupId, $action)
    {
        // Code to manage a backup (e.g., delete, restore)
    }

    public function getBackup($backupId)
    {
        // Code to retrieve a backup
    }

    public function getBackupId()
    {
        return $this->backupId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getBackupData()
    {
        return $this->backupData;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
