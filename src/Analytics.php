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
        $this->userId = $userId;
        $this->activityType = $activityType;
        $this->metrics = $metrics;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new user activity into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO analytics (user_id, activity_type, created_at, metrics) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $this->userId, $this->activityType, $this->createdAt, $this->metrics);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function reportActivity($analyticsId)
    {
        $this->analyticsId = $analyticsId;

        // Code to retrieve and report user activity from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM analytics WHERE analytics_id = ?");
        $stmt->bind_param("i", $this->analyticsId);
        $stmt->execute();
        $result = $stmt->get_result();
        $activity = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $activity;
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
