<?php

class Group
{
    #[\Attribute]
    private int $groupId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $groupDetails;
    #[\Attribute]
    private string $createdAt;

    public function __construct(
        int $groupId,
        int $userId,
        string $groupDetails,
        string $createdAt
    ) {
        $this->groupId = $groupId;
        $this->userId = $userId;
        $this->groupDetails = $groupDetails;
        $this->createdAt = $createdAt;
    }

    public function createGroup(int $userId, string $groupDetails): void
    {
        $this->userId = $userId;
        $this->groupDetails = $groupDetails;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new group into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO groups (user_id, group_details, created_at) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $this->userId, $this->groupDetails, $this->createdAt);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function manageGroup(int $groupId, string $action): void
    {
        $this->groupId = $groupId;

        // Code to manage a group (e.g., update, delete)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        match ($action) {
            'update' => $stmt = $db->prepare("UPDATE groups SET group_details = ? WHERE group_id = ?"),
            'delete' => $stmt = $db->prepare("DELETE FROM groups WHERE group_id = ?"),
            default => throw new InvalidArgumentException("Invalid action: $action")
        };

        if ($action === 'update') {
            $stmt->bind_param('si', $this->groupDetails, $this->groupId);
        } else {
            $stmt->bind_param('i', $this->groupId);
        }

        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function retrieveGroup(int $groupId): array
    {
        $this->groupId = $groupId;

        // Code to retrieve a group
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM groups WHERE group_id = ?");
        $stmt->bind_param('i', $this->groupId);
        $stmt->execute();
        $result = $stmt->get_result();
        $group = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $group;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getGroupDetails(): string
    {
        return $this->groupDetails;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
