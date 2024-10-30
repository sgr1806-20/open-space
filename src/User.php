<?php

class User
{
    private $userId;
    private $username;
    private $email;
    private $password;
    private $profileInfo;
    private $createdAt;
    private $updatedAt;

    public function __construct($userId, $username, $email, $password, $profileInfo, $createdAt, $updatedAt)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->profileInfo = $profileInfo;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function register($username, $email, $password)
    {
        // Code to register a new user
    }

    public function authenticate($email, $password)
    {
        // Code to authenticate a user
    }

    public function updateProfile($userId, $profileInfo)
    {
        // Code to update user profile
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getProfileInfo()
    {
        return $this->profileInfo;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
