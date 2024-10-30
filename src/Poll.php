<?php

class Poll
{
    private $pollId;
    private $userId;
    private $pollDetails;
    private $options;
    private $createdAt;

    public function __construct($pollId, $userId, $pollDetails, $options, $createdAt)
    {
        $this->pollId = $pollId;
        $this->userId = $userId;
        $this->pollDetails = $pollDetails;
        $this->options = $options;
        $this->createdAt = $createdAt;
    }

    public function createPoll($userId, $pollDetails, $options)
    {
        $this->userId = $userId;
        $this->pollDetails = $pollDetails;
        $this->options = $options;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new poll into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO polls (user_id, poll_details, options, created_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $this->userId, $this->pollDetails, $this->options, $this->createdAt);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function managePoll($pollId, $action)
    {
        $this->pollId = $pollId;

        // Code to manage a poll (e.g., update, delete)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($action === 'update') {
            $stmt = $db->prepare("UPDATE polls SET poll_details = ?, options = ? WHERE poll_id = ?");
            $stmt->bind_param("ssi", $this->pollDetails, $this->options, $this->pollId);
        } elseif ($action === 'delete') {
            $stmt = $db->prepare("DELETE FROM polls WHERE poll_id = ?");
            $stmt->bind_param("i", $this->pollId);
        }

        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function retrievePoll($pollId)
    {
        $this->pollId = $pollId;

        // Code to retrieve a poll
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM polls WHERE poll_id = ?");
        $stmt->bind_param("i", $this->pollId);
        $stmt->execute();
        $result = $stmt->get_result();
        $poll = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $poll;
    }

    public function getPollId()
    {
        return $this->pollId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getPollDetails()
    {
        return $this->pollDetails;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
