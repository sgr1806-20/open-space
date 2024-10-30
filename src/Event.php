<?php

class Event
{
    #[\Attribute]
    private int $eventId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $eventDetails;
    #[\Attribute]
    private string $createdAt;
    #[\Attribute]
    private string $participantInfo;

    public function __construct(
        int $eventId,
        int $userId,
        string $eventDetails,
        string $createdAt,
        string $participantInfo
    ) {
        $this->eventId = $eventId;
        $this->userId = $userId;
        $this->eventDetails = $eventDetails;
        $this->createdAt = $createdAt;
        $this->participantInfo = $participantInfo;
    }

    public function createEvent(int $userId, string $eventDetails, string $participantInfo): void
    {
        $this->userId = $userId;
        $this->eventDetails = $eventDetails;
        $this->participantInfo = $participantInfo;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new event into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO events (user_id, event_details, created_at, participant_info) VALUES (?, ?, ?, ?)");
        $stmt->bind_param(
            userId: $this->userId,
            eventDetails: $this->eventDetails,
            createdAt: $this->createdAt,
            participantInfo: $this->participantInfo
        );
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function manageEvent(int $eventId, string $action): void
    {
        $this->eventId = $eventId;

        // Code to manage an event (e.g., update, delete)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        match ($action) {
            'update' => $stmt = $db->prepare("UPDATE events SET event_details = ?, participant_info = ? WHERE event_id = ?"),
            'delete' => $stmt = $db->prepare("DELETE FROM events WHERE event_id = ?"),
            default => throw new InvalidArgumentException("Invalid action: $action")
        };

        if ($action === 'update') {
            $stmt->bind_param(
                eventDetails: $this->eventDetails,
                participantInfo: $this->participantInfo,
                eventId: $this->eventId
            );
        } else {
            $stmt->bind_param(eventId: $this->eventId);
        }

        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function retrieveEvent(int $eventId): array
    {
        $this->eventId = $eventId;

        // Code to retrieve an event
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM events WHERE event_id = ?");
        $stmt->bind_param(eventId: $this->eventId);
        $stmt->execute();
        $result = $stmt->get_result();
        $event = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $event;
    }

    public function getEventId(): int
    {
        return $this->eventId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getEventDetails(): string
    {
        return $this->eventDetails;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getParticipantInfo(): string
    {
        return $this->participantInfo;
    }
}
