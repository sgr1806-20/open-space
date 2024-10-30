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
        // Code to send a new message
    }

    public function receiveMessage($messageId)
    {
        // Code to receive a message
    }

    public function manageMessage($messageId, $action)
    {
        // Code to manage a message (e.g., mark as read, delete)
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
