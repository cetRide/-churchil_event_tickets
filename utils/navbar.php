    <!-- Navbar -->
    <?php
    // session_start();
    $action = "../controllers/login.php";
    $logout = "../controllers/logout.php";
    $home_link = "../index.php";
    $add_event_link = "../views/addEvent.php";
    $modify_event_link = "../views/events.php";
    if (($_SERVER['REQUEST_URI'] == "/churchil_event_tickets/index.php") || ($_SERVER['REQUEST_URI'] == "/churchil_event_tickets/")) {
        $action = "controllers/login.php";
        $logout = "controllers/logout.php";
        $home_link = "/churchil_event_tickets/index.php";
        $add_event_link = "views/addEvent.php";
        $modify_event_link = "views/events.php";
    }
    ?>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href=<?php echo  $home_link; ?>>
                Churchill Show
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-4">
                        <a class="nav-link" href=<?php echo  $home_link; ?>>Home</a>
                    </li>
                    <?php

                    if (isset($_SESSION['email'])) {
                        ?>
                        <li class="nav-item dropdown mr-4">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href=<?php echo  $add_event_link; ?>>New Event</a>
                                <a class="dropdown-item" href=<?php echo  $modify_event_link; ?>>Manage Events</a>

                            </div>
                        </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href=<?php echo $logout; ?> class="nav-link border border-light rounded" id="notReady">
                            <i class="mr-auto ml-auto"></i>Logout
                        </a>
                    </li>
                </ul>
            <?php
            } else {
                ?>
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <button class="nav-link m-0 px-3 hoverable text-capitalize btn login-btn border border-danger text-danger admin-btn btn" title="LOG IN" id="form-popover" data-toggle="popover" data-placement="bottom">Admin</button>
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
                <input type="email" id="defaultLoginFormEmail" name="email" value="<?php if (isset($_COOKIE['Email'])) echo $_COOKIE['Email']; ?>" class="form-control form-control-sm mb-4" placeholder="E-mail">
                <!-- Password -->
                <input type="password" id="defaultLoginFormPassword" name="password" value="<?php if (isset($_COOKIE['Password'])) echo $_COOKIE['Password']; ?>" class="form-control form-control-sm mb-4" placeholder="Password">
                <button class="my-1 text-capitalize btn btn-danger btn-block mb-1 py-2" name="login" type="submit">Sign
                    In</button>
            </form>
        </div>
    </nav>