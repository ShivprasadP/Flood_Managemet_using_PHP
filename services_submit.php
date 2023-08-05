<?php
// Assuming you have already set up the database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flood_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input
$owner_name = $_POST['owner_name'];
$service_name = $_POST['service_name'];
$phone_number = $_POST['phone_number'];
$email_id = $_POST['email_id'];
$address = $_POST['address'];
$photo = $_FILES['photo']['name'];

// Prepare and execute the SQL query to insert data into the "services" table
$sql = "INSERT INTO services (owner_name, service_name, phone_number, email_id, address, photo) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $owner_name, $service_name, $phone_number, $email_id, $address, $photo);
$stmt->execute();

// Check if the data was successfully inserted
if ($stmt->affected_rows > 0) {
    echo "Thank you for donating this things, it will help many people.";
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>