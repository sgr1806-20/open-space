<?php

class Analytics
{
    private $analyticsId;
    private $userId;
    private $activityType;
    private $createdAt;
    private $metrics;

    public function __construct($analyticsId, $userId, $activityType, $createdAt, $metrics)
    {
        $this->analyticsId = $analyticsId;
        $this->userId = $userId;
        $this->activityType = $activityType;
        $this->createdAt = $createdAt;
        $this->metrics = $metrics;
    }

    public function trackActivity($userId, $activityType, $metrics)
    {
        // Code to track user activity
    }

    public function reportActivity($analyticsId)
    {
        // Code to report user activity
    }

    public function getAnalyticsId()
    {
        return $this->analyticsId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getActivityType()
    {
        return $this->activityType;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getMetrics()
    {
        return $this->metrics;
    }
}
