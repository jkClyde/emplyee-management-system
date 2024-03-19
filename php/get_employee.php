<?php
// Include database connection
include("db_init.php");

// Check if employee ID is provided
if(isset($_POST['id'])) {
    $employeeId = $_POST['id'];

    // Prepare and execute query to fetch employee details
    $query = "SELECT * FROM tbl_employees WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $employeeId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if employee record exists
    if(mysqli_num_rows($result) > 0) {
        // Fetch employee data
        $employee = mysqli_fetch_assoc($result);

        // Return employee data as JSON response
        echo json_encode($employee);
    } else {
        // If employee record not found, return error message
        echo json_encode(array('error' => 'Employee not found'));
    }
} else {
    // If employee ID is not provided, return error message
    echo json_encode(array('error' => 'Employee ID not provided', 'id' => $_POST['id']));
}

// Close database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
