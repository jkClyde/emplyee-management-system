<?php
// Include database connection
include("db_init.php");

// Check if the delete_id parameter is set in the POST request
if(isset($_POST['delete_id'])) {
    // Get the ID of the employee to be deleted
    $id = $_POST['delete_id'];

    // Prepare and execute the SQL query to delete the employee record
    $query = "DELETE FROM tbl_employees WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $result = mysqli_stmt_execute($stmt);

    // Check if the delete operation was successful
    if($result) {
        // Return success message as JSON response
        echo json_encode(array('success' => true));
    } else {
        // If the delete operation fails, return error message as JSON response
        echo json_encode(array('success' => false, 'message' => 'Error deleting employee'));
    }

    // Close prepared statement
    mysqli_stmt_close($stmt);
} else {
    // If delete_id parameter is not set, return error message as JSON response
    echo json_encode(array('success' => false, 'message' => 'Employee ID not provided'));
}

// Close database connection
mysqli_close($conn);
?>
