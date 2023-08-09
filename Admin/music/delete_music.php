<?php
    require_once "../../initialize.php";
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


// Check if the request is made through POST method and the 'id' parameter exists
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare the SQL statement to delete the music record
    $sql = "DELETE FROM `music_list` WHERE `id` = $id";

    if ($conn->query($sql) === TRUE) {
        // Successful deletion
        $response = array(
            'status' => 'success',
            'message' => 'Music deleted successfully.'
        );
        echo json_encode($response);
    } else {
        // Error in deletion
        $response = array(
            'status' => 'error',
            'message' => 'Error deleting music: ' . $conn->error
        );
        echo json_encode($response);
    }

    // Close the database connection
    $conn->close();
} else {
    // Invalid request
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request.'
    );
    echo json_encode($response);
}
