<?php
// Include database connection
include("db_init.php");

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['edit_id'];
    $name = $_POST['edit_name'];
    $position = $_POST['edit_position'];
    $age = $_POST['edit_age'];
    $salary = $_POST['edit_salary'];
    $start_date = $_POST['edit_start_date'];
    $email = $_POST['edit_email'];
    $contact = $_POST['edit_contact'];
    $designation = $_POST['edit_designation'];


    // Initialize $image variable
    $image = null;

    if ($_FILES["image"]["error"] != 4) { // Check if a new image is uploaded
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
                // Update image only if the file is successfully uploaded
                $image = $newImageName;
            } else {
                echo "<script>alert('Error uploading image');</script>";
            }
        }
    }

    // Prepare and execute the SQL query to update the employee record
    $query = "UPDATE tbl_employees SET name=?, position=?, age=?, salary=?,  email=?, contact=? , start_date=?, designation=?";
    $params = array($name, $position, $age, $salary, $email, $contact, $start_date, $designation);

    // Add image URL parameter if $image is not null
    if ($image !== null) {
        $query .= ", image_url=?";
        $params[] = $image;
    }

    $query .= " WHERE id=?";
    $params[] = $id;

    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    $types = str_repeat('s', count($params)); // Determine types for bind_param
    mysqli_stmt_bind_param($stmt, $types, ...$params);

    // Execute statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error updating employee'));
    }

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request'));
}

// Close connection
mysqli_close($conn);
