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
    <title>EMS - Dashboard</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

    <script src="fullcalendar/dist/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');



            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Initial calendar view
                headerToolbar: { // Customize the buttons on the top
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                events: [ // Example event data - replace with your dynamic data
                    {
                        title: 'Meeting',
                        start: '2024-03-25T10:00:00',
                        end: '2024-03-25T12:00:00'
                    },
                    {
                        title: 'Lunch Out',
                        start: '2024-03-28T12:30:00'
                    }
                ]
            });


            calendar.render();
        });
    </script>

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

                    <div id='calendar'></div>







                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <?php
    include('includes/modals/logout_modal.php');
    include('includes/jquery_scripts.php');
    ?>
</body>

</html>