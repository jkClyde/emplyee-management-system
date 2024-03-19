<?php
// Include database connection
include("db_init.php");

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated employee data from the POST request
    $id = $_POST['edit_id'];
    $name = $_POST['edit_name'];
    $position = $_POST['edit_position'];
    $age = $_POST['edit_age'];
    $salary = $_POST['edit_salary'];

    // Prepare and execute the SQL query to update the employee record
    $query = "UPDATE tbl_employees SET name=?, position=?, age=?, salary=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssdsi', $name, $position, $age, $salary, $id);
    $result = mysqli_stmt_execute($stmt);

    // Check if the update operation was successful
    if ($result) {
        // Return success message as JSON response
        echo json_encode(array('success' => true));
    } else {
        // If the update operation fails, return error message as JSON response
        echo json_encode(array('success' => false, 'message' => 'Error updating employee'));
    }

    // Close prepared statement
    mysqli_stmt_close($stmt);
} else {
    // If the form data is not submitted via POST request, return error message as JSON response
    echo json_encode(array('success' => false, 'message' => 'Invalid request'));
}

// Close database connection
mysqli_close($conn);
?>
