<?php

class Hashtag
{
    private $hashtagId;
    private $hashtagText;
    private $createdAt;

    public function __construct($hashtagId, $hashtagText, $createdAt)
    {
        $this->hashtagId = $hashtagId;
        $this->hashtagText = $hashtagText;
        $this->createdAt = $createdAt;
    }

    public function createHashtag($hashtagText)
    {
        $this->hashtagText = $hashtagText;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new hashtag into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO hashtags (hashtag_text, created_at) VALUES (?, ?)");
        $stmt->bind_param("ss", $this->hashtagText, $this->createdAt);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function manageHashtag($hashtagId, $hashtagText)
    {
        $this->hashtagId = $hashtagId;
        $this->hashtagText = $hashtagText;

        // Code to update the existing hashtag in the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE hashtags SET hashtag_text = ? WHERE hashtag_id = ?");
        $stmt->bind_param("si", $this->hashtagText, $this->hashtagId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function retrieveHashtag($hashtagId)
    {
        $this->hashtagId = $hashtagId;

        // Code to retrieve a hashtag from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM hashtags WHERE hashtag_id = ?");
        $stmt->bind_param("i", $this->hashtagId);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashtag = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $hashtag;
    }

    public function getHashtagId()
    {
        return $this->hashtagId;
    }

    public function getHashtagText()
    {
        return $this->hashtagText;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
