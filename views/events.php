<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
} else {

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include('../utils/head.php'); ?>

    <body style="background-color: whitesmoke">
        <?php include('../utils/navbar.php') ?>
        <main>
            <div class="container mt-">
                <img src="../images/logo.png" style="width: 50%; height: 40%;">
                <?php
                    include_once('../models/manage_events.php');
                    $eventsObj = new manageEvents();
                    $events = $eventsObj->getEvents();
                    if (!(empty($events))) {
                        ?>
                    <p class="h4 my-4">Select an Event you want modify</p>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <?php
                                        foreach ($events as $event) {
                                            ?>
                                    <td><?php echo $event['name']; ?></td>
                                    <td><?php echo $event['location']; ?></td>

                                    <td>
                                        <a href="" data-toggle="modal" data-target="#event<?php echo $event['event_id']; ?>">
                                            <button class="hoverable text-capitalize btn-sm btn btn-success">Edit</button>
                                        </a>
                                        <a href="" data-toggle="modal" data-target="#del<?php echo $event['event_id']; ?> " class=" text-danger">Delete</a>
                                    </td>

                                    <!-- edit modal start -->
                                    <div class="modal fade " id="event<?php echo $event['event_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog card" role="document">
                                            <div class="modal-content p-5">
                                                <div class="row d-flex justify-content-between">
                                                    <div>
                                                        <h5 class="text-danger text-center font-weight-bolder">Modify Event</h5>
                                                    </div>

                                                    <div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <form action="../controllers/handle_event.php" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="id" value="<?php echo $event['event_id'] ?>">
                                                            <div class="mb-2">
                                                                <label for="name">Event Name</label>
                                                                <input class="form-control form-control-sm" type="text" name="name" value="<?php echo $event['name']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="venue">Location/Venue</label>
                                                                <input class="form-control form-control-sm" type="text" name="location" value="<?php echo $event['location']; ?>" required>
                                                            </div>
                                                            <div class="d-inline-block mb-2">
                                                                <label for="starts">Event date & Time</label>
                                                                <input class="form-control form-control-sm" type="text" name="date" id="picker" onkeydown="return false" value="<?php echo $event['time']; ?>" required>
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="exampleFormControlTextarea3">Event Description</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" name="event_description" required><?php echo $event['description']; ?></textarea>
                                                            </div>
                                                            <label for="banner">Event Banner</label>
                                                            <div>
                                                                <div class="border bg-white text-center p-5">
                                                                    <div>
                                                                        <img src="../images/<?php echo $event['banner']; ?>" class="img-fluid rounded" style="height: 250px; width: auto; display: block; color: green; font-size: 36px; font-style: italic; font-family: Georgia, serif;" alt="This Event has no banner...">
                                                                    </div>
                                                                    <div>
                                                                    </div>
                                                                    <i class="fas fa-camera text-danger" style="font-size: 45px; cursor: pointer;"></i>
                                                                    <h5>Change event banner</h5>
                                                                    <input type="file" name="file" />
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <p class="h4">
                                                                <span class="text-danger">2</span>. Create Tickets
                                                            </p>
                                                            <div class="mb-2">
                                                                <label for="venue">Vip ticket price</label>
                                                                <input class="form-control form-control-sm" type="text" name="vip_price" value="<?php echo $event['vip_price']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="starts">Regular ticket price</label>
                                                                <input class="form-control form-control-sm" type="text" name="regular_price" value="<?php echo $event['regular_price']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="venue">Vip ticket slots</label>
                                                                <input class="form-control form-control-sm" type="text" name="vip_quantity" value="<?php echo $event['vip_allocation']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="starts">Regular ticket slots</label>
                                                                <input class="form-control form-control-sm" type="text" name="regular_quantity" value="<?php echo $event['regular_allocation']; ?>" required>
                                                            </div>
                                                            <div class="my-4">
                                                                <p>Nice job! You're almost done.</p>
                                                                <button class="btn btn-danger p-3 text-capitalize" type="submit" name="edit_event" style="border-radius: 25px;"> Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal end -->

                                    <!-- delete modal -->
                                    <div class="modal fade " id="del<?php echo $event['event_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog card" role="document">
                                            <div class="modal-content p-5">
                                                <div class="row d-flex justify-content-end">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="border" style="border-radius: 15px;">
                                                    <div class="text-center col-md-8 ml-auto mr-auto mb-5">
                                                        <p class="text-danger font-weight-bold h5 mt-3">
                                                            Are you sure you want to delete <em class="text-primary"><?php echo $event['name'] ?></em> event?
                                                        </p>
                                                    </div>
                                                    <div class="row d-flex justify-content-between  ml-auto mr-auto col-md-5">
                                                        <div>
                                                            <p class="text-black font-weight-bold" data-dismiss="modal" aria-label="Close">
                                                                Cancel
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <a href="../controllers/handle_event.php?del=<?php echo $event['event_id'] ?>" class="text-primary font-weight-bold">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            </div>
            <!-- modal end -->

            </tr>
        <?php
                }
                ?>
        </tbody>

        </table>
    <?php

        } else {

            ?>

        <div class="col-md-4 ml-auto mr-auto">
            <img src="../images/no-events.jpg" alt="NO events" style=" display: block; margin-left: auto; height: 100%; width: 100%; margin-right: auto;">
        </div>
    <?php
        }
        ?>
    </div>


        </main>
        <?php include('../utils/footer.php') ?>
        <?php include('../utils/bottom.php') ?>
    </body>

    </html>
<?php } ?>