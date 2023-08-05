<?php
// Replace these values with your actual database credentials
include 'db_connect.php';
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user data from the form
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = md5($_POST['password']); // Encrypt the password using MD5
$type = 1;

// SQL query to insert new user data
$sql = "INSERT INTO users (firstname, lastname, username, password, type)
        VALUES ('$firstname', '$lastname', '$username', '$password', '$type')";

if ($conn->query($sql) === TRUE) {
    header("location:index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
