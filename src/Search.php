<?php

class Search
{
    private $searchId;
    private $userId;
    private $postId;
    private $keywords;

    public function __construct($searchId, $userId, $postId, $keywords)
    {
        $this->searchId = $searchId;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->keywords = $keywords;
    }

    public function indexContent($userId, $postId, $keywords)
    {
        // Code to index content for search functionality
    }

    public function searchContent($keywords)
    {
        // Code to search content based on keywords
    }

    public function getSearchId()
    {
        return $this->searchId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }
}
