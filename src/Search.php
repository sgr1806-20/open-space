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
        $this->userId = $userId;
        $this->postId = $postId;
        $this->keywords = $keywords;

        // Code to index content for search functionality
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO search_index (user_id, post_id, keywords) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $this->userId, $this->postId, $this->keywords);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function searchContent($keywords)
    {
        $this->keywords = $keywords;

        // Code to search content based on keywords
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM search_index WHERE keywords LIKE ?");
        $searchTerm = "%" . $this->keywords . "%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $searchResults = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $db->close();

        return $searchResults;
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
