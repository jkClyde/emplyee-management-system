<?php
session_start();
if (empty($_SESSION['user_id'] || empty($_SESSION['first_name']))) {
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
    <title>EMS - Profile</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Custom styles */
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .edit-button {
            margin-top: 10px;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include('includes/sidebar.php'); ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include('includes/navbar.php'); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center mb-4">
                                <img src="img/profile_silo.png" alt="Profile Picture" class="profile-image mb-3">
                                <div>
                                    <input type="file" id="profile-image-upload" style="display: none;">
                                    <label for="profile-image-upload" class="btn btn-sm btn-primary"><i class="fas fa-camera"></i> Change Picture</label>
                                </div>
                                <h4 class="mt-3"><?php echo $_SESSION['first_name'] . " " . $_SESSION['middle_initial'] . " " . $_SESSION["last_name"]; ?></h4>
                                <p><?php echo $_SESSION['role']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <form id="profile-form">
                                <div class="form-group">
                                    <label for="first-name">First Name</label>
                                    <input type="text" class="form-control" id="first-name" value="<?php echo $_SESSION['first_name']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="middle-initial">Middle Initial</label>
                                    <input type="text" class="form-control" id="middle-initial" value="<?php echo $_SESSION['middle_initial']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="full-name">Last Name</label>
                                    <input type="text" class="form-control" id="last-name" value="<?php echo $_SESSION['last_name']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" value="<?php echo $_SESSION['email']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="contact-number">Contact Number</label>
                                    <input type="text" class="form-control" id="contact-number" value="<?php echo $_SESSION['contact']; ?>" disabled>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary edit-button">Edit</button>
                                <button type="button" class="btn btn-sm btn-secondary" style="display: none;">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success" style="display: none;">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <?php // include('includes/footer.php'); 
            ?>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <?php
    include('includes/modals/logout_modal.php');
    include('includes/jquery_scripts.php');
    ?>

    <script>
        $(document).ready(function() {
            $(".edit-button").click(function() {
                $(".form-control").prop("disabled", false);
                $(".edit-button").hide();
                $(".btn-secondary").show();
                $(".btn-success").show();
            });

            $(".btn-secondary").click(function() {
                $(".form-control").prop("disabled", true);
                $(".edit-button").show();
                $(".btn-secondary").hide();
                $(".btn-success").hide();
            });

            $("#profile-form").submit(function(event) {
                event.preventDefault();
                $(".form-control").prop("disabled", true);
                $(".edit-button").show();
                $(".btn-secondary").hide();
                $(".btn-success").hide();
            });
        });
    </script>
</body>

</html>