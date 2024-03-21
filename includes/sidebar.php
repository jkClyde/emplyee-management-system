
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-text mx-3">Clyde Corp. EMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        FEATURES
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
    <a class="nav-link" href="./employees.php">
        <i class="fas fa-user fa-chart-area"></i>
        <span>Manage Employees</span></a>

    
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" >
            <i class="fas fa-users"></i>
            <span>Add Roles</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" >
            <i class="far fa-calendar-alt"></i>
            <span>Calendar</span>
        </a>
    </li>

        



    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->



</ul>

<script>
    $(document).ready(function() {
    // Function to toggle sidebar based on screen width
    function toggleSidebar() {
        if ($(window).width() < 768) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $('.sidebar .collapse').collapse('hide');
        } else {
            $("body").removeClass("sidebar-toggled");
            $(".sidebar").removeClass("toggled");
        }
    }

    // Initial call to toggleSidebar
    toggleSidebar();

    // Call toggleSidebar on window resize
    $(window).resize(function() {
        toggleSidebar();
    });
});
</script>
<!-- End of Sidebar -->