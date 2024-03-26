<?php
include("../db_init.php");

// Fetch available positions from tbl_categories
$sqlPositions = "SELECT * FROM tbl_categories";
$resultPositions = $conn->query($sqlPositions);

if ($resultPositions->num_rows > 0) {
    while ($row = $resultPositions->fetch_assoc()) {
        // Generate the delete button with the corresponding category ID
        echo '<li class="list-group-item d-flex justify-content-between align-items-center">' . $row['category'] . '<button class="btn btn-sm btn-outline-danger roles-delete-btn" data-id="' . $row['id'] . '"><i class="fas fa-trash"></i></button></li>';
    }
} else {
    echo '<li class="list-group-item">No positions available</li>';
}
