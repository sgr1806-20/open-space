<?php

class Search
{
    #[\Attribute]
    private int $searchId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private int $postId;
    #[\Attribute]
    private string $keywords;

    public function __construct(
        int $searchId,
        int $userId,
        int $postId,
        string $keywords
    ) {
        $this->searchId = $searchId;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->keywords = $keywords;
    }

    public function indexContent(int $userId, int $postId, string $keywords): void
    {
        $this->userId = $userId;
        $this->postId = $postId;
        $this->keywords = $keywords;

        // Code to index content for search functionality
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO search_index (user_id, post_id, keywords) VALUES (?, ?, ?)");
        $stmt->bind_param(
            userId: $this->userId,
            postId: $this->postId,
            keywords: $this->keywords
        );
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function searchContent(string $keywords): array
    {
        $this->keywords = $keywords;

        // Code to search content based on keywords
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM search_index WHERE keywords LIKE ?");
        $searchTerm = "%" . $this->keywords . "%";
        $stmt->bind_param(searchTerm: $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $searchResults = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $db->close();

        return $searchResults;
    }

    public function getSearchId(): int
    {
        return $this->searchId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getKeywords(): string
    {
        return $this->keywords;
    }
}
