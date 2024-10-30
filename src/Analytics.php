<?php

class Analytics
{
    #[\Attribute]
    private int $analyticsId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $activityType;
    #[\Attribute]
    private string $createdAt;
    #[\Attribute]
    private string $metrics;

    public function __construct(
        int $analyticsId,
        int $userId,
        string $activityType,
        string $createdAt,
        string $metrics
    ) {
        $this->analyticsId = $analyticsId;
        $this->userId = $userId;
        $this->activityType = $activityType;
        $this->createdAt = $createdAt;
        $this->metrics = $metrics;
    }

    public function trackActivity(int $userId, string $activityType, string $metrics): void
    {
        $this->userId = $userId;
        $this->activityType = $activityType;
        $this->metrics = $metrics;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new user activity into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO analytics (user_id, activity_type, created_at, metrics) VALUES (?, ?, ?, ?)");
        $stmt->bind_param(
            userId: $this->userId,
            activityType: $this->activityType,
            createdAt: $this->createdAt,
            metrics: $this->metrics
        );
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function reportActivity(int $analyticsId): array
    {
        $this->analyticsId = $analyticsId;

        // Code to retrieve and report user activity from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM analytics WHERE analytics_id = ?");
        $stmt->bind_param(analyticsId: $this->analyticsId);
        $stmt->execute();
        $result = $stmt->get_result();
        $activity = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $activity;
    }

    public function getAnalyticsId(): int
    {
        return $this->analyticsId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getActivityType(): string
    {
        return $this->activityType;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getMetrics(): string
    {
        return $this->metrics;
    }
}
