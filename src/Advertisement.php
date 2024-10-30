<?php

class Advertisement
{
    #[\Attribute]
    private int $adId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $adContent;
    #[\Attribute]
    private string $createdAt;
    #[\Attribute]
    private string $targetingInfo;

    public function __construct(
        int $adId,
        int $userId,
        string $adContent,
        string $createdAt,
        string $targetingInfo
    ) {
        $this->adId = $adId;
        $this->userId = $userId;
        $this->adContent = $adContent;
        $this->createdAt = $createdAt;
        $this->targetingInfo = $targetingInfo;
    }

    public function createAd(int $userId, string $adContent, string $targetingInfo): void
    {
        $this->userId = $userId;
        $this->adContent = $adContent;
        $this->targetingInfo = $targetingInfo;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new advertisement into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO advertisements (user_id, ad_content, created_at, targeting_info) VALUES (?, ?, ?, ?)");
        $stmt->bind_param(
            userId: $this->userId,
            adContent: $this->adContent,
            createdAt: $this->createdAt,
            targetingInfo: $this->targetingInfo
        );
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function manageAd(int $adId, string $adContent, string $targetingInfo): void
    {
        $this->adId = $adId;
        $this->adContent = $adContent;
        $this->targetingInfo = $targetingInfo;

        // Code to update the existing advertisement in the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE advertisements SET ad_content = ?, targeting_info = ? WHERE ad_id = ?");
        $stmt->bind_param(
            adContent: $this->adContent,
            targetingInfo: $this->targetingInfo,
            adId: $this->adId
        );
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function targetAd(int $adId, string $targetingInfo): void
    {
        $this->adId = $adId;
        $this->targetingInfo = $targetingInfo;

        // Code to update the targeting information of the advertisement
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE advertisements SET targeting_info = ? WHERE ad_id = ?");
        $stmt->bind_param(
            targetingInfo: $this->targetingInfo,
            adId: $this->adId
        );
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getAdId(): int
    {
        return $this->adId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAdContent(): string
    {
        return $this->adContent;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getTargetingInfo(): string
    {
        return $this->targetingInfo;
    }
}
