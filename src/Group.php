<?php

class Group
{
    private $groupId;
    private $userId;
    private $groupDetails;
    private $createdAt;

    public function __construct($groupId, $userId, $groupDetails, $createdAt)
    {
        $this->groupId = $groupId;
        $this->userId = $userId;
        $this->groupDetails = $groupDetails;
        $this->createdAt = $createdAt;
    }

    public function createGroup($userId, $groupDetails)
    {
        // Code to create a new group
    }

    public function manageGroup($groupId, $action)
    {
        // Code to manage a group (e.g., update, delete)
    }

    public function retrieveGroup($groupId)
    {
        // Code to retrieve a group
    }

    public function getGroupId()
    {
        return $this->groupId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getGroupDetails()
    {
        return $this->groupDetails;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
