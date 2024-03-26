<style>
    /* CSS for the image container */
    .image-container {
        width: 100%;
        /* Ensure container takes up full width */
        max-width: 200px;
        /* Adjust max-width as needed */
        height: 200px;
        /* Set a fixed height */
        overflow: hidden;
        /* Hide any overflow */
        position: relative;
        /* Position relative for absolute positioning */
        border: 1px solid #ced4da;
        /* Add border for visual clarity */
    }

    /* CSS for the image within the container */
    .image-container img {
        width: 100%;
        /* Make sure the image takes up full width */
        height: auto;
        /* Auto height to maintain aspect ratio */
        position: absolute;
        /* Position absolute for centering */
        top: 50%;
        /* Position the image at the vertical center */
        left: 50%;
        /* Position the image at the horizontal center */
        transform: translate(-50%, -50%);
        /* Translate back by half of width and height */
    }
</style>


<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeForm" class="row" enctype="multipart/form-data" method="POST">
                    <!-- Image Section -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="image">Image / ID</label>
                            <div class="image-container">
                                <img src="img/profile_silo.png" class="img-fluid" alt="" id="previewImage">
                            </div>
                            <!-- File Input for Image -->
                            <input class="form-control" type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="" />
                        </div>
                    </div>

                    <!-- Personal Information -->

                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-primary">Personal Information</h4>
                            </div>
                        </div>

                        <!-- First Row -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <input type="text" class="form-control" id="position" name="position" required>
                                </div>
                            </div> -->



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <select class="form-control" id="position" name="position" required>
                                        <option value="">Select Position</option>
                                        <?php


                                        // SQL query to fetch positions from tbl_categories
                                        $sql = "SELECT * FROM tbl_categories";
                                        $result = $conn->query($sql);

                                        // If positions are found, generate options
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=\"" . $row['category'] . "\">" . $row['category'] . "</option>";
                                            }
                                        } else {
                                            echo "No positions found";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="position">Designation</label>
                                    <select class="form-control" id="designation" name="designation" required>
                                        <option value="">Select Designation</option>
                                        <?php

                                        // SQL query to fetch positions from tbl_categories
                                        $sql = "SELECT * FROM tbl_designation";
                                        $result = $conn->query($sql);

                                        // If positions are found, generate options
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=\"" . $row['designation'] . "\">" . $row['designation'] . "</option>";
                                            }
                                        } else {
                                            echo "No positions found";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="number" class="form-control" id="age" name="age" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="salary">Salary</label>
                                    <input type="text" class="form-control" id="salary" name="salary" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- Contact Information -->
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-primary">Contact Information</h4>
                            </div>
                        </div>
                        <!-- Second Row -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input type="tel" class="form-control" id="contact" name="contact" required>
                                </div>
                            </div>

                        </div>
                        <br>
                        <!-- Buttons -->
                        <div class="row justify-content-center">
                            <div class="col-md-3 mb-2 mb-md-0 mr-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0 mr-md-2">
                                <button type="button" class="btn btn-secondary btn-block" id="clearForm">Clear</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-danger btn-block" id="cancelBtn">Cancel</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to clear the form?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmClear">Yes, Clear</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal for Cancel Button -->
<div class="modal fade" id="cancelConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="cancelConfirmationModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelConfirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">No, Keep Editing</button>
                <button type="button" class="btn btn-danger" id="confirmCancel" data-dismiss="modal">Yes, Cancel</button>
            </div>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Delegate change event for file inputs to the document
        $(document).on('change', '#image', function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

        // Function to clear all input fields in the form
        function clearForm() {
            $('#addEmployeeForm')[0].reset();
            $('#previewImage').attr('src', 'silhouette.jpg'); // Reset image preview
        }

        // Clear button click event handler
        $('#clearForm').click(function() {
            $('#confirmationModal').modal('show'); // Show confirmation modal for clear button
        });

        // Confirm clear button click event handler
        $('#confirmClear').click(function() {
            clearForm();
            $('#confirmationModal').modal('hide'); // Hide confirmation modal for clear button after clearing
        });

        // Cancel button click event handler
        $('#cancelBtn').click(function() {
            $('#cancelConfirmationModal').modal('show'); // Show confirmation modal for cancel button
        });

        // Confirm cancel button click event handler
        $('#confirmCancel').click(function() {
            // Handle cancel operation
            $('#addEmployeeModal').modal('hide'); // Hide add employee modal
        });

        // ADD EMPLOYEE BUTTON CLICK ==================================================================================
        $('#add_employee_button').click(function() {
            $('#addEmployeeModal').modal('show');
        });
        $('#addEmployeeModal').on('hidden.bs.modal', function() {
            $('#addEmployeeForm')[0].reset();
        });

    });
</script>