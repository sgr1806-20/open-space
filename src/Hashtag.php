<?php

class Hashtag
{
    #[\Attribute]
    private int $hashtagId;
    #[\Attribute]
    private string $hashtagText;
    #[\Attribute]
    private string $createdAt;

    public function __construct(int $hashtagId, string $hashtagText, string $createdAt)
    {
        $this->hashtagId = $hashtagId;
        $this->hashtagText = $hashtagText;
        $this->createdAt = $createdAt;
    }

    public function createHashtag(string $hashtagText): void
    {
        $this->hashtagText = $hashtagText;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new hashtag into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO hashtags (hashtag_text, created_at) VALUES (?, ?)");
        $stmt->bind_param(hashtagText: $this->hashtagText, createdAt: $this->createdAt);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function manageHashtag(int $hashtagId, string $hashtagText): void
    {
        $this->hashtagId = $hashtagId;
        $this->hashtagText = $hashtagText;

        // Code to update the existing hashtag in the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE hashtags SET hashtag_text = ? WHERE hashtag_id = ?");
        $stmt->bind_param(hashtagText: $this->hashtagText, hashtagId: $this->hashtagId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function retrieveHashtag(int $hashtagId): ?array
    {
        $this->hashtagId = $hashtagId;

        // Code to retrieve a hashtag from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM hashtags WHERE hashtag_id = ?");
        $stmt->bind_param(hashtagId: $this->hashtagId);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashtag = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $hashtag ?: null;
    }

    public function getHashtagId(): int
    {
        return $this->hashtagId;
    }

    public function getHashtagText(): string
    {
        return $this->hashtagText;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
