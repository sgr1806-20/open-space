<?php

class Poll
{
    #[\Attribute]
    private int $pollId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $pollDetails;
    #[\Attribute]
    private string $options;
    #[\Attribute]
    private string $createdAt;

    public function __construct(
        int $pollId,
        int $userId,
        string $pollDetails,
        string $options,
        string $createdAt
    ) {
        $this->pollId = $pollId;
        $this->userId = $userId;
        $this->pollDetails = $pollDetails;
        $this->options = $options;
        $this->createdAt = $createdAt;
    }

    public function createPoll(int $userId, string $pollDetails, string $options): void
    {
        $this->userId = $userId;
        $this->pollDetails = $pollDetails;
        $this->options = $options;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new poll into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO polls (user_id, poll_details, options, created_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('isss', $this->userId, $this->pollDetails, $this->options, $this->createdAt);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function managePoll(int $pollId, string $action): void
    {
        $this->pollId = $pollId;

        // Code to manage a poll (e.g., update, delete)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        match ($action) {
            'update' => $stmt = $db->prepare("UPDATE polls SET poll_details = ?, options = ? WHERE poll_id = ?"),
            'delete' => $stmt = $db->prepare("DELETE FROM polls WHERE poll_id = ?"),
            default => throw new InvalidArgumentException("Invalid action: $action")
        };

        if ($action === 'update') {
            $stmt->bind_param('ssi', $this->pollDetails, $this->options, $this->pollId);
        } else {
            $stmt->bind_param('i', $this->pollId);
        }

        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function retrievePoll(int $pollId): array
    {
        $this->pollId = $pollId;

        // Code to retrieve a poll
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM polls WHERE poll_id = ?");
        $stmt->bind_param('i', $this->pollId);
        $stmt->execute();
        $result = $stmt->get_result();
        $poll = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $poll;
    }

    public function getPollId(): int
    {
        return $this->pollId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPollDetails(): string
    {
        return $this->pollDetails;
    }

    public function getOptions(): string
    {
        return $this->options;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
