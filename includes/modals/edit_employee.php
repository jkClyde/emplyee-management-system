    <style>
        /* CSS for the image container */
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 200px;
            height: 200px;
            overflow: hidden;
            position: relative;
            border: 1px solid #ced4da;
        }

        /* CSS for the image within the container */
        .image-container img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            display: block;
            margin: auto;
        }

        /* Lower opacity for the main modal backdrop when confirmation modal shows */
        .modal-backdrop.show {
            opacity: 0.5;
            /* Adjust the opacity as needed */
        }
    </style>


    <!-- Add Employee Modal -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModal" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm" class="row">
                        <!-- Image Section -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="image">Image / ID</label>
                                <div id="newImageContainer" class="col-md-3 image-container">
                                    <!-- Image will be dynamically inserted here -->
                                </div>
                                <br>
                                <input class="form-control" type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="" />


                            </div>
                        </div>



                        <div class="col-md-9">

                            <!-- Tabs Navigation -->
                            <ul class="nav nav-tabs" id="editEmployeeTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="personalInfo-tab" data-toggle="tab" href="#personalInfo" role="tab" aria-controls="personalInfo" aria-selected="true">
                                        <span class="d-none d-md-inline">
                                            <i class="fa fa-user"></i> Personal Information
                                        </span>
                                        <span class="d-md-none">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="education-tab" data-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="false">
                                        <span class="d-none d-md-inline">
                                            <i class="fa fa-graduation-cap"></i> Educational Background
                                        </span>
                                        <span class="d-md-none">
                                            <i class="fa fa-graduation-cap"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>



                            <!-- Tabs Content -->
                            <div class="tab-content" id="editEmployeeTabsContent">
                                <!-- Personal Information Tab -------------------------------------------------------------------------------->
                                <div class="tab-pane fade show active" id="personalInfo" role="tabpanel" aria-labelledby="personalInfo-tab">
                                    <!-- First Row -->
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="hidden" name="edit_id" id="edit_id">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="edit_name" name="edit_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="position">Position</label>
                                                <select class="form-control" id="edit_position" name="edit_position" required>
                                                    <option value="">Select Position</option>
                                                    <?php
                                                    // Check connection
                                                    if ($conn->connect_error) {
                                                        die("Connection failed: " . $conn->connect_error);
                                                    }

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
                                                <select class="form-control" id="edit_designation" name="edit_designation" required>
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
                                                <input type="number" class="form-control" id="edit_age" name="edit_age" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="start_date">Start Date</label>
                                                <input type="date" class="form-control" id="edit_start_date" name="edit_start_date" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="salary">Salary</label>
                                                <input type="text" class="form-control" id="edit_salary" name="edit_salary" required>
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
                                                <input type="email" class="form-control" id="edit_email" name="edit_email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contact">Contact</label>
                                                <input type="tel" class="form-control" id="edit_contact" name="edit_contact" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Educational Background Tab ----------------------------------------------------------------------------------->
                                <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                                    <!-- Educational background fields here -->

                                    <br>
                                    <!-- Contact Information -->
                                    <div class="row">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Level</th>
                                                    <th scope="col">Name of School</th>
                                                    <th scope="col">Degree/Course</th>
                                                    <th scope="col">Year Graduated</th>
                                                    <th scope="col">Academic Achievements</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Populated Items Go Here -->
                                                <tr>
                                                    <td>High School</td>
                                                    <td>XYZ High School</td>
                                                    <td>High School Diploma</td>
                                                    <td>2015</td>
                                                    <td>Summa Cum Laude</td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil-fill"></i></button>
                                                        <button class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash-fill"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Undergraduate</td>
                                                    <td>ABC University</td>
                                                    <td>Bachelor's Degree in Computer Science</td>
                                                    <td>2019</td>
                                                    <td>Magna Cum Laude</td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil-fill"></i></button>
                                                        <button class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash-fill"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Graduate</td>
                                                    <td>DEF Institute of Technology</td>
                                                    <td>Master's Degree in Data Science</td>
                                                    <td>2021</td>
                                                    <td>With Honors</td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil-fill"></i></button>
                                                        <button class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash-fill"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>

                            </div>

                            <br>
                            <!-- Buttons -->
                            <div class="row justify-content-center">
                                <div class="col-md-3 mb-2 mb-md-0 mr-md-2">
                                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-danger btn-block" id="edit-cancelBtn" data-toggle="modal" data-target="#confirmCancelModal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Add a confirmation modal -->
    <div class="modal fade" id="confirmCancelModal" tabindex="-1" role="dialog" aria-labelledby="confirmCancelModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmCancelModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel? Any unsaved changes will be lost.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmCancelBtn" data-dismiss="modal">Yes, Cancel</button>

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
                        $('#newImageContainer').html('<img src="' + e.target.result + '" class="img-fluid" alt="">');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            // Handle cancel confirmation
            $('#confirmCancelBtn').click(function() {
                $('#editEmployeeModal').modal('hide'); // Hide the edit modal
                // Clear any unsaved changes if needed
            });

            // EDIT BUTTON CLICK
            $('#dataTable').on('click', '.edit-btn', function() {
                var employeeId = $(this).data('id');
                $.ajax({
                    url: 'php/get_employee.php',
                    type: 'POST',
                    data: {
                        id: employeeId
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); // Log the entire response object to the console

                        $('#edit_id').val(response.id);
                        $('#edit_name').val(response.name);
                        $('#edit_position').val(response.position);
                        $('#edit_designation').val(response.designation);
                        $('#edit_age').val(response.age);
                        $('#edit_start_date').val(response.start_date);
                        $('#edit_salary').val(response.salary);
                        $('#edit_email').val(response.email);
                        $('#edit_contact').val(response.contact);
                        $('#newImageContainer').html('<img src="php/uploads/' + response.image_url + '" class="img-fluid" alt="">');

                        // Clear the input file field
                        $('#image').val('');

                        $('#editEmployeeModal').modal('show');

                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching employee data: ' + error);
                    }
                });
            });
        });
    </script>