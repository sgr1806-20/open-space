<?php

require_once 'config.php';
require_once 'src/User.php';
require_once 'src/Post.php';
require_once 'src/Message.php';
require_once 'src/Event.php';
require_once 'src/Group.php';
require_once 'src/Poll.php';
require_once 'src/Advertisement.php';
require_once 'src/Analytics.php';
require_once 'src/Backup.php';
require_once 'src/Compliance.php';
require_once 'src/Logger.php';
require_once 'src/Security.php';
require_once 'terminal.php';

$logger = new Logger('test_terminal.log');

function simulateInput($input) {
    $tempFile = tempnam(sys_get_temp_dir(), 'input');
    file_put_contents($tempFile, $input);
    return $tempFile;
}

function captureOutput($command) {
    ob_start();
    passthru($command);
    $output = ob_get_clean();
    return $output;
}

function runTest($description, $input, $expectedOutput) {
    global $logger;

    $logger->log("Running test: $description");

    $inputFile = simulateInput($input);
    $output = captureOutput("php terminal.php < $inputFile");

    if (trim($output) === trim($expectedOutput)) {
        echo "Test passed: $description\n";
        $logger->log("Test passed: $description");
    } else {
        echo "Test failed: $description\n";
        echo "Expected: $expectedOutput\n";
        echo "Got: $output\n";
        $logger->log("Test failed: $description");
        $logger->log("Expected: $expectedOutput");
        $logger->log("Got: $output");
    }

    unlink($inputFile);
}

// Test cases
runTest(
    "User registration",
    "register testuser testuser@example.com password\nexit\n",
    "User registered successfully.\n"
);

runTest(
    "User authentication",
    "login testuser@example.com password\nexit\n",
    "User authenticated successfully.\n"
);

runTest(
    "Create post",
    "createPost 1 'This is a test post' '' 'public'\nexit\n",
    "Post created successfully.\n"
);

runTest(
    "Edit post",
    "editPost 1 'This is an edited test post' '' 'public'\nexit\n",
    "Post edited successfully.\n"
);

runTest(
    "Delete post",
    "deletePost 1\nexit\n",
    "Post deleted successfully.\n"
);

runTest(
    "Send message",
    "sendMessage 1 2 0 'Hello, this is a test message'\nexit\n",
    "Message sent successfully.\n"
);

runTest(
    "Receive message",
    "receiveMessage 1\nexit\n",
    "Message received successfully.\n"
);

runTest(
    "Create event",
    "createEvent 1 'Test Event' 'Participant Info'\nexit\n",
    "Event created successfully.\n"
);

runTest(
    "Manage event",
    "manageEvent 1 'update'\nexit\n",
    "Event managed successfully.\n"
);

runTest(
    "Create group",
    "createGroup 1 'Test Group'\nexit\n",
    "Group created successfully.\n"
);

runTest(
    "Manage group",
    "manageGroup 1 'update'\nexit\n",
    "Group managed successfully.\n"
);

runTest(
    "Create poll",
    "createPoll 1 'Test Poll' 'Option1,Option2'\nexit\n",
    "Poll created successfully.\n"
);

runTest(
    "Manage poll",
    "managePoll 1 'update'\nexit\n",
    "Poll managed successfully.\n"
);

runTest(
    "Create advertisement",
    "createAd 1 'Test Ad' 'Targeting Info'\nexit\n",
    "Advertisement created successfully.\n"
);

runTest(
    "Manage advertisement",
    "manageAd 1 'Updated Ad' 'Updated Targeting Info'\nexit\n",
    "Advertisement managed successfully.\n"
);

runTest(
    "Track activity",
    "trackActivity 1 'Test Activity' 'Metrics'\nexit\n",
    "Activity tracked successfully.\n"
);

runTest(
    "Report activity",
    "reportActivity 1\nexit\n",
    "Activity reported successfully.\n"
);

runTest(
    "Create backup",
    "createBackup 1 'Backup Data'\nexit\n",
    "Backup created successfully.\n"
);

runTest(
    "Manage backup",
    "manageBackup 1 'delete'\nexit\n",
    "Backup managed successfully.\n"
);

runTest(
    "Ensure GDPR compliance",
    "ensureGDPRCompliance 1\nexit\n",
    "GDPR compliance ensured successfully.\n"
);

runTest(
    "Manage user data",
    "manageUserData 1 'delete'\nexit\n",
    "User data managed successfully.\n"
);

runTest(
    "Log user activity",
    "logUserActivity 1 'Test Activity'\nexit\n",
    "User activity logged successfully.\n"
);

runTest(
    "Log system performance",
    "logSystemPerformance 'Metric' 'Value'\nexit\n",
    "System performance logged successfully.\n"
);

runTest(
    "Monitor system performance",
    "monitorSystemPerformance\nexit\n",
    "System performance monitored successfully.\n"
);

runTest(
    "Encrypt data",
    "encryptData 'Sensitive Data'\nexit\n",
    "Data encrypted successfully: " . (new Security(ENCRYPTION_KEY, null, null))->encryptData('Sensitive Data') . "\n"
);

runTest(
    "Decrypt data",
    "decryptData '" . (new Security(ENCRYPTION_KEY, null, null))->encryptData('Sensitive Data') . "'\nexit\n",
    "Data decrypted successfully: Sensitive Data\n"
);

runTest(
    "Apply rate limit",
    "applyRateLimit 1\nexit\n",
    "Rate limit applied successfully.\n"
);

runTest(
    "Moderate content",
    "moderateContent 'Test Content'\nexit\n",
    "Content moderated successfully.\n"
);

?>
