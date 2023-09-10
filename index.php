<?php
header('Content-Type: application/json');

// Validate query parameters
if (!isset($_GET['firstname']) || !isset($_GET['lastname'])) {
    http_response_code(400); // Bad Request
    echo json_encode(array('error' => 'Missing firstname and/or lastname'));
    exit;
}

$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];

// Calculate current day of the week
$currentDayOfWeek = date('l');

// Calculate current UTC time with timezone offset validation
$timezoneOffset = date('Z') / 3600; // Convert to hours
if ($timezoneOffset < -2 || $timezoneOffset > 2) {
    http_response_code(400); // Bad Request
    echo json_encode(array('error' => 'Timezone offset is outside the valid range of +/- 2 hours'));
    exit;
}
$currentTimeUtc = gmdate('Y-m-d H:i:s');

// Define GitHub repository URL
$githubRepoUrl = 'https://github.com/davidumoren/hng-stage1';

// Get the name of the current script file
$scriptFilename = basename(__FILE__);

// Construct GitHub URLs
$fileGithubUrl = $githubRepoUrl . '/blob/main/' . $scriptFilename; // URL for the file being run
$fullSourceCodeGithubUrl = $githubRepoUrl; // URL for the full source code

// Define other information
$slackName = "David" . '.' . "Favour";
$backendTrack = 'Backend';

// Construct the response array
$response = array(
    'slack_name' => $slackName,
    'day_of_week' => $currentDayOfWeek,
    'utc_time' => $currentTimeUtc,
    'backend_track' => $backendTrack,
    'file_github_url' => $fileGithubUrl, // URL for the file being run
    'full_source_code_github_url' => $fullSourceCodeGithubUrl, // URL for the full source code
    'status_code' => 200 // Success
);

// Send JSON response
echo json_encode($response);
