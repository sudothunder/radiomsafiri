<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Update the path if needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'mail.radiomsafiri.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'info@radiomsafiri.com'; // SMTP username
        $mail->Password = 'YOUR_EMAIL_PASSWORD'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('info@radiomsafiri.com', 'Radiomsafiri');
        $mail->addAddress('info@radiomsafiri.com'); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Contact Form Submission: ' . $subject;
        $mail->Body    = "You have received a new message from your website contact form.<br><br>" .
                         "Here are the details:<br>" .
                         "Name: $name<br>" .
                         "Email: $email<br>" .
                         "Subject: $subject<br>" .
                         "Message:<br>$message";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Your message has been sent. Thank you!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
