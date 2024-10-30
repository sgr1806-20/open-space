<?php

class Logger
{
    #[\Attribute]
    private string $logFile;
    #[\Attribute]
    private string $logLevel;
    #[\Attribute]
    private int $maxFileSize;

    public function __construct(string $logFile, string $logLevel = 'INFO', int $maxFileSize = 1048576)
    {
        $this->logFile = $logFile;
        $this->logLevel = $logLevel;
        $this->maxFileSize = $maxFileSize;
    }

    public function log(string $message, string $level = 'INFO'): void
    {
        if ($this->shouldLog(level: $level)) {
            $timestamp = date('Y-m-d H:i:s');
            $logMessage = "[$timestamp] [$level] $message" . PHP_EOL;
            $this->rotateLogFile();
            file_put_contents(filename: $this->logFile, data: $logMessage, flags: FILE_APPEND);
        }
    }

    private function shouldLog(string $level): bool
    {
        $levels = ['DEBUG', 'INFO', 'WARNING', 'ERROR'];
        $currentLevelIndex = array_search(needle: $this->logLevel, haystack: $levels);
        $messageLevelIndex = array_search(needle: $level, haystack: $levels);

        return $messageLevelIndex >= $currentLevelIndex;
    }

    private function rotateLogFile(): void
    {
        if (file_exists(filename: $this->logFile) && filesize(filename: $this->logFile) >= $this->maxFileSize) {
            $backupFile = $this->logFile . '.' . time();
            rename(from: $this->logFile, to: $backupFile);
        }
    }

    public function logUserActivity(int $userId, string $activity): void
    {
        $message = "User $userId: $activity";
        $this->log(message: $message, level: 'INFO');
    }

    public function logSystemPerformance(string $metric, string $value): void
    {
        $message = "System Performance - $metric: $value";
        $this->log(message: $message, level: 'INFO');
    }

    public function monitorSystemPerformance(): void
    {
        // Code to monitor system performance
        $cpuUsage = sys_getloadavg();
        $memoryUsage = memory_get_usage(true);
        $diskUsage = disk_free_space("/");

        $this->log(message: "CPU Usage: " . implode(", ", $cpuUsage), level: 'INFO');
        $this->log(message: "Memory Usage: $memoryUsage", level: 'INFO');
        $this->log(message: "Disk Usage: $diskUsage", level: 'INFO');
    }
}
