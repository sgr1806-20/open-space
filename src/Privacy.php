<?php

class Privacy
{
    private $settingId;
    private $userId;
    private $privacyOption;

    public function __construct($settingId, $userId, $privacyOption)
    {
        $this->settingId = $settingId;
        $this->userId = $userId;
        $this->privacyOption = $privacyOption;
    }

    public function managePrivacySettings($userId, $privacyOption)
    {
        $this->userId = $userId;
        $this->privacyOption = $privacyOption;

        // Code to update user privacy settings in the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE privacy_settings SET privacy_option = ? WHERE user_id = ?");
        $stmt->bind_param("si", $this->privacyOption, $this->userId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getPrivacySettings($userId)
    {
        $this->userId = $userId;

        // Code to retrieve user privacy settings from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM privacy_settings WHERE user_id = ?");
        $stmt->bind_param("i", $this->userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $privacySettings = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $privacySettings;
    }

    public function getSettingId()
    {
        return $this->settingId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getPrivacyOption()
    {
        return $this->privacyOption;
    }
}
