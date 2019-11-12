<!-- Navbar -->
<?php
// session_start();
$action = "../controllers/login.php";
$logout = "../controllers/logout.php";
$home_link = "../index.php";
$add_event_link = "../views/addEvent.php";
$modify_event_link = "../views/events.php";
if ($_SERVER['REQUEST_URI'] == "/churchil_event_tickets/index.php") {
    $action = "controllers/login.php";
    $logout = "controllers/logout.php";
    $home_link = "/churchil_event_tickets/index.php";
    $add_event_link = "views/addEvent.php";
    $modify_event_link = "views/events.php";
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href=<?php echo  $home_link; ?>>
            <strong>Churchill Laugh Industry Events</strong>
        </a>
        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-4 font-weight-bold">
                    <a class="nav-link" href=<?php echo  $home_link; ?>>Home</a>
                </li>
                <?php

                if (isset($_SESSION['email'])) {
                    ?>
                    <li class="nav-item dropdown mr-4 font-weight-bold">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href=<?php echo  $add_event_link; ?>>New Event</a>
                            <a class="dropdown-item" href=<?php echo  $modify_event_link; ?>>Manage Events</a>

                        </div>
                    </li>
            </ul>
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item font-weight-bold ">
                    <a href=<?php echo $logout; ?> class="nav-link border border-light rounded" id="notReady">
                        <i class="mr-auto ml-auto"></i>Logout
                    </a>
                </li>
            </ul>
        <?php
        } else {
            ?>
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item font-weight-bold ">
                    <button class="nav-link border border-white btn-primary rounded" title="LOG IN" id="form-popover" data-toggle="popover" data-placement="bottom">Admin</button>
                </li>
            </ul>
        <?php
        }
        ?>
        </div>
    </div>
    <div class="d-none">

        <form id="form" action=<?php echo $action; ?> method="POST">
            <!-- Email -->
            <input type="email" id="defaultLoginFormEmail" name="email" class="form-control form-control-sm mb-4" placeholder="E-mail">
            <!-- Password -->
            <input type="password" id="defaultLoginFormPassword" name="password" class="form-control form-control-sm mb-4" placeholder="Password">
            <button class="my-1 text-capitalize btn btn-primary btn-block mb-1 py-2" name="login" type="submit">Sign
                In</button>
        </form>
    </div>
</nav>