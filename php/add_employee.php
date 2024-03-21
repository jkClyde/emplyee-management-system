<?php
include('db_init.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input validation (you should do this thoroughly!)
    $name     = isset($_POST['name']) ? $_POST['name'] : ''; 
    $position = isset($_POST['position']) ? $_POST['position'] : '';
    $age      = isset($_POST['age']) ? $_POST['age'] : '';
    $email      = isset($_POST['email']) ? $_POST['email'] : '';
    $contact      = isset($_POST['contact']) ? $_POST['contact'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $salary = isset($_POST['salary']) ? $_POST['salary'] : '';

    // Check for duplicates
    $check_sql = "SELECT COUNT(*) AS count FROM tbl_employees WHERE name = ? AND age = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "ss", $name, $age);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_bind_result($check_stmt, $count);
    mysqli_stmt_fetch($check_stmt);
    mysqli_stmt_close($check_stmt);

    if ($count > 0) {
        // Duplicate found, return error message
        $response = array('success' => false, 'message' => "Employee '$name' already exists");
    } else {
        // No duplicate found, proceed with insertion
        $insert_sql = "INSERT INTO tbl_employees (name, position, age, email, contact,  start_date, salary) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "ssssssd", $name, $position, $age, $email, $contact,  $start_date, $salary);

        if (mysqli_stmt_execute($insert_stmt)) {
            // Success message with employee's name
            $response = array('success' => true, 'message' => "Employee '$name' is successfully added");
        } else {
            $response = array('success' => false, 'message' => mysqli_error($conn));
        }

        // Close the statement
        mysqli_stmt_close($insert_stmt);
    }

    // Send response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);  
}
