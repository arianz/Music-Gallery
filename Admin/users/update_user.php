<?php
// Replace these with your actual database credentials
require_once "../../initialize.php";

// Function to handle database connection
function connectDB()
{
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the data is sent via POST method

    // Get the user ID, username, and password from the form
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform any necessary data validation here
    // ...

    // Update user data in the database
    $conn = connectDB();
    $updateSql = "UPDATE users SET username = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssi", $username, $password, $userId);

    if ($stmt->execute()) {
    // User data updated successfully
    session_start();
    $_SESSION["nama"] = $username;
    $response = array('status' => 'success', 'message' => 'User data updated successfully.');
    echo json_encode($response);
} else {
    // Handle the error
    $response = array('status' => 'error', 'message' => 'Error updating user data. Please try again.');
    echo json_encode($response);
}
}
