<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'noopur-jain';
$port = 3306;
$socket = '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port, $socket);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form type
$form_type = isset($_POST['form_type']) ? $_POST['form_type'] : '';

// Capture form data
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : NULL;  // NULL if not provided
$message = isset($_POST['message']) ? $_POST['message'] : NULL;  // NULL if not provided

// Validate required fields (name and email)
if (empty($name) || empty($email)) {
    die("Error: Name and Email are required fields.");
}

// Prepare SQL statement for inserting into contacts table
$stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Statement preparation failed: " . $conn->error);
}

// Bind the parameters (note: phone and message can be NULL)
$stmt->bind_param("ssss", $name, $email, $phone, $message);

// Execute statement and check for success
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    die("Error: " . $stmt->error);
}

// Close connection
$stmt->close();
$conn->close();
?>