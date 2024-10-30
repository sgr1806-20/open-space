# open-space
an open source social network 

## Custom Framework

This project uses a custom framework built with PHP, designed to run seamlessly on a Linux server. The framework includes the following features:

### Basic Social Networking Features
- User registration and authentication
- User profile creation and management
- Friend or connection requests
- Messaging system (private and/or group messaging)
- News feed or timeline
- Post creation, editing, and deletion
- Commenting and liking posts
- Notifications for user activities
- Search functionality (users, posts, etc.)
- Privacy settings and controls

### Advanced Social Networking Features
- Media sharing (photos, videos, etc.)
- Live streaming
- Event creation and management
- Groups or communities
- Polls and surveys
- Hashtags and tagging
- Integration with other social media platforms
- Analytics and reporting for user activities
- Advertisement management
- API for third-party integrations

### Security and Performance Features
- Data encryption (at rest and in transit)
- Secure user authentication (e.g., OAuth, two-factor authentication)
- Rate limiting and throttling
- Content moderation and reporting
- Scalability and load balancing
- Backup and recovery mechanisms
- Performance optimization (caching, database indexing, etc.)
- Regular security audits and updates
- Compliance with data protection regulations (e.g., GDPR)
- Logging and monitoring of user activities

## Terminal Access

The social network now supports terminal access. You can use the `terminal.php` script to interact with the social network from the command line. The following commands are supported:

- `register <username> <email> <password>`: Register a new user.
- `login <email> <password>`: Authenticate a user.
- `createPost <userId> <content> <mediaAttachments> <privacySettings>`: Create a new post.
- `editPost <postId> <content> <mediaAttachments> <privacySettings>`: Edit an existing post.
- `deletePost <postId>`: Delete a post.
- `sendMessage <senderId> <receiverId> <groupId> <content>`: Send a message.
- `receiveMessage <messageId>`: Receive a message.
- `createEvent <userId> <eventDetails> <participantInfo>`: Create a new event.
- `manageEvent <eventId> <action>`: Manage an event (e.g., update, delete).
- `createGroup <userId> <groupDetails>`: Create a new group.
- `manageGroup <groupId> <action>`: Manage a group (e.g., update, delete).
- `createPoll <userId> <pollDetails> <options>`: Create a new poll.
- `managePoll <pollId> <action>`: Manage a poll (e.g., update, delete).
- `createAd <userId> <adContent> <targetingInfo>`: Create a new advertisement.
- `manageAd <adId> <adContent> <targetingInfo>`: Manage an advertisement.
- `trackActivity <userId> <activityType> <metrics>`: Track user activity.
- `reportActivity <analyticsId>`: Report user activity.
- `createBackup <userId> <backupData>`: Create a new backup.
- `manageBackup <backupId> <action>`: Manage a backup (e.g., delete, restore).
- `ensureGDPRCompliance <userId>`: Ensure GDPR compliance for a user.
- `manageUserData <userId> <action>`: Manage user data (e.g., data deletion, data export).
- `logUserActivity <userId> <activity>`: Log user activity.
- `logSystemPerformance <metric> <value>`: Log system performance.
- `monitorSystemPerformance`: Monitor system performance.
- `encryptData <data>`: Encrypt data.
- `decryptData <encryptedData>`: Decrypt data.
- `applyRateLimit <userId>`: Apply rate limiting.
- `moderateContent <content>`: Moderate content.

## Testing Terminal Access

To test the terminal access functionality, you can use the `test_terminal.php` script. This script simulates user input and tests the various commands supported by `terminal.php`.

### Running the Test Script

1. Open a terminal and navigate to the project directory.
2. Run the test script using the following command:
   ```
   php test_terminal.php
   ```

### Interpreting Test Results

The test script will output the results of each test case, indicating whether the test passed or failed. If a test fails, the expected and actual output will be displayed to help you identify the issue.

