<?php

class User
{
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $username;
    #[\Attribute]
    private string $email;
    #[\Attribute]
    private string $password;
    #[\Attribute]
    private ?string $profileInfo;
    #[\Attribute]
    private string $createdAt;
    #[\Attribute]
    private ?string $updatedAt;

    public function __construct(
        int $userId,
        string $username,
        string $email,
        string $password,
        ?string $profileInfo,
        string $createdAt,
        ?string $updatedAt
    ) {
        $this->userId = $userId;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->profileInfo = $profileInfo;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function register(string $username, string $email, string $password): void
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->createdAt = date('Y-m-d H:i:s');

        // Code to insert the new user into the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param(
            username: $this->username,
            email: $this->email,
            password: $this->password,
            createdAt: $this->createdAt
        );
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function authenticate(string $email, string $password): bool
    {
        $this->email = $email;

        // Code to authenticate a user
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param(email: $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $user && password_verify($password, $user['password']);
    }

    public function updateProfile(int $userId, string $profileInfo): void
    {
        $this->userId = $userId;
        $this->profileInfo = $profileInfo;
        $this->updatedAt = date('Y-m-d H:i:s');

        // Code to update user profile
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE users SET profile_info = ?, updated_at = ? WHERE user_id = ?");
        $stmt->bind_param(
            profileInfo: $this->profileInfo,
            updatedAt: $this->updatedAt,
            userId: $this->userId
        );
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getProfileInfo(): ?string
    {
        return $this->profileInfo;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
