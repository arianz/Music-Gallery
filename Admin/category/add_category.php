<?php
// Assuming your database connection details are defined in "initialize.php"
require_once "../../initialize.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the category details from the AJAX request
  $categoryName = $_POST["name"];
  $categoryDescription = $_POST["description"];
  $category_id = $_POST["category_id"];

  // Perform any necessary data validation before inserting into the database

  // Create a new database connection
  $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare the SQL query to insert the new category into the database
  $sql = "INSERT INTO category_list (name, description, category_id) VALUES ('$categoryName', '$categoryDescription', '$category_id')";

  // Execute the query
  if ($conn->query($sql) === TRUE) {
    // If the insertion was successful, return a success message to the frontend
    echo "Category added successfully!";
  } else {
    // If an error occurred during insertion, return an error message to the frontend
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close the database connection
  $conn->close();
}
?>
