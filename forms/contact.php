<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Email setup
    $to = "your-email@example.com"; // Replace with your email address
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email body
    $body = "
        <html>
        <head>
            <title>$subject</title>
        </head>
        <body>
            <h2>New Message from $name</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        </body>
        </html>
    ";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "Your message has been sent!";
    } else {
        echo "Failed to send the message. Please try again later.";
    }
}
