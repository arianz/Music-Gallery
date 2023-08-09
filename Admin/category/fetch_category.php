<?php
// fetch_category.php

// Place your database configuration here
require_once "../../initialize.php";
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['category_id'])) {
    $categoryId = $_POST['category_id'];
    
    $sql = "SELECT * FROM category_list WHERE id = $categoryId";
    $result = $conn->query($sql);
    
    if ($result === false) {
        die(mysqli_error($conn));
    }

    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
        echo json_encode($category);
    } else {
        echo json_encode(["error" => "Category not found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>
