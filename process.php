<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
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
        
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'sgsengineeringltd.com'; // Replace with your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'info@sgsengineeringltd.com'; // Your Gmail address
        $mail->Password = '@Info@sgs101'; // Your Gmail password or App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 465;

        // $mail->isSMTP();
        // $mail->Host = 'skulsync.com.ng'; // Replace with your SMTP host
        // $mail->SMTPAuth = true;
        // $mail->Username = 'info@skulsync.com.ng'; // Your Gmail address
        // $mail->Password = '@Info@skulsync101'; // Your Gmail password or App Password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $mail->Port = 465;

        // Email Content
        $mail->setFrom('info@sgsengineeringltd.com', 'SGS Engineering LTD');
        // $mail->setFrom('info@skulsync.com.ng', 'SGS Engineering LTD');
        $mail->addAddress($email); // Add recipient
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Send the email
        $mail->send();
        // Redirect to success page
        header("Location:contact.php?success=email_sent");
        exit;
    } catch (Exception $e) {
        // Log the error (optional)
        error_log("Mailer Error: " . $mail->ErrorInfo);
        // print_r($e);
        // print_r($mail->ErrorInfo);
        // Redirect back to the contact page with an error
        header("Location: contact.php?error=email_failed");
        exit;
    }
}else{
    
}

?>
