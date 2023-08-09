<?php
// Include the necessary initialization and database connection files
require_once "../../initialize.php";

// Initialize the session
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["nama"])) {
    header("Location: login.php");
    exit();
}

// Check if the user ID is provided through the POST request
if (isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];
    $id_akun = $_SESSION['id'];

    // Prevent deleting the currently logged-in user
    if ($deleteId == $id_akun) {
        // Add the necessary code to delete the user from the database
        $deleteSql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($deleteSql);
        $stmt->bind_param("i", $deleteId);
        if ($stmt->execute()) {
            // User deleted successfully, you can redirect to a success page if needed
            echo json_encode(["status" => "success", "message" => "User deleted successfully"]);
            exit();
        } else {
            // Handle the error, redirect to an error page if needed
            echo json_encode(["status" => "error", "message" => "Error deleting user: " . $stmt->error]);
            exit();
        }
    }
}

// If the user ID is not provided or the logged-in user's ID is attempted to be deleted, return an error
echo json_encode(["status" => "error", "message" => "Invalid request"]);
exit();
?>
