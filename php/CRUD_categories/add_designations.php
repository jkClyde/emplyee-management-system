<?php
include('../db_init.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input validation (you should do this thoroughly!)
    $new_designation = isset($_POST['designationName']) ? $_POST['designationName'] : '';

    // Database Insertion 
    $insert_sql = "INSERT INTO tbl_designation (designation)  VALUES (?)";
    $insert_stmt = mysqli_prepare($conn, $insert_sql);
    mysqli_stmt_bind_param($insert_stmt, "s", $new_designation);

    if (mysqli_stmt_execute($insert_stmt)) {
        $response = array('success' => true, 'message' => "New Designation : '$new_designation' added");
    } else {
        $response = array('success' => false, 'message' => mysqli_error($conn));
    }

    // Close the statement
    mysqli_stmt_close($insert_stmt);


    // Send response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
