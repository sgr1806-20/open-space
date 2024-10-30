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
        // Code to create a new event
    }

    public function manageEvent($eventId, $action)
    {
        // Code to manage an event (e.g., update, delete)
    }

    public function retrieveEvent($eventId)
    {
        // Code to retrieve an event
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
