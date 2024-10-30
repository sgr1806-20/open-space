<?php

class Privacy
{
    #[\Attribute]
    private int $settingId;
    #[\Attribute]
    private int $userId;
    #[\Attribute]
    private string $privacyOption;

    public function __construct(int $settingId, int $userId, string $privacyOption)
    {
        $this->settingId = $settingId;
        $this->userId = $userId;
        $this->privacyOption = $privacyOption;
    }

    public function managePrivacySettings(int $userId, string $privacyOption): void
    {
        $this->userId = $userId;
        $this->privacyOption = $privacyOption;

        // Code to update user privacy settings in the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("UPDATE privacy_settings SET privacy_option = ? WHERE user_id = ?");
        $stmt->bind_param(
            privacyOption: $this->privacyOption,
            userId: $this->userId
        );
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function getPrivacySettings(int $userId): array
    {
        $this->userId = $userId;

        // Code to retrieve user privacy settings from the database
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $db->prepare("SELECT * FROM privacy_settings WHERE user_id = ?");
        $stmt->bind_param(userId: $this->userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $privacySettings = $result->fetch_assoc();
        $stmt->close();
        $db->close();

        return $privacySettings;
    }

    public function getSettingId(): int
    {
        return $this->settingId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPrivacyOption(): string
    {
        return $this->privacyOption;
    }
}
