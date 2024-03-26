<?php
// Include database connection
include("../db_init.php");

// Check if the ID parameter is set
if (isset($_POST['id'])) {
    // Sanitize the ID parameter to prevent SQL injection
    $designationId = mysqli_real_escape_string($conn, $_POST['id']);

    // SQL query to delete the designation with the given ID
    $sql = "DELETE FROM tbl_designation WHERE id = $designationId";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Deletion successful
        echo "Designation deleted successfully";
    } else {
        // Deletion failed
        echo "Error deleting designation: " . mysqli_error($conn);
    }
} else {
    // ID parameter not set
    echo "Error: ID parameter not set";
}

// Close database connection
mysqli_close($conn);
