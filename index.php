<?php
// Developer: Brainhub24
// Contact: github@brainhub24.com
// Version: 1.0.0
// Codename: GatewayRedirector
// Changelog:
// - v1.0.0 (Initial release):
//   * Initial implementation of redirection with UTM parameters

// Enable error reporting if debug mode is activated
if (isset($_GET['debug']) && $_GET['debug'] === 'view') {
    error_reporting(E_ALL); // Set error reporting to display all types of errors
    ini_set('display_errors', 0); // Display errors in the browser
    // In a production environment, it's recommended to disable error display and log errors instead.. do not use it in prod systems pls. :)
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
        error_log("Redirection failed. Headers already sent.");
        // hmm...
    }
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
