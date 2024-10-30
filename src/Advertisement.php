<?php

class Advertisement
{
    private $adId;
    private $userId;
    private $adContent;
    private $createdAt;
    private $targetingInfo;

    public function __construct($adId, $userId, $adContent, $createdAt, $targetingInfo)
    {
        $this->adId = $adId;
        $this->userId = $userId;
        $this->adContent = $adContent;
        $this->createdAt = $createdAt;
        $this->targetingInfo = $targetingInfo;
    }

    public function createAd($userId, $adContent, $targetingInfo)
    {
        $this->userId = $userId;
        $this->adContent = $adContent;
        $this->targetingInfo = $targetingInfo;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new advertisement into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO advertisements (user_id, ad_content, created_at, targeting_info) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $this->userId, $this->adContent, $this->createdAt, $this->targetingInfo);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function manageAd($adId, $adContent, $targetingInfo)
    {
        $this->adId = $adId;
        $this->adContent = $adContent;
        $this->targetingInfo = $targetingInfo;

        // Code to update the existing advertisement in the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE advertisements SET ad_content = ?, targeting_info = ? WHERE ad_id = ?");
        $stmt->bind_param("ssi", $this->adContent, $this->targetingInfo, $this->adId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function targetAd($adId, $targetingInfo)
    {
        $this->adId = $adId;
        $this->targetingInfo = $targetingInfo;

        // Code to update the targeting information of the advertisement
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE advertisements SET targeting_info = ? WHERE ad_id = ?");
        $stmt->bind_param("si", $this->targetingInfo, $this->adId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getAdId()
    {
        return $this->adId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getAdContent()
    {
        return $this->adContent;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getTargetingInfo()
    {
        return $this->targetingInfo;
    }
}
