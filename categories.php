<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Categories</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        include('includes/sidebar.php');
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php
                include('includes/navbar.php');
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row justify-content-around">
                        <div class="col-md-5 mb-md-0 mb-3">
                            <h2 class="mb-3"><i class="fas fa-user mr-2"></i> Roles</h2>
                            <ul id="positionsList" class="list-group">
                            </ul>
                            <button id="addPositionBtn" class="btn btn-primary mt-3">Add Position</button>
                        </div>


                        <div class="col-md-5">
                            <h2 class="mb-3"><i class="fas fa-map-marker-alt mr-2"></i> Designations</h2>
                            <ul id="designationsList" class="list-group">
                            </ul>
                            <button id="addDesignationBtn" class="btn btn-primary mt-3">Add Designation</button>
                        </div>
                    </div>

                    <!-- Content Row -->
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- End of Content Wrapper -->

    </div>

    <!-- Add Position Modal -->
    <div class="modal fade" id="addPositionModal" tabindex="-1" role="dialog" aria-labelledby="addPositionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPositionModalLabel">Add Position</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="positionName" class="form-control" placeholder="Enter position name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="savePositionBtn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Designation Modal -->
    <div class="modal fade" id="addDesignationModal" tabindex="-1" role="dialog" aria-labelledby="addDesignationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDesignationModalLabel">Add Designation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="designationName" class="form-control" placeholder="Enter designation name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="saveDesignationBtn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <?php
    include('includes/modals/logout_modal.php');
    include('includes/jquery_scripts.php');
    ?>

    <script>
        $(document).ready(function() {
            // Log a message when the document is ready
            console.log("Document ready!");

            // Function to fetch Positions
            function fetchPositions() {
                $.ajax({
                    url: 'php/fetch/fetch_categories.php',
                    method: 'GET',
                    success: function(response) {
                        $('#positionsList').html(response);
                    }
                });
            }

            // Function to fetch Designations
            function fetchDesignations() {
                $.ajax({
                    url: 'php/fetch/fetch_designations.php',
                    method: 'GET',
                    success: function(response) {
                        $('#designationsList').html(response);
                    }
                });
            }

            // Initial fetch
            fetchPositions();
            fetchDesignations();

            // Event delegation for dynamically generated delete designation buttons
            $(document).on('click', '.delete-designation-btn', function() {
                console.log("Delete designation button clicked!");
                var designationId = $(this).data('id');
                $.ajax({
                    url: 'php/CRUD_categories/delete_designation.php',
                    method: 'POST',
                    data: {
                        id: designationId
                    },
                    success: function(response) {
                        console.log("Delete designation request successful!");
                        fetchDesignations();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Add Position Button Click
            $('#addPositionBtn').click(function() {
                $('#addPositionModal').modal('show');
            });

            // Save Position Button Click
            $('#savePositionBtn').click(function() {
                var positionName = $('#positionName').val();
                $.ajax({
                    url: 'php/CRUD_categories/add_roles.php',
                    method: 'POST',
                    data: {
                        positionName: positionName
                    },
                    success: function(response) {
                        console.log("Add Position successful!");
                        fetchPositions();
                        $('#addPositionModal').modal('hide');
                    }
                });
            });

            // Add Designation Button Click
            $('#addDesignationBtn').click(function() {
                $('#addDesignationModal').modal('show');
            });

            // Save Designation Button Click
            $('#saveDesignationBtn').click(function() {
                var designationName = $('#designationName').val();
                $.ajax({
                    url: 'php/CRUD_categories/add_designations.php',
                    method: 'POST',
                    data: {
                        designationName: designationName
                    },
                    success: function(response) {
                        console.log("Add Designation successful!");
                        fetchDesignations();
                        $('#addDesignationModal').modal('hide');
                    }
                });
            });

            // Event delegation for dynamically generated delete buttons
            $(document).on('click', '.roles-delete-btn', function() {
                console.log("Delete button clicked!");
                var categoryId = $(this).data('id');
                $.ajax({
                    url: 'php/CRUD_categories/delete_role.php',
                    method: 'POST',
                    data: {
                        id: categoryId
                    },
                    success: function(response) {
                        console.log("Delete request successful!");
                        fetchPositions(); // Update the positions list after deletion
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle errors here
                    }
                });
            });
        });
    </script>

</body>

</html>