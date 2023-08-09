<?php
require_once "../../initialize.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract the category data from the POST request
    $category_id = $_POST["category_id"];
    $name = $_POST["edit_name"];
    $description = $_POST["edit_description"];

    // Perform the database update using prepared statements
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE category_list SET name=?, description=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $description, $category_id);
    
    if ($stmt->execute()) {
        // Category update successful
        $response = array("success" => true);
        echo json_encode($response);
    } else {
        // Category update failed
        $response = array("success" => false);
        echo json_encode($response);
    }

    $stmt->close();
    $conn->close();
}
?>
