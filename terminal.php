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

$logger = new Logger('terminal.log');

function authenticate($email, $password) {
    $user = new User(null, null, $email, $password, null, null, null);
    return $user->authenticate($email, $password);
}

function handleCommand($command, $args) {
    global $logger;

    try {
        switch ($command) {
            case 'register':
                $user = new User(null, $args[0], $args[1], $args[2], null, null, null);
                $user->register($args[0], $args[1], $args[2]);
                echo "User registered successfully.\n";
                break;
            case 'login':
                if (authenticate($args[0], $args[1])) {
                    echo "User authenticated successfully.\n";
                } else {
                    echo "Authentication failed.\n";
                }
                break;
            case 'createPost':
                $post = new Post(null, $args[0], $args[1], $args[2], null, null, $args[3]);
                $post->createPost($args[0], $args[1], $args[2], $args[3]);
                echo "Post created successfully.\n";
                break;
            case 'editPost':
                $post = new Post($args[0], null, $args[1], $args[2], null, null, $args[3]);
                $post->editPost($args[0], $args[1], $args[2], $args[3]);
                echo "Post edited successfully.\n";
                break;
            case 'deletePost':
                $post = new Post($args[0], null, null, null, null, null, null);
                $post->deletePost($args[0]);
                echo "Post deleted successfully.\n";
                break;
            case 'sendMessage':
                $message = new Message(null, $args[0], $args[1], $args[2], $args[3], null, null);
                $message->sendMessage($args[0], $args[1], $args[2], $args[3]);
                echo "Message sent successfully.\n";
                break;
            case 'receiveMessage':
                $message = new Message($args[0], null, null, null, null, null, null);
                $message->receiveMessage($args[0]);
                echo "Message received successfully.\n";
                break;
            case 'createEvent':
                $event = new Event(null, $args[0], $args[1], null, $args[2]);
                $event->createEvent($args[0], $args[1], $args[2]);
                echo "Event created successfully.\n";
                break;
            case 'manageEvent':
                $event = new Event($args[0], null, null, null, null);
                $event->manageEvent($args[0], $args[1]);
                echo "Event managed successfully.\n";
                break;
            case 'createGroup':
                $group = new Group(null, $args[0], $args[1], null);
                $group->createGroup($args[0], $args[1]);
                echo "Group created successfully.\n";
                break;
            case 'manageGroup':
                $group = new Group($args[0], null, null, null);
                $group->manageGroup($args[0], $args[1]);
                echo "Group managed successfully.\n";
                break;
            case 'createPoll':
                $poll = new Poll(null, $args[0], $args[1], $args[2], null);
                $poll->createPoll($args[0], $args[1], $args[2]);
                echo "Poll created successfully.\n";
                break;
            case 'managePoll':
                $poll = new Poll($args[0], null, null, null, null);
                $poll->managePoll($args[0], $args[1]);
                echo "Poll managed successfully.\n";
                break;
            case 'createAd':
                $ad = new Advertisement(null, $args[0], $args[1], null, $args[2]);
                $ad->createAd($args[0], $args[1], $args[2]);
                echo "Advertisement created successfully.\n";
                break;
            case 'manageAd':
                $ad = new Advertisement($args[0], null, $args[1], null, $args[2]);
                $ad->manageAd($args[0], $args[1], $args[2]);
                echo "Advertisement managed successfully.\n";
                break;
            case 'trackActivity':
                $analytics = new Analytics(null, $args[0], $args[1], null, $args[2]);
                $analytics->trackActivity($args[0], $args[1], $args[2]);
                echo "Activity tracked successfully.\n";
                break;
            case 'reportActivity':
                $analytics = new Analytics($args[0], null, null, null, null);
                $analytics->reportActivity($args[0]);
                echo "Activity reported successfully.\n";
                break;
            case 'createBackup':
                $backup = new Backup(null, $args[0], $args[1], null);
                $backup->createBackup($args[0], $args[1]);
                echo "Backup created successfully.\n";
                break;
            case 'manageBackup':
                $backup = new Backup($args[0], null, null, null);
                $backup->manageBackup($args[0], $args[1]);
                echo "Backup managed successfully.\n";
                break;
            case 'ensureGDPRCompliance':
                $compliance = new Compliance($args[0], null);
                $compliance->ensureGDPRCompliance($args[0]);
                echo "GDPR compliance ensured successfully.\n";
                break;
            case 'manageUserData':
                $compliance = new Compliance($args[0], null);
                $compliance->manageUserData($args[0], $args[1]);
                echo "User data managed successfully.\n";
                break;
            case 'logUserActivity':
                $logger->logUserActivity($args[0], $args[1]);
                echo "User activity logged successfully.\n";
                break;
            case 'logSystemPerformance':
                $logger->logSystemPerformance($args[0], $args[1]);
                echo "System performance logged successfully.\n";
                break;
            case 'monitorSystemPerformance':
                $logger->monitorSystemPerformance();
                echo "System performance monitored successfully.\n";
                break;
            case 'encryptData':
                $security = new Security(ENCRYPTION_KEY, null, null);
                $encryptedData = $security->encryptData($args[0]);
                echo "Data encrypted successfully: $encryptedData\n";
                break;
            case 'decryptData':
                $security = new Security(ENCRYPTION_KEY, null, null);
                $decryptedData = $security->decryptData($args[0]);
                echo "Data decrypted successfully: $decryptedData\n";
                break;
            case 'applyRateLimit':
                $security = new Security(null, null, null);
                $security->applyRateLimit($args[0]);
                echo "Rate limit applied successfully.\n";
                break;
            case 'moderateContent':
                $security = new Security(null, null, null);
                $security->moderateContent($args[0]);
                echo "Content moderated successfully.\n";
                break;
            default:
                echo "Unknown command: $command\n";
                break;
        }
    } catch (Exception $e) {
        $logger->log("Error: " . $e->getMessage(), 'ERROR');
        echo "An error occurred: " . $e->getMessage() . "\n";
    }
}

function main() {
    global $logger;

    $logger->log("Terminal access started.");

    while (true) {
        echo "Enter command: ";
        $input = trim(fgets(STDIN));
        if ($input === 'exit') {
            break;
        }

        $parts = explode(' ', $input);
        $command = array_shift($parts);
        $args = $parts;

        handleCommand($command, $args);
    }

    $logger->log("Terminal access ended.");
}

main();

?>
