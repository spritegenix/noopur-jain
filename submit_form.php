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

Best regards,
Noopur Jain
";

// Define the paths for the files
$file_to_attach = '';
switch ($form_type) {
    case '1':
        $file_to_attach = 'assets/Free Offerings Pics/Full Moon Ritual Guidebook 11.pdf';
        break;
    case '2':
        $file_to_attach = 'assets/Free Offerings Pics/Release & Reflect Full Moon Journal 12.pdf';
        break;
    default:
        break;
}

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'linux898.defaultserverdns.com'; // Your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'hello@noopurjain.com'; // Your email address
    $mail->Password   = ',{-=JoWI8#%c'; // Replace with your actual email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SMTPS (SSL/TLS) for port 465
    $mail->Port       = 465; // SMTP port

    // Send email to the host (yourself)
    $mail->setFrom('hello@noopurjain.com', 'Noopur Jain');
    $mail->addAddress('hello@noopurjain.com'); // Where you want to receive the form submissions

    // Content for the host
    $mail->isHTML(false);
    $mail->Subject = "New Form Submission";
    $mail->Body    = $email_content;

    // Send the email to the host
    $mail->send();

    // Now send the confirmation email to the user
    $mail->clearAddresses(); // Clear previous addresses before sending a new email
    $mail->addAddress($email); // The form submitter's email

    // Content for the user
    $mail->Subject = "Thank you for your submission";
    $mail->Body    = $user_email_content;

    // Attach the PDF if applicable
    if (!empty($file_to_attach)) {
        $mail->addAttachment($file_to_attach);
    }

    // Send the confirmation email to the user
    $mail->send();

    echo "Form submission successful. Emails have been sent to both the host and the submitter.";
} catch (Exception $e) {
    echo "Error: Unable to send email. Mailer Error: {$mail->ErrorInfo}";
}

// Download the appropriate file based on the form type
function downloadFile($filePath) {
    if (file_exists($filePath)) {
        // Set headers to trigger file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
        header('Content-Length: ' . filesize($filePath));
        header('Pragma: public');
        flush(); // Flush system output buffer
        readfile($filePath); // Read and output the file
        exit;
    } else {
        echo "Error: File not found.";
    }
}

// Trigger file download based on form_type
switch ($form_type) {
    case '1':
        downloadFile('assets/Free Offerings Pics/Full Moon Ritual Guidebook 11.pdf');
        break;
    case '2':
        downloadFile('assets/Free Offerings Pics/Release & Reflect Full Moon Journal 12.pdf');
        break;
    default:
        break;
}

?>