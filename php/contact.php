<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get data safely
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // 🛡️ ANTI-SPAM (honeypot)
    if (!empty($_POST['website'])) {
        exit(); // bot detected
    }

    //  NAME VALIDATION
    if (strlen($name) < 2) {
        die("Please enter a valid name.");
    }

    //  PHONE VALIDATION (10 digits only)
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        die("Phone number must be exactly 10 digits.");
    }

    //  EMAIL VALIDATION (THIS IS WHAT YOU WANTED)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email address with a proper domain (e.g. gmail.com, yahoo.com, etc).");
    }

    //  MESSAGE VALIDATION
    if (strlen($message) < 10) {
        die("Message is too short. Please explain your project.");
    }

    // EMAIL SETUP
    $to = "maxbarron2617@gmail.com";
    $subject = "New Website Enquiry";

    $body = "
New enquiry from website:

Name: $name
Phone: $phone
Email: $email

Message:
$message
";

    $headers = "From: noreply@yourwebsite.co.za\r\n";
    $headers .= "Reply-To: $email\r\n";

    // SEND EMAIL
    if (mail($to, $subject, $body, $headers)) {
        header("Location: ../index.html?success=1");
        exit();
    } else {
        echo "Failed to send message. Try again.";
    }

} else {
    echo "Invalid request.";
}

?>