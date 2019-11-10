<!DOCTYPE html>
<html lang="en">
<?php include('../utils/head.php') ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\churchil_event_tickets\models\manage_events.php'); ?>

<style>
    .reserve-btn {
        transform: skew(-20deg);
    }
</style>

<body style="background-color: whitesmoke">
    <?php include('../views/navbar.php') ?>
    <main class="container">
        <p class="h6 mt-4">Choose the upcoming event and reserve your ticket.Also you can reserve for friends..</p>
        <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner" role="listbox">

                <?php
                include_once('../models/manage_events.php');
                $eventsObj = new manageEvents();
                $events = $eventsObj->getEvents();
                foreach ($events as $event) {



                    ?>


                    <div class="carousel-item active">
                        <div class="mt-4">
                            <p><i class="far fa-heart text-danger"></i> <em class="h3 my-5 text-primary"><?php echo $event['name']; ?></em>
                            </p>
                            <div class="card">
                                <div class="row d-flex justify-content-end" style="background-color: whitesmoke;">
                                    <div class="col-md-6">
                                        <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg" width="500" height="462" style="width: 100%; height: auto; display: block; color: green; font-size: 36px; font-style: italic; font-family: Georgia, serif;" alt="This Event has no banner..." />
                                    </div>
                                    <div class="col p-3">
                                        <div>
                                            <p class="h4 text-center text-primary my-4">Event description</p>


                                            <p><?php echo $event['description']; ?></p>
                                        </div>
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

                                <div class=" mt-3 px-1">
                                    <div class="d-inline-block px-4">
                                        <p class="text-danger font-weight-bold"><i class="fas fa-map-marker-alt mr-4"></i>Venue</p>
                                        <p><?php echo $event['location']; ?></p>
                                    </div>
                                    <div class="d-inline-block px-4">
                                        <p class="text-danger font-weight-bold"><i class="far fa-clock mr-4"></i>Date</p>
                                        <p><?php echo $event['time']; ?></p>
                                    </div>
                                    <div class=" d-inline-block px-4">
                                        <p class="text-warning font-weight-bold"><i class="fas fa-ticket-alt mr-4"></i>VIP Tickets</p>
                                        <p>
                                            ******Tickets left
                                        </p>
                                    </div>
                                    <div class="d-inline-block px-4">
                                        <p class="text-success font-weight-bold"><i class="fas fa-ticket-alt mr-4"></i>Regular Tickets</p>
                                        <p>
                                            ***** Tickets left
                                        </p>
                                    </div>
                                    <div class="d-inline-block ">
                                        <form action="../controllers/reservation.php" method="POST">
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

            <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bg-danger" aria-hidden="true"></span>
                <span class="sr-only ">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                <span class="carousel-control-next-icon bg-danger" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!--/.Carousel Wrapper-->
    </main> 
    <?php include('../views/footer.php') ?>
    <?php include('../utils/bottom.php') ?>
</body>