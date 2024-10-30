<?php

class Message
{
    #[\Attribute]
    private int $messageId;
    #[\Attribute]
    private int $senderId;
    #[\Attribute]
    private int $receiverId;
    #[\Attribute]
    private int $groupId;
    #[\Attribute]
    private string $content;
    #[\Attribute]
    private string $createdAt;
    #[\Attribute]
    private bool $readStatus;

    public function __construct(
        int $messageId,
        int $senderId,
        int $receiverId,
        int $groupId,
        string $content,
        string $createdAt,
        bool $readStatus
    ) {
        $this->messageId = $messageId;
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->groupId = $groupId;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->readStatus = $readStatus;
    }

    public function sendMessage(int $senderId, int $receiverId, int $groupId, string $content): void
    {
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->groupId = $groupId;
        $this->content = $content;
        $this->createdAt = date('Y-m-d H:i:s');
        $this->readStatus = false;

        // Code to insert the new message into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO messages (sender_id, receiver_id, group_id, content, created_at, read_status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iiissi', $this->senderId, $this->receiverId, $this->groupId, $this->content, $this->createdAt, $this->readStatus);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function receiveMessage(int $messageId): array
    {
        $this->messageId = $messageId;

        // Code to retrieve a message from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM messages WHERE message_id = ?");
        $stmt->bind_param('i', $this->messageId);
        $stmt->execute();
        $result = $stmt->get_result();
        $message = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $message;
    }

    public function manageMessage(int $messageId, string $action): void
    {
        $this->messageId = $messageId;

        // Code to manage a message (e.g., mark as read, delete)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        match ($action) {
            'markAsRead' => $stmt = $db->prepare("UPDATE messages SET read_status = TRUE WHERE message_id = ?"),
            'delete' => $stmt = $db->prepare("DELETE FROM messages WHERE message_id = ?"),
            default => throw new InvalidArgumentException("Invalid action: $action")
        };

        $stmt->bind_param('i', $this->messageId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getMessageId(): int
    {
        return $this->messageId;
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function getReceiverId(): int
    {
        return $this->receiverId;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
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
