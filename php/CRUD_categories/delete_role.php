<?php
include("../db_init.php");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'id' parameter is set
    if (isset($_POST['id'])) {
        // Sanitize the category ID to prevent SQL injection
        $categoryId = mysqli_real_escape_string($conn, $_POST['id']);

        // Construct the DELETE query
        $sql = "DELETE FROM tbl_categories WHERE id = $categoryId";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // If deletion is successful, send a success response
            http_response_code(200); // Set response code to 200 (OK)
            echo json_encode(array('message' => 'Category deleted successfully.'));
        } else {
            // If deletion fails, send an error response
            http_response_code(500); // Set response code to 500 (Internal Server Error)
            echo json_encode(array('message' => 'Error deleting category: ' . mysqli_error($conn)));
        }
    } else {
        // If 'id' parameter is not set, send a bad request response
        http_response_code(400); // Set response code to 400 (Bad Request)
        echo json_encode(array('message' => 'Missing category ID parameter.'));
    }
} else {
    // If request method is not POST, send a method not allowed response
    http_response_code(405); // Set response code to 405 (Method Not Allowed)
    echo json_encode(array('message' => 'Method not allowed.'));
}
