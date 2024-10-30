<?php

class APIKey
{
    #[\Attribute]
    private int $keyId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $apiKey;
    #[\Attribute]
    private string $createdAt;

    public function __construct(
        int $keyId,
        int $userId,
        string $apiKey,
        string $createdAt
    ) {
        $this->keyId = $keyId;
        $this->userId = $userId;
        $this->apiKey = $apiKey;
        $this->createdAt = $createdAt;
    }

    public function generateKey(int $userId): void
    {
        $this->userId = $userId;
        $this->apiKey = bin2hex(random_bytes(16));
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to save the generated API key to the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO api_keys (user_id, api_key, created_at) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $this->userId, $this->apiKey, $this->createdAt);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function validateKey(string $apiKey): bool
    {
        $this->apiKey = $apiKey;

        // Code to validate an API key
        // This should check if the provided API key exists in the database and is associated with a valid user
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM api_keys WHERE api_key = ?");
        $stmt->bind_param('s', $this->apiKey);
        $stmt->execute();
        $result = $stmt->get_result();
        $isValid = $result->num_rows > 0;
        $stmt->close();
        $db->close();

        return $isValid;
    }

    public function getKeyId(): int
    {
        return $this->keyId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
