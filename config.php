<?php
// Database configuration
define('DB_HOST', getenv('DB_HOST'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));

// Encryption settings
define('ENCRYPTION_KEY', getenv('ENCRYPTION_KEY'));
define('ENCRYPTION_ALGORITHM', 'AES-256-CBC');

// Authentication settings
define('AUTH_METHOD', 'OAuth');
define('TWO_FACTOR_AUTH', true);

// Use environment variables for sensitive information
