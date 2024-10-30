<?php

class Message
{
    private $messageId;
    private $senderId;
    private $receiverId;
    private $groupId;
    private $content;
    private $createdAt;
    private $readStatus;

    public function __construct($messageId, $senderId, $receiverId, $groupId, $content, $createdAt, $readStatus)
    {
        $this->messageId = $messageId;
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->groupId = $groupId;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->readStatus = $readStatus;
    }

    public function sendMessage($senderId, $receiverId, $groupId, $content)
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
        $stmt->bind_param("iiissi", $this->senderId, $this->receiverId, $this->groupId, $this->content, $this->createdAt, $this->readStatus);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function receiveMessage($messageId)
    {
        $this->messageId = $messageId;

        // Code to retrieve a message from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM messages WHERE message_id = ?");
        $stmt->bind_param("i", $this->messageId);
        $stmt->execute();
        $result = $stmt->get_result();
        $message = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $message;
    }

    public function manageMessage($messageId, $action)
    {
        $this->messageId = $messageId;

        // Code to manage a message (e.g., mark as read, delete)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($action === 'markAsRead') {
            $stmt = $db->prepare("UPDATE messages SET read_status = TRUE WHERE message_id = ?");
            $stmt->bind_param("i", $this->messageId);
        } elseif ($action === 'delete') {
            $stmt = $db->prepare("DELETE FROM messages WHERE message_id = ?");
            $stmt->bind_param("i", $this->messageId);
        }

        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getMessageId()
    {
        return $this->messageId;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function getReceiverId()
    {
        return $this->receiverId;
    }

    public function getGroupId()
    {
        return $this->groupId;
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
