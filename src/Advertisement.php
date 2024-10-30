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
        // Code to create a new advertisement
    }

    public function manageAd($adId, $adContent, $targetingInfo)
    {
        // Code to manage an existing advertisement
    }

    public function targetAd($adId, $targetingInfo)
    {
        // Code to target an advertisement
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
