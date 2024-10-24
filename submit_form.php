<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Capture form data
$form_type = isset($_POST['form_type']) ? $_POST['form_type'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : 'Not provided';
$message = isset($_POST['message']) ? $_POST['message'] : 'Not provided';

// Validate required fields (name and email)
if (empty($name) || empty($email)) {
    die("Error: Name and Email are required fields.");
}

// Define Google Drive links
$drive_links = [
    '1' => 'https://drive.google.com/drive/folders/19GoC5IvflosAzQeCGlXK-CRmLSTIPBRs',
    '2' => 'https://soundcloud.com/lunanova-meditation/30-powerful-new-moon-affirmations-guided-meditation?ref=clipboard&p=i&c=1&si=99AB8522422843BDBD13BA8E134AC162'
];

// Get the appropriate drive link based on form type
$drive_link = isset($drive_links[$form_type]) ? $drive_links[$form_type] : '';

// Compose email content for the host
$email_content = "
Form Type: $form_type

Name: $name
Email: $email
Phone: $phone
Message: $message
";

// Compose email content for the user (confirmation message)
$user_email_content = "
Hi $name,

Thank you for getting in touch with us! We have received your message and will respond to you shortly.

Here is a summary of your submission:

Form Type: $form_type
Name: $name
Email: $email
Phone: $phone
Message: $message
";

// Add drive link to user email if applicable
if (!empty($drive_link)) {
    $user_email_content .= "\n\nYou can access your download here: $drive_link";
}

$user_email_content .= "\n\nBest regards,\nNoopur Jain";


// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'linux898.defaultserverdns.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'hello@noopurjain.com';
    $mail->Password   = ',{-=JoWI8#%c';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Send email to the host
    $mail->setFrom('hello@noopurjain.com', 'Noopur Jain');
    $mail->addAddress('hello@noopurjain.com');
    $mail->isHTML(false);
    $mail->Subject = "New Form Submission";
    $mail->Body    = $email_content;
    $mail->send();

    // Send confirmation email to the user
    $mail->clearAddresses();
    $mail->addAddress($email);
    $mail->Subject = "Thank you for your submission";
    $mail->Body    = $user_email_content;
    $mail->send();

    // If we have a drive link, redirect to it
    if (!empty($drive_link)) {
        // Ensure no output has been sent before redirect
        if (!headers_sent()) {
            header("Location: $drive_link");
            exit;
        } else {
            echo "<script>window.location.href = '$drive_link';</script>";
            echo "If you are not redirected, <a href='$drive_link' target='_blank'>click here</a>.";
        }
    } else {
        echo "Form submission successful. Emails have been sent.";
    }
    
} catch (Exception $e) {
    die("Error: Unable to send email. Mailer Error: {$mail->ErrorInfo}");
}
?>