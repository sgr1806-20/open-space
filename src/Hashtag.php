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
        // Code to create a new hashtag
    }

    public function manageHashtag($hashtagId, $hashtagText)
    {
        // Code to manage an existing hashtag
    }

    public function retrieveHashtag($hashtagId)
    {
        // Code to retrieve a hashtag
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
