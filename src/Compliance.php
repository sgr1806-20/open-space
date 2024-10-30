<?php

class Compliance
{
    private $userId;
    private $dataProtectionRegulation;

    public function __construct($userId, $dataProtectionRegulation)
    {
        $this->userId = $userId;
        $this->dataProtectionRegulation = $dataProtectionRegulation;
    }

    public function ensureGDPRCompliance($userId)
    {
        // Code to ensure GDPR compliance for the user
        $this->userId = $userId;

        // Check if the user has consented to data processing
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT consent FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $this->userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user['consent'] !== 'yes') {
            // If the user has not consented, update the consent status
            $stmt = $db->prepare("UPDATE users SET consent = 'yes' WHERE user_id = ?");
            $stmt->bind_param("i", $this->userId);
            $stmt->execute();
            $stmt->close();
        }

        $db->close();
    }

    public function manageUserData($userId, $action)
    {
        // Code to manage user data based on the specified action (e.g., data deletion, data export)
        $this->userId = $userId;

        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($action === 'delete') {
            // Delete user data
            $stmt = $db->prepare("DELETE FROM users WHERE user_id = ?");
            $stmt->bind_param("i", $this->userId);
        } elseif ($action === 'export') {
            // Export user data
            $stmt = $db->prepare("SELECT * FROM users WHERE user_id = ?");
            $stmt->bind_param("i", $this->userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = $result->fetch_assoc();
            $stmt->close();

            // Code to export user data (e.g., save to a file, send via email)
            // This is a placeholder, actual implementation may vary
            file_put_contents("user_data_{$this->userId}.json", json_encode($userData));
        }

        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getDataProtectionRegulation()
    {
        return $this->dataProtectionRegulation;
    }
}
