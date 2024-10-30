<?php

class Security
{
    #[\Attribute]
    private string $encryptionKey;
    #[\Attribute]
    private bool $rateLimit;
    #[\Attribute]
    private bool $contentModeration;

    public function __construct(
        string $encryptionKey,
        bool $rateLimit,
        bool $contentModeration
    ) {
        $this->encryptionKey = $encryptionKey;
        $this->rateLimit = $rateLimit;
        $this->contentModeration = $contentModeration;
    }

    public function encryptData(string $data): string
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(cipher_algo: ENCRYPTION_ALGORITHM));
        $encryptedData = openssl_encrypt(
            data: $data,
            cipher_algo: ENCRYPTION_ALGORITHM,
            passphrase: $this->encryptionKey,
            options: 0,
            iv: $iv
        );
        return base64_encode($encryptedData . '::' . $iv);
    }

    public function decryptData(string $encryptedData): string
    {
        list($encryptedData, $iv) = explode('::', base64_decode($encryptedData), 2);
        return openssl_decrypt(
            data: $encryptedData,
            cipher_algo: ENCRYPTION_ALGORITHM,
            passphrase: $this->encryptionKey,
            options: 0,
            iv: $iv
        );
    }

    public function applyRateLimit(int $userId): void
    {
        // Placeholder code for applying rate limiting
        // Actual implementation may vary
        $this->rateLimit = true;
    }

    public function moderateContent(string $content): void
    {
        // Placeholder code for moderating content
        // Actual implementation may vary
        $this->contentModeration = true;
    }

    public function getEncryptionKey(): string
    {
        return $this->encryptionKey;
    }

    public function getRateLimit(): bool
    {
        return $this->rateLimit;
    }

    public function getContentModeration(): bool
    {
        return $this->contentModeration;
    }
}
