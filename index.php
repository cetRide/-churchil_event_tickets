<!DOCTYPE html>
<html lang="en">
<?php include('utils/head.php') ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\churchil_event_tickets\models\manage_events.php'); ?>

<style>
    .reserve-btn {
        transform: skew(-20deg);
    }
</style>

<body style="background-color: whitesmoke">
    <?php include('utils/navbar.php') ?>
    <main class="container">
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
            <p class="h6 mt-4">Choose the upcoming event and reserve your ticket.Also you can reserve for friends..</p>
            <!--Carousel Wrapper-->
            <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
                <!--Slides-->
                <div class="carousel-inner" role="listbox">
                    <!--First slide-->
                    <?php
                        foreach ($events as $event) {
                            $slide_active = null;
                            if ($active == $event) {
                                $slide_active = "active";
                            }
                            $remaining_ticket = $eventsObj->remainingTickets($event['event_id']);

                            ?>
                        <!-- event details -->
                        <div class="carousel-item <?php echo $slide_active; ?>">
                            <div class="">
                                <div class="ml-3">
                                    <p><i class="far fa-heart text-danger"></i> <em class="h3 my-5 text-primary"><?php echo $event['name'] = ucfirst($event['name']); ?></em>
                                    </p>
                                </div>

                                <div class="card z-depth-5 hoverable">
                                    <div class="row d-flex justify-content-end">
                                        <div class="col-md-5 mb-1 view overlay zoom">
                                            <img src="images/event2.jpg" class="img-fluid rounded" style="height: 350px; width: 450px; display: block; color: green; font-size: 36px; font-style: italic; font-family: Georgia, serif;" alt="This Event has no banner...">
                                        </div>

                                        <div class="col p-3">
                                            <div>
                                                <p class="h4 text-center text-primary my-3">Event description</p>
                                                <div class="col-md-8 ml-auto mr-auto border border-success p-4" style="border-radius: 15px;">
                                                    <p><?php echo $event['description'] = ucfirst($event['description']); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-7 ml-auto mr-auto p-4 row d-flex justify-content-between" style="border-radius: 15px;">
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
                                        </div>
                                    </div>

                                    <div class=" mt-3 px-1">
                                        <div class="d-inline-block px-4">
                                            <p class="text-danger font-weight-bold"><i class="fas fa-map-marker-alt mr-4"></i>Venue</p>
                                            <p><?php echo $event['location'] = ucfirst($event['location']); ?></p>
                                        </div>
                                        <div class="d-inline-block px-4">
                                            <p class="text-danger font-weight-bold"><i class="far fa-clock mr-4"></i>Date</p>
                                            <p><?php echo $event['time'] = date("F j, Y, g:i a"); ?></p>
                                        </div>
                                        <div class=" d-inline-block px-4">
                                            <p class="text-warning font-weight-bold"><i class="fas fa-ticket-alt mr-4"></i>VIP Tickets</p>
                                            <p>
                                                <?php echo $remaining_ticket[0]; ?> Tickets left

                                            </p>
                                        </div>
                                        <div class="d-inline-block px-4">
                                            <p class="text-success font-weight-bold"><i class="fas fa-ticket-alt mr-4"></i>Regular Tickets</p>
                                            <p>
                                                <?php echo $remaining_ticket[1]; ?> Tickets left
                                            </p>
                                        </div>
                                        <div class="d-inline-block ">
                                            <form action="controllers/reservation.php" method="POST">
                                                <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">
                                                <input type="hidden" name="event_name" value="<?php echo $event['name']; ?>">
                                                <input type="hidden" name="regular_price" value="<?php echo $event['regular_price']; ?>">
                                                <input type="hidden" name="vip_price" value="<?php echo $event['vip_price'] ?>">
                                                <button class="reserve-btn btn btn-primary text-white" type="submit" name="reserve">Reserve your ticket Now</button>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    <?php

                        } ?>
                </div>
                <!--/.Slides-->
                <!--Controls-->
                <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon text-primary font-weight-bold" aria-hidden="true">Previous</span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                    <span class="carousel-control-next-icon text-primary font-weight-bold" aria-hidden="true">Next</span>
                    <span class="sr-only">Next</span>
                </a>
                <!--/.Controls-->
            </div>
            <!--/.Carousel Wrapper-->
            </div>
        <?php
        } ?>
    </main>
    <?php include('utils/footer.php') ?>
    <?php include('utils/bottom.php') ?>
</body>