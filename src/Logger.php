<?php

class Logger
{
    private $logFile;
    private $logLevel;

    public function __construct($logFile, $logLevel = 'INFO')
    {
        $this->logFile = $logFile;
        $this->logLevel = $logLevel;
    }

    public function log($message, $level = 'INFO')
    {
        if ($this->shouldLog($level)) {
            $timestamp = date('Y-m-d H:i:s');
            $logMessage = "[$timestamp] [$level] $message" . PHP_EOL;
            file_put_contents($this->logFile, $logMessage, FILE_APPEND);
        }
    }

    private function shouldLog($level)
    {
        $levels = ['DEBUG', 'INFO', 'WARNING', 'ERROR'];
        $currentLevelIndex = array_search($this->logLevel, $levels);
        $messageLevelIndex = array_search($level, $levels);

        return $messageLevelIndex >= $currentLevelIndex;
    }

    public function logUserActivity($userId, $activity)
    {
        $message = "User $userId: $activity";
        $this->log($message, 'INFO');
    }

    public function logSystemPerformance($metric, $value)
    {
        $message = "System Performance - $metric: $value";
        $this->log($message, 'INFO');
    }

    public function monitorSystemPerformance()
    {
        // Code to monitor system performance
        $cpuUsage = sys_getloadavg();
        $memoryUsage = memory_get_usage(true);
        $diskUsage = disk_free_space("/");

        $this->log("CPU Usage: " . implode(", ", $cpuUsage), 'INFO');
        $this->log("Memory Usage: $memoryUsage", 'INFO');
        $this->log("Disk Usage: $diskUsage", 'INFO');
    }
}
