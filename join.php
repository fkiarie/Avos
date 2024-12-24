<?php
session_start();
require 'vendor/autoload.php';

use Google\Cloud\RecaptchaEnterprise\V1\RecaptchaEnterpriseServiceClient;
use Google\Cloud\RecaptchaEnterprise\V1\Event;
use Google\Cloud\RecaptchaEnterprise\V1\Assessment;
use Google\Cloud\RecaptchaEnterprise\V1\TokenProperties\InvalidReason;

// Ensure CSRF token matches
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Invalid CSRF token.");
}

// Validate reCAPTCHA
function validateRecaptcha($token, $action) {
    $recaptchaKey = "YOUR_SITE_KEY";
    $projectId = "YOUR_PROJECT_ID";
    
    $client = new RecaptchaEnterpriseServiceClient();
    $projectName = $client->projectName($projectId);

    $event = (new Event())
        ->setSiteKey($recaptchaKey)
        ->setToken($token);

    $assessment = (new Assessment())
        ->setEvent($event);

    $response = $client->createAssessment($projectName, $assessment);

    if (!$response->getTokenProperties()->getValid()) {
        throw new Exception("Invalid reCAPTCHA token.");
    }

    if ($response->getTokenProperties()->getAction() !== $action) {
        throw new Exception("reCAPTCHA action mismatch.");
    }

    return $response->getRiskAnalysis()->getScore();
}

try {
    $recaptchaToken = $_POST['g-recaptcha-response'];
    $recaptchaAction = "submit";

    // Risk threshold (0.0 = likely a bot, 1.0 = likely human)
    $riskScore = validateRecaptcha($recaptchaToken, $recaptchaAction);

    if ($riskScore < 0.5) {
        die("Suspicious activity detected. Try again later.");
    }

    // Process form data
    $name = htmlspecialchars($_POST['name']);
    $company = htmlspecialchars($_POST['company']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $tel = htmlspecialchars($_POST['tel']);
    $membership_type = htmlspecialchars($_POST['membership_type']);
    $message = htmlspecialchars($_POST['message']);

    if (!$email) {
        throw new Exception("Invalid email address.");
    }

    // Send email or store in DB
    $to = "info@avocado.ke";
    $subject = "New Membership Application: $name";
    $body = "Details:\nName: $name\nCompany: $company\nEmail: $email\nTel: $tel\nMembership Type: $membership_type\nMessage: $message";

    if (mail($to, $subject, $body)) {
        echo "Message sent successfully.";
    } else {
        throw new Exception("Failed to send message.");
    }
} catch (Exception $e) {
    die($e->getMessage());
}
?>
