<?php

class Event
{
    private $eventId;
    private $userId;
    private $eventDetails;
    private $createdAt;
    private $participantInfo;

    public function __construct($eventId, $userId, $eventDetails, $createdAt, $participantInfo)
    {
        $this->eventId = $eventId;
        $this->userId = $userId;
        $this->eventDetails = $eventDetails;
        $this->createdAt = $createdAt;
        $this->participantInfo = $participantInfo;
    }

    public function createEvent($userId, $eventDetails, $participantInfo)
    {
        $this->userId = $userId;
        $this->eventDetails = $eventDetails;
        $this->participantInfo = $participantInfo;
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new event into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO events (user_id, event_details, created_at, participant_info) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $this->userId, $this->eventDetails, $this->createdAt, $this->participantInfo);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function manageEvent($eventId, $action)
    {
        $this->eventId = $eventId;

        // Code to manage an event (e.g., update, delete)
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($action === 'update') {
            $stmt = $db->prepare("UPDATE events SET event_details = ?, participant_info = ? WHERE event_id = ?");
            $stmt->bind_param("ssi", $this->eventDetails, $this->participantInfo, $this->eventId);
        } elseif ($action === 'delete') {
            $stmt = $db->prepare("DELETE FROM events WHERE event_id = ?");
            $stmt->bind_param("i", $this->eventId);
        }

        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function retrieveEvent($eventId)
    {
        $this->eventId = $eventId;

        // Code to retrieve an event
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM events WHERE event_id = ?");
        $stmt->bind_param("i", $this->eventId);
        $stmt->execute();
        $result = $stmt->get_result();
        $event = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $event;
    }

    public function getEventId()
    {
        return $this->eventId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getEventDetails()
    {
        return $this->eventDetails;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getParticipantInfo()
    {
        return $this->participantInfo;
    }
}
