<?php
// Developer: Brainhub24
// Contact: github@brainhub24.com
// Version: 1.1.0
// Codename: GatewayRedirector
// Changelog:
// - v1.1.0 (Improvement):
//   * Added logging function for error handling
// - v1.0.0 (Initial release):
//   * Initial release - implementation of redirection with UTM parameters

// Enable error reporting if debug mode is activated
if (isset($_GET['debug']) && $_GET['debug'] === 'view') {
    error_reporting(E_ALL); // Set error reporting to display all types of errors
    ini_set('display_errors', 0); // Display errors in the browser
    // In a production environment, it's recommended to disable error display and log errors instead..
    // Do not use it in prod systems pls. :)
}

/**
 * Function to redirect visitors with UTM parameters
 * 
 * @param string $url The URL to redirect visitors to
 */
function redirectVisitor($url) {
    // Check if headers have already been sent
    if (!headers_sent()) {
        // UTM parameter values
        $utm_source = 'gateway';
        $utm_medium = 'referral';
        $utm_campaign = 'WSD';
        
        // Construct URL with UTM parameters
        $redirect_url = $url . '?utm_source=' . $utm_source . '&utm_medium=' . $utm_medium . '&utm_campaign=' . $utm_campaign;
        
        // Perform the redirection
        header("Location: $redirect_url");
        exit();
    } else {
        // Log the error if headers are already sent
        logError("Redirection failed. Headers already sent.");
        // hmm...
    }
}

/**
 * Function to log errors or events
 * 
 * @param string $message The message to log
 */
function logError($message) {
    $logFile = 'error.log'; // Define the log file path
    $logTimestamp = date('[Y-m-d H:i:s]'); // Get current timestamp
    $logMessage = $logTimestamp . ' ' . $message . PHP_EOL; // Format log message with timestamp
    
    // Append log message to the log file
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

// Redirection URL
$redirect_url = 'https://github.com/brainhub24/'; // My pre-defined URL

// Call the redirection function
redirectVisitor($redirect_url);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gateway</title>
    <!-- ANALYTICS CODE -->
</head>
<body>
    <!-- This content won't be displayed atm if redirection occurs -->
</body>
</html>
