<!DOCTYPE html>
<html lang="en">
<?php include('utils/head.php') ?>
<?php require_once('models/manage_events.php'); ?>



<body style="background-color: whitesmoke">
    <?php include('utils/navbar.php') ?>
    <header>
        <div class="overlay"></div>
        <video playsinline autoplay muted loop>
            <source src="videos/a.mp4" type="video/mp4">
        </video>
        <div class="container h-100">
            <div class="d-flex h-100 text-center align-items-center">
                <div class="w-100 text-white">
                    <h1 class="display-3">Laugh Industry</h1>
                    <p class="lead mb-0">More than just Comedy</p>
                    <p class="lead">
                        <a class="btn btn-danger btn py-3 px-5 text-capitalize reserve-btn" href="#ev" role="button">Reserve tickets</a>
                    </p>
                </div>
            </div>
        </div>
    </header>
    <div class="jumbotron py-4 bg-danger text-center">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-2">
                <p class="lead text-white mb-1">Home</p>
                <p class="small">– Where the Heart is</p>
            </div>
            <div class="col-md-2">
                <p class="lead text-white mb-1">Blog</p>
                <p class="small">– Exciting News</p>
            </div>
            <div class="col-md-2">
                <p class="lead text-white mb-1">About</p>
                <p class="small">– Who we are</p>
            </div>
            <div class="col-md-2">
                <p class="lead text-white mb-1">Portfolio</p>
                <p class="small">– Seeing is Believing</p>
            </div>
            <div class="col-md-2">
                <p class="lead text-white mb-1">My Shop</p>
                <p class="small">– You’ll Love Everything</p>
            </div>
        </div>
    </div>
    <div class="container" id="ev">
        <?php
        include_once('models/manage_events.php');
        $eventsObj = new manageEvents();
        $events = $eventsObj->getEvents();
        $active = reset($events);
        if (empty($events)) {
            ?>
            <img src="images/logo.png" style="width: 50%; height: 40%;">
            <div class="col-md-4 ml-auto mr-auto">
                <img src="images/no-events.jpg" alt="NO events" style=" display: block; margin-left: auto; height: 100%; width: 100%; margin-right: auto;">
            </div>
        <?php
        } else {
            ?>
            <p class="h3 mt-4">Upcoming Events</p>
            <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php
                        foreach ($events as $event) {
                            $slide_active = null;

                            $MessageW = wordwrap($event['description'], 60, "\n", true);
                            $MessageW = htmlentities($MessageW);
                            $MessageW = nl2br($MessageW);
                            $capsDesc = ucfirst($MessageW);
                            if ($active == $event) {
                                $slide_active = "active";
                            }
                            // $remaining_ticket = $eventsObj->remainingTickets($event['event_id']);

                            ?>
                        <div class="carousel-item <?php echo $slide_active; ?>">
                            <!-- <div class="">
                                <div class="card z-depth-5 hoverable">
                                    <div class="row d-flex justify-content-between border">
                                        <div class="col-sm-4 mb-1 view overlay border zoom">
                                            <img src="images/<?php echo $event['banner']; ?>" class="img-fluid rounded" style="height: 350px; width: 100%; display: block; color: green; font-size: 36px; font-style: italic; font-family: Georgia, serif;" alt="This Event has no banner...">
                                        </div>
                                        <div class="col-md p-3">
                                            <div>
                                                <p class="h4 text-center my-3">Event description</p>
                                                <div class="col-md-8 ml-auto mr-auto border p-4" style="border-radius: 15px;">
                                                    <p><?php echo $event['description'] = ucfirst($event['description']); ?></p>
                                                </div>
                                            </div>
                                            <div class="col ml-auto mr-auto p-4 row d-flex justify-content-between" style="border-radius: 15px;">
                                                <div class="d-inline-block ">
                                                    <p class="h3">
                                                        Regular
                                                    </p>
                                                    <p>@<?php echo $event['regular_price']; ?> Ksh
                                                    </p>
                                                </div>
                                                <div class="d-inline-block px-4">
                                                    <p class="h3">
                                                        VIP
                                                    </p>
                                                    <p>@ <?php echo $event['vip_price']; ?> Ksh
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ml-auto mr-auto">
                                                <form action="controllers/reservation.php" method="POST">
                                                    <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">
                                                    <input type="hidden" name="event_name" value="<?php echo $event['name']; ?>">
                                                    <input type="hidden" name="regular_price" value="<?php echo $event['regular_price']; ?>">
                                                    <input type="hidden" name="vip_price" value="<?php echo $event['vip_price'] ?>">
                                                    <input type="hidden" name="location" value="<?php echo $event['location']; ?>">
                                                    <input type="hidden" name="date" value="<?php echo $event['time'] ?>">
                                                    <button type="submit" name="reserve" class="btn btn-danger btn-sm btn-block">Buy Ticket</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <div class=" mt-3 col-md-4 px-5 mb-3">
                                        <h4><?php echo $event['name'] = ucfirst($event['name']); ?></h4>
                                        <p class="small m-0"><i class="fas fa-map-marker-alt mr-4 text-danger"></i>
                                            <?php echo $event['location'] = ucfirst($event['location']); ?></p>
                                        <p class="small m-0 my-3"><i aria-hidden="true" class="fa fa-calendar text-danger mr-4"></i>
                                            <?php echo $event['time'] = date("F j, Y, g:i a"); ?></p>


                                    </div>

                                </div>
                            </div> -->
                            <div id="container">
                                <!-- Startevent details -->
                                <div class="event-details p-3">
                                    <!-- 	event Name -->
                                    <h1 class="text-danger mb-2 text-center"><?php echo $event['name']; ?></h1>
                                    <hr>
                                    <!-- The most important information about the event -->
                                    <div class="information">
                                        <p><i class="fas fa-map-marker-alt mr-4"></i><?php echo $event['location']; ?></p>
                                        <p><i class=" far fa-clock mr-4"></i><?php echo $event['time']; ?></p>
                                        <div class="d-inline-block mr-3">
                                            <p class="font-weight-bold">VIP</p>
                                            <p>@Kes <?php echo $event['vip_price']; ?></p>
                                        </div>
                                        <div class="d-inline-block">
                                            <p class="font-weight-bold">Regular</p>
                                            <p>@Kes <?php echo $event['regular_price']; ?></p>
                                        </div>
                                        <div class="">
                                            <form action="controllers/reservation.php" method="POST">
                                                <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">
                                                <input type="hidden" name="event_name" value="<?php echo $event['name']; ?>">
                                                <input type="hidden" name="regular_price" value="<?php echo $event['regular_price']; ?>">
                                                <input type="hidden" name="vip_price" value="<?php echo $event['vip_price'] ?>">
                                                <input type="hidden" name="location" value="<?php echo $event['location']; ?>">
                                                <input type="hidden" name="date" value="<?php echo $event['time'] ?>">
                                                <button type="submit" name="reserve" class="btn btn-danger reserve-btn ">Buy Ticket</button>
                                            </form>

                                        </div>
                                    </div>

                                </div>


                                <div class="event-image">

                                    <img src="images/<?php echo $event['banner']; ?>" class="img-fluid rounded" style="display: block; color: green; font-size: 36px; font-style: italic; font-family: Georgia, serif;" alt="This Event has no banner...">

                                    <!-- 	event Information-->
                                    <div class="info">
                                        <h2 class="text-danger">Event Description</h2>
                                        <p class="p-2">
                                            <?php echo $capsDesc; ?>
                                        </p>
                                    </div>
                                    <em><small class="text-muted">hover banner<i class="ml-3 text-danger fas fa-angle-right"></i></small></em>

                                </div>
                                <!--  End event image  -->
                            </div>
                        </div>
                    <?php

                        } ?>
                </div>
                <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon text-primary font-weight-bold" aria-hidden="true">Previous</span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                    <span class="carousel-control-next-icon text-primary font-weight-bold" aria-hidden="true">Next</span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
    </div>
<?php
} ?>
</div>
<?php include('utils/footer.php') ?>
<?php include('utils/bottom.php') ?>
</body>