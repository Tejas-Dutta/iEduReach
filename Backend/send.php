<?php
// MySQL database connection
$host = 'localhost'; // Host, use 'localhost' if you're on the same server
$db = 'contact_form'; // Your database name
$user = 'root'; // Your MySQL username (default is 'root' in XAMPP)
$pass = ''; // Your MySQL password (leave empty if using XAMPP)

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data and sanitize inputs to prevent SQL injection
$firstName = htmlspecialchars($_POST['firstName']);
$lastName = htmlspecialchars($_POST['lastName']);
$email = htmlspecialchars($_POST['email']);
$mobile = htmlspecialchars($_POST['mobile']);
$school = htmlspecialchars($_POST['school']);
$message = htmlspecialchars($_POST['message']);

// Insert data into MySQL database using a prepared statement
$stmt = $conn->prepare("INSERT INTO submissions (first_name, last_name, email, mobile, school, message) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $firstName, $lastName, $email, $mobile, $school, $message);

if ($stmt->execute()) {
    echo "Thank you! Your message has been received.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
