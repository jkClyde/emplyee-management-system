<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
}
include("php/db_init.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Manage Employees</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <!-- <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                <!-- CONTENT HERE ---------------------------------------------------------------------------------------------->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h4 class="m-0 font-weight-bold text-primary">Employees Table</h4>
                            <div>
                                <button class="btn btn-primary" id="add_employee_button">Add Employee</button>
                            </div>
                        </div>
                        <div class="alert alert-success p-10 rounded-0" role="alert" id="success-notification" style="display: none;">
                            Employee added successfully! <button type="button" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <!-- Page Heading -->
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Image ID</th>
                                            <th>Name</th>
                                            <th>Position</th>

                                            <th>Age</th>
                                            <th>Designation</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>Actions</th> <!-- New column for actions -->
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END CONTENT HERE ---------------------------------------------------------------------------------------------->

            </div>
            <!-- End of Main Content -->
            <!-- MODALS -->
            <?php
            include('includes/modals/add_employee.php');
            include('includes/modals/delete_employee.php');
            include('includes/modals/edit_employee.php')
            ?>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->


    <?php
    include('includes/modals/logout_modal.php');
    include('includes/jquery_scripts.php');
    ?>








</body>



<!-- Cropper.js JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

</html>