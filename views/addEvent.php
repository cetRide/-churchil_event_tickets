<?php include('../utils/head.php');
session_start();

if (!(isset($_SESSION['email']))) {
    header('Location: ../index.php');
} else {

    ?>
    <!DOCTYPE html>
    <html lang="en">

      <body style="background-color: whitesmoke">
        <main>
            <?php include('../utils/navbar.php') ?>
            <div class="container">
                <h1 class="font-weight-bold text-center mt-3">Create a new Event</h1>
                <hr>
                <div class="col-md-9">
                    <p class="h4">
                        <span class="text-danger">1</span>. Event Details
                    </p>
                    <form action="../controllers/handle_event.php" method="POST">

                        <?php
                            if (isset($_SESSION['errors']) && $_SESSION['errors'] != null) {
                                // display error

                                ?>

                            <div class="alert alert-danger alert-dismissable" role="alert">
                                <button class="close" data-dismiss="alert">
                                    <small><sup>x</sup></small>
                                </button>
                                <?php echo $_SESSION['errors'];
                                        $_SESSION['errors'] = null; ?>
                            </div>

                        <?php
                            }
                            if (isset($_SESSION['messages']) && $_SESSION['messages'] != null) {

                                ?>

                            <div class="alert alert-success alert-dismissable" role="alert">
                                <button class="close" data-dismiss="alert">
                                    <small><sup>x</sup></small>
                                </button>
                                <?php echo $_SESSION['messages'];
                                        $_SESSION['messages'] = null; ?>
                            </div>


                        <?php
                            }
                            ?>
                        <div class="mb-2">
                            <label for="name">Event Name</label>
                            <input class="form-control form-control-lg" type="text" name="name" required>
                        </div>
                        <div class="mb-2">
                            <label for="venue">Location/Venue</label>
                            <input class="form-control form-control-lg" type="text" name="location" required>
                        </div>
                        <div class="d-inline-block mb-2">
                            <label for="starts">Event date & Time</label>
                            <input class="form-control form-control-lg" type="text" name="date" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleFormControlTextarea3">Event Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" name="event_description" required></textarea>
                        </div>
                        <label for="banner">Event Banner</label>

                        <div class="col-md-4 border bg-white text-center p-1" style="border-radius:15px;">
                            <i class="fas fa-camera text-primary" style="font-size: 45px; cursor: pointer;"></i>
                            <h5>Add Event Image</h5>
                            <small>Choose compelling image that brings your event to life!!</small>
                            <input type="file" name="file" />
                                                  </div>

                        <hr>
                        <p class="h4">
                            <span class="text-danger">2</span>. Create Tickets
                        </p>
                        <div class="border p-3" style="border-radius: 15px;">
                            <TABLE>
                                <thead class="text-primary">
                                    <tr>
                                        <th scope="col" class="text-center my-2">Ticket Type</th>
                                        <th scope="col" class="text-center my-2">Quantity available</th>
                                        <th scope="col" class="text-center my-2">Price</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>VIP</td>
                                    <td class="p-4"> <input class="form-control form-control-sm" type="text" name="vip_quantity">
                                    </td>
                                    <td><input class="form-control form-control-sm" type="text" name="vip_price">
                                    </td>

                                </tr>
                                <tr></tr>
                                <tr>
                                    <td>Regular</td>
                                    <td class="p-3"> <input class="form-control form-control-sm" type="text" name="regular_quantity">
                                    </td>
                                    <td> <input class="form-control form-control-sm" type="text" name="regular_price">
                                    </td>
                                </tr>
                            </TABLE>
                        </div>
                        <div class="my-4">
                            <p>Nice job! You're almost done.</p>
                            <button class="btn btn-primary p-3" type="submit" name="add_event" style="border-radius: 25px;"> Make Your Event Live.</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <?php include('../utils/footer.php') ?>
        <?php include('../utils/bottom.php') ?>
    </body>

    </html>

<?php } ?>