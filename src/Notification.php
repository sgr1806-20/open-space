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
        $this->userId = $userId;
        $this->content = $content;
        $this->createdAt = date('Y-m-d H:i:s');
        $this->readStatus = false;

        // Code to insert the new notification into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO notifications (user_id, content, created_at, read_status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $this->userId, $this->content, $this->createdAt, $this->readStatus);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function retrieveNotification($notificationId)
    {
        $this->notificationId = $notificationId;

        // Code to retrieve a notification from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM notifications WHERE notification_id = ?");
        $stmt->bind_param("i", $this->notificationId);
        $stmt->execute();
        $result = $stmt->get_result();
        $notification = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $notification;
    }

    public function manageNotification($notificationId, $action)
    {
        $this->notificationId = $notificationId;

        // Code to manage a notification (e.g., mark as read, delete)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($action === 'markAsRead') {
            $stmt = $db->prepare("UPDATE notifications SET read_status = TRUE WHERE notification_id = ?");
            $stmt->bind_param("i", $this->notificationId);
        } elseif ($action === 'delete') {
            $stmt = $db->prepare("DELETE FROM notifications WHERE notification_id = ?");
            $stmt->bind_param("i", $this->notificationId);
        }

        $stmt->execute();
        $stmt->close();
        $db->close();
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
