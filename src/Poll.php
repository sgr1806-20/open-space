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
        // Code to create a new poll
    }

    public function managePoll($pollId, $action)
    {
        // Code to manage a poll (e.g., update, delete)
    }

    public function retrievePoll($pollId)
    {
        // Code to retrieve a poll
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
