<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="index.php">
            <strong>Churchill Laugh Industry Events</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-4 font-weight-bold">
                    <a class="nav-link" href="../views/viewEvent.php">Home</a>
                </li>
                <?php
                session_start();
                if (isset($_SESSION['email'])) {
                    ?>
                    <li class="nav-item dropdown mr-4 font-weight-bold">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="http://127.0.0.1/churchil_event_tickets/views/addEvent.php">New Event</a>
                            <a class="dropdown-item" href="http://127.0.0.1/churchil_event_tickets/views/events.php">Manage Events</a>

                        </div>
                    </li>
            </ul>



            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item font-weight-bold ">
                    <a href="../controllers/logout.php" class="nav-link border border-light rounded" id="notReady">
                        <i class="mr-auto ml-auto"></i>Logout
                    </a>
                </li>
            </ul>
        <?php
        } else {
            ?>
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item font-weight-bold ">
                    <a href="#" class="nav-link border border-light rounded" id="notReady">
                        <i class="mr-auto ml-auto"></i>Admin
                    </a>
                </li>
            </ul>
        <?php
        }
        ?>

        </div>
    </div>
</nav>