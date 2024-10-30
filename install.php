<?php
// Check if the script is already installed
if (file_exists('config.php')) {
    echo "The script is already installed.";
    exit;
}

// System requirements check
$requirements = [
    'PHP version' => version_compare(PHP_VERSION, '7.0.0', '>='),
    'PDO extension' => extension_loaded('pdo'),
    'PDO MySQL driver' => extension_loaded('pdo_mysql'),
];

$requirements_met = true;
foreach ($requirements as $requirement => $met) {
    if (!$met) {
        echo "Requirement not met: $requirement\n";
        $requirements_met = false;
    }
}

if (!$requirements_met) {
    exit("Please ensure all requirements are met before proceeding with the installation.");
}

// Prompt user for database credentials
echo "Please enter your database credentials:\n";
$db_host = readline("Database Host: ");
$db_name = readline("Database Name: ");
$db_user = readline("Database User: ");
$db_pass = readline("Database Password: ");

// Save database credentials to config.php
$config_content = "<?php\n";
$config_content .= "// Database configuration\n";
$config_content .= "define('DB_HOST', '$db_host');\n";
$config_content .= "define('DB_NAME', '$db_name');\n";
$config_content .= "define('DB_USER', '$db_user');\n";
$config_content .= "define('DB_PASS', '$db_pass');\n";
$config_content .= "\n";
$config_content .= "// Encryption settings\n";
$config_content .= "define('ENCRYPTION_KEY', getenv('ENCRYPTION_KEY'));\n";
$config_content .= "define('ENCRYPTION_ALGORITHM', 'AES-256-CBC');\n";
$config_content .= "\n";
$config_content .= "// Authentication settings\n";
$config_content .= "define('AUTH_METHOD', 'OAuth');\n";
$config_content .= "define('TWO_FACTOR_AUTH', true);\n";
$config_content .= "\n";
$config_content .= "// Use environment variables for sensitive information\n";

file_put_contents('config.php', $config_content);

echo "Installation completed successfully.";
