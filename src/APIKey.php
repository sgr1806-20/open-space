<?php

class APIKey
{
    private $keyId;
    private $userId;
    private $apiKey;
    private $createdAt;

    public function __construct($keyId, $userId, $apiKey, $createdAt)
    {
        $this->keyId = $keyId;
        $this->userId = $userId;
        $this->apiKey = $apiKey;
        $this->createdAt = $createdAt;
    }

    public function generateKey($userId)
    {
        $this->userId = $userId;
        $this->apiKey = bin2hex(random_bytes(16));
        $this->createdAt = date('Y-m-d H:i:s');
        // Code to save the generated API key to the database
    }

    public function validateKey($apiKey)
    {
        // Code to validate an API key
        // This should check if the provided API key exists in the database and is associated with a valid user
    }

    public function getKeyId()
    {
        return $this->keyId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
