<?php
include("../db_init.php");

// Fetch available designations from tbl_designation
$sqlDesignations = "SELECT * FROM tbl_designation";
$resultDesignations = $conn->query($sqlDesignations);

if ($resultDesignations->num_rows > 0) {
    while ($row = $resultDesignations->fetch_assoc()) {
        echo '<li class="list-group-item d-flex justify-content-between align-items-center">' . $row['designation'] . '<button class="btn btn-sm btn-outline-danger delete-designation-btn" data-id="' . $row['id'] . '"><i class="fas fa-trash"></i></button></li>';
    }
} else {
    echo '<li class="list-group-item">No designations available</li>';
}
