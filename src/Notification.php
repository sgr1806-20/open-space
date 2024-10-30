<?php

class Notification
{
    private $notificationId;
    private $userId;
    private $content;
    private $createdAt;
    private $readStatus;

    public function __construct($notificationId, $userId, $content, $createdAt, $readStatus)
    {
        $this->notificationId = $notificationId;
        $this->userId = $userId;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->readStatus = $readStatus;
    }

    public function createNotification($userId, $content)
    {
        // Code to create a new notification
    }

    public function retrieveNotification($notificationId)
    {
        // Code to retrieve a notification
    }

    public function manageNotification($notificationId, $action)
    {
        // Code to manage a notification (e.g., mark as read, delete)
    }

    public function getNotificationId()
    {
        return $this->notificationId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getReadStatus()
    {
        return $this->readStatus;
    }
}
