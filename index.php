<?php
// index.php

// Description: This is the entry point for the open-source social networking script. 
// It initializes the application and handles incoming requests.

require_once 'config.php';
require_once 'src/User.php';
require_once 'src/Post.php';
require_once 'src/Message.php';
require_once 'src/Notification.php';
require_once 'src/Search.php';
require_once 'src/Privacy.php';
require_once 'src/Media.php';
require_once 'src/Event.php';
require_once 'src/Group.php';
require_once 'src/Poll.php';
require_once 'src/Hashtag.php';
require_once 'src/Analytics.php';
require_once 'src/Advertisement.php';
require_once 'src/APIKey.php';
require_once 'src/Security.php';
require_once 'src/Backup.php';
require_once 'src/Performance.php';
require_once 'src/Compliance.php';
require_once 'src/Logger.php';

// Initialize the application
session_start();
$logger = new Logger('app.log');
$logger->log('Application initialized.');

// Handle incoming requests
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

switch ($requestMethod) {
    case 'GET':
        // Handle GET requests
        if ($requestUri === '/posts') {
            $post = new Post();
            $posts = $post->getAllPosts();
            echo json_encode($posts);
        } elseif ($requestUri === '/users') {
            $user = new User();
            $users = $user->getAllUsers();
            echo json_encode($users);
        }
        break;
    case 'POST':
        // Handle POST requests
        $input = json_decode(file_get_contents('php://input'), true);
        if ($requestUri === '/posts') {
            $post = new Post();
            $post->createPost($input['userId'], $input['content'], $input['mediaAttachments'], $input['privacySettings']);
            echo json_encode(['message' => 'Post created successfully.']);
        } elseif ($requestUri === '/users') {
            $user = new User();
            $user->register($input['username'], $input['email'], $input['password']);
            echo json_encode(['message' => 'User registered successfully.']);
        }
        break;
    default:
        // Handle other request methods
        http_response_code(405);
        echo json_encode(['message' => 'Method not allowed.']);
        break;
}

?>
