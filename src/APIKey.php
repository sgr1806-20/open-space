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
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO api_keys (user_id, api_key, created_at) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $this->userId, $this->apiKey, $this->createdAt);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function validateKey($apiKey)
    {
        $this->apiKey = $apiKey;

        // Code to validate an API key
        // This should check if the provided API key exists in the database and is associated with a valid user
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM api_keys WHERE api_key = ?");
        $stmt->bind_param("s", $this->apiKey);
        $stmt->execute();
        $result = $stmt->get_result();
        $isValid = $result->num_rows > 0;
        $stmt->close();
        $db->close();

        return $isValid;
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
