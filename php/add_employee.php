<?php
include('db_init.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input validation (you should do this thoroughly!)
    $name     = isset($_POST['name']) ? $_POST['name'] : '';
    $position = isset($_POST['position']) ? $_POST['position'] : '';
    $designation = isset($_POST['designation']) ? $_POST['designation'] : '';

    $age      = isset($_POST['age']) ? $_POST['age'] : '';
    $email      = isset($_POST['email']) ? $_POST['email'] : '';
    $contact      = isset($_POST['contact']) ? $_POST['contact'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $salary = isset($_POST['salary']) ? $_POST['salary'] : '';
    $image = "";

    if ($_FILES["image"]["error"] == 4) {
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid Image Extension');</script>";
        } else if ($fileSize > 1000000) {
            echo "<script>alert('Image Size Is Too Large');</script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            // Move uploaded file to desired directory
            $imageDir = 'uploads/'; // Make sure this directory exists
            $imagePath = $imageDir . $newImageName;
            if (move_uploaded_file($tmpName, $imagePath)) {
                // Proceed with database insertion
                $image = $newImageName;
            } else {
                echo "<script>alert('Error uploading image');</script>";
            }
        }
    }





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
        // Database Insertion 
        $insert_sql = "INSERT INTO tbl_employees (name, position, age, email, contact, start_date, salary, image_url, designation) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "ssssssdss", $name, $position, $age, $email, $contact, $start_date, $salary, $image, $designation);

        if (mysqli_stmt_execute($insert_stmt)) {
            $response = array('success' => true, 'message' => "Employee '$name' added");
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
