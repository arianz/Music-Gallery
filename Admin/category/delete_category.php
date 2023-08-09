<?php
// delete_category.php

// Add necessary database connection and other initializations here
require_once "../../initialize.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $categoryId = $_POST["id"];

    // Perform the deletion query
    $sql = "DELETE FROM category_list WHERE id = $categoryId";

    if ($conn->query($sql) === TRUE) {
        echo "Category deleted successfully";
    } else {
        echo "Error deleting category: " . $conn->error;
    }

    $conn->close();
}
?>
