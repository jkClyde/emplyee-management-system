<?php
    session_start();
    if(empty($_SESSION['user_id'])){
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
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
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Age</th>
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
            ?>

            
           
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <?php
        include('includes/modals/logout_modal.php');
    ?>
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for editing employee -->
                <form id="editEmployeeForm">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_position">Position</label>
                        <input type="text" class="form-control" id="edit_position" name="edit_position" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_age">Age</label>
                        <input type="number" class="form-control" id="edit_age" name="edit_age" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="edit_start_date">Start Date</label>
                        <input type="date" class="form-control" id="edit_start_date" name="edit_start_date" required>
                    </div> -->
                    <div class="form-group">
                        <label for="edit_salary">Salary</label>
                        <input type="number" class="form-control" id="edit_salary" name="edit_salary" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/data_table.js"></script>



  





                                                    <!-- MODALS -->
<script>
    $(document).ready(function() {
     // ADD EMPLOYEE BUTTON CLICK ==================================================================================
     $('#add_employee_button').click(function() {
        $('#addEmployeeModal').modal('show');
    });
    $('#addEmployeeModal').on('hidden.bs.modal', function () {
        $('#addEmployeeForm')[0].reset();
    });
    // EDIT BUTTON CLICK ==============================================================================================
    $('#dataTable').on('click', '.edit-btn', function() {
        var employeeId = $(this).data('id');
        $.ajax({
            url: 'php/get_employee.php',
            type: 'POST',
            data: {id: employeeId},
            dataType: 'json',
            success: function(response) {
                $('#edit_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_position').val(response.position);
                $('#edit_age').val(response.age);
                $('#edit_start_date').val(response.start_date);
                $('#edit_salary').val(response.salary);
                $('#editEmployeeModal').modal('show');
            },
            error: function(xhr, status, error) {
                alert('Error fetching employee data: ' + error);
            }
        });
    });
});
</script>
    



</body>

</html>