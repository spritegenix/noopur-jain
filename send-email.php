<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Database connection parameters
$config = [
    'servername' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'noopur-jain',
    'socket' => '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock'
];

// Create connection
$conn = new mysqli(
    $config['servername'],
    $config['username'],
    $config['password'],
    $config['database'],
    3306,
    $config['socket'] ?? null
);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    // Capture form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : NULL;
    $message = isset($_POST['message']) ? $_POST['message'] : NULL;

    // Validate required fields (name and email)
    if (empty($name) || empty($email)) {
        throw new Exception("Error: Name and Email are required fields.");
    }

    // Prepare SQL statement for inserting into the contacts table
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Error in SQL query: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    // Execute statement
    if (!$stmt->execute()) {
        throw new Exception("Query execution failed: " . $stmt->error);
    }

    // PHPMailer configuration to send confirmation email
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'mail.thevandana.in';
    $mail->SMTPAuth = true;
    $mail->Username = 'no_reply@thevandana.in';
    $mail->Password = 'vhclub@1234';  // Make sure this is stored securely in production
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->setFrom('no_reply@thevandana.in', 'Your Website Name');

    // Add user's email address
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = 'Form Submission Confirmation';
    $mail->Body    = "Dear $name,<br><br>Thank you for contacting us. We have received the following details:<br>"
                   . "<strong>Email:</strong> $email<br>"
                   . (!empty($phone) ? "<strong>Phone:</strong> $phone<br>" : '')
                   . (!empty($message) ? "<strong>Message:</strong> $message<br>" : '')
                   . "<br>We will get back to you shortly.<br><br>Thank you!";
    $mail->AltBody = "Dear $name,\n\nThank you for contacting us. We have received the following details:\n"
                   . "Email: $email\n"
                   . (!empty($phone) ? "Phone: $phone\n" : '')
                   . (!empty($message) ? "Message: $message\n" : '')
                   . "\nWe will get back to you shortly.\n\nThank you!";

    // Send the email
    if ($mail->send()) {
        echo "Form submitted successfully! Confirmation email sent to $email.";
    } else {
        echo "Form submitted successfully, but failed to send email: " . $mail->ErrorInfo;
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Close statement and connection
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conn)) {
        $conn->close();
    }
}
?>