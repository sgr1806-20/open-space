<?php

class Notification
{
    #[\Attribute]
    private int $notificationId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $content;
    #[\Attribute]
    private string $createdAt;
    #[\Attribute]
    private bool $readStatus;

    public function __construct(
        int $notificationId,
        int $userId,
        string $content,
        string $createdAt,
        bool $readStatus
    ) {
        $this->notificationId = $notificationId;
        $this->userId = $userId;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->readStatus = $readStatus;
    }

    public function createNotification(int $userId, string $content): void
    {
        $this->userId = $userId;
        $this->content = $content;
        $this->createdAt = date('Y-m-d H:i:s');
        $this->readStatus = false;

        // Code to insert the new notification into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO notifications (user_id, content, created_at, read_status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param(
            userId: $this->userId,
            content: $this->content,
            createdAt: $this->createdAt,
            readStatus: $this->readStatus
        );
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function retrieveNotification(int $notificationId): array
    {
        $this->notificationId = $notificationId;

        // Code to retrieve a notification from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM notifications WHERE notification_id = ?");
        $stmt->bind_param(notificationId: $this->notificationId);
        $stmt->execute();
        $result = $stmt->get_result();
        $notification = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $notification;
    }

    public function manageNotification(int $notificationId, string $action): void
    {
        $this->notificationId = $notificationId;

        // Code to manage a notification (e.g., mark as read, delete)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        match ($action) {
            'markAsRead' => $stmt = $db->prepare("UPDATE notifications SET read_status = TRUE WHERE notification_id = ?"),
            'delete' => $stmt = $db->prepare("DELETE FROM notifications WHERE notification_id = ?"),
            default => throw new InvalidArgumentException("Invalid action: $action")
        };

        $stmt->bind_param(notificationId: $this->notificationId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getNotificationId(): int
    {
        return $this->notificationId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getReadStatus(): bool
    {
        return $this->readStatus;
    }
}
