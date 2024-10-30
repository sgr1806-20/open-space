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
        // Code to manage user privacy settings
    }

    public function getPrivacySettings($userId)
    {
        // Code to retrieve user privacy settings
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
