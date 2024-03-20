<?php
// Start the session
session_start();

// Include the database connection file
require_once 'db_init.php';

// Retrieve username and password from the form
$username = isset($_POST["username"]) ? $_POST["username"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

// Validate the username and password
if (empty($username) || empty($password)) {
    // Return an error response if either username or password is empty
    echo "failed: Please enter both username and password.";
    exit();
}

// Construct the query with the given username
$sql = "SELECT * FROM tbl_users WHERE username = '$username' LIMIT 1";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();

        // Verify the password using password_verify
        if ($password == $row['password']) {
            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['first_name'] = $row['firstname'];
            $_SESSION['middle_initial'] = $row['middle_initial'];
            $_SESSION['last_name'] = $row['lastname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['contact'] = $row['contact'];
            $_SESSION['role'] = $row['role'];

            echo "success";
        } else {
            echo "failed: Invalid password.";
        }
    } else {
        echo "failed: No matching user found.";
    }
} else {
    echo "failed: Query failed: " . $conn->error;
}

// Close the connection
$conn->close();
?>
