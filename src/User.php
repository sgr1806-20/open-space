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
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new user into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->username, $this->email, $this->password, $this->createdAt);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function authenticate($email, $password)
    {
        $this->email = $email;

        // Code to authenticate a user
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProfile($userId, $profileInfo)
    {
        $this->userId = $userId;
        $this->profileInfo = $profileInfo;
        $this->updatedAt = date('Y-m-d H:i:s');

        // Code to update user profile
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE users SET profile_info = ?, updated_at = ? WHERE user_id = ?");
        $stmt->bind_param("ssi", $this->profileInfo, $this->updatedAt, $this->userId);
        $stmt->execute();
        $stmt->close();
        $db->close();
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
