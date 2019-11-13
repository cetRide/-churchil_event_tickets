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
                    <form action="../controllers/handle_event.php" method="POST" enctype="multipart/form-data">

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
                                unset($_SESSION['errors']);
                            }
                            ?>
                        <div class="mb-2">
                            <label for="name">Event Name</label>
                            <input class="form-control form-control-lg" type="text" name="name" value="<?php if (isset($_COOKIE['Name'])) echo $_COOKIE['Name']; ?>" required>
                        </div>
                        <div class="mb-2">
                            <label for="venue">Location/Venue</label>
                            <input class="form-control form-control-lg" type="text" name="location" value="<?php if (isset($_COOKIE['Location'])) echo $_COOKIE['Location']; ?>" required>
                        </div>
                        <div class="d-inline-block mb-2">
                            <label for="starts">Event date & Time</label>
                            <input class="form-control form-control-lg" type="text" id="picker" onkeydown="return false" name="date" value="<?php if (isset($_COOKIE['Date'])) echo $_COOKIE['Date']; ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleFormControlTextarea3">Event Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" name="event_description" vvalue="<?php if (isset($_COOKIE['Description'])) echo $_COOKIE['Description']; ?>" required></textarea>
                        </div>
                        <label for="banner">Event Banner</label>

                        <div class="col-md-4 border bg-white text-center p-1" style="border-radius:15px;">
                            <p><input type="file" accept="image/*" name="file" id="file" onchange="loadFile(event)" style="display: none;"></p>
                            <p><label for="file" style="cursor: pointer;">Upload event banner</label></p>
                            <p><img id="output" width="200" /></p>
                        </div>

                        <hr>
                        <p class="h4">
                            <span class="text-danger">2</span>. Create Tickets
                        </p>
                        <div class="border p-3" style="border-radius: 15px;">
                            <TABLE>
                                <thead class="text-danger">
                                    <tr>
                                        <th scope="col" class="text-center my-2">Ticket Type</th>
                                        <th scope="col" class="text-center my-2">Quantity available</th>
                                        <th scope="col" class="text-center my-2">Price</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>VIP</td>
                                    <td class="p-4"> <input class="form-control form-control-sm" type="text" name="vip_quantity" value="<?php if (isset($_COOKIE['Vip_quantity'])) echo $_COOKIE['Vip_quantity']; ?>" required>
                                    </td>
                                    <td><input class="form-control form-control-sm" type="text" name="vip_price" value="<?php if (isset($_COOKIE['Vip_price'])) echo $_COOKIE['Vip_price']; ?>" required>
                                    </td>

                                </tr>
                                <tr></tr>
                                <tr>
                                    <td>Regular</td>
                                    <td class="p-3"> <input class="form-control form-control-sm" type="text" name="regular_quantity" value="<?php if (isset($_COOKIE['Regular_quantity'])) echo $_COOKIE['Regular_quantity']; ?>" required>
                                    </td>
                                    <td> <input class="form-control form-control-sm" type="text" name="regular_price" value="<?php if (isset($_COOKIE['Regular_price'])) echo $_COOKIE['Regular_price']; ?>" required>
                                    </td>
                                </tr>
                            </TABLE>
                        </div>
                        <div class="my-4">
                            <p>Nice job! You're almost done.</p>
                            <button class="btn btn-danger p-3 text-capitalize" type="submit" name="add_event" style="border-radius: 25px;"> Make Your Event Live.</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <?php include('../utils/footer.php') ?>
        <?php include('../utils/bottom.php') ?>
        <script>
            var loadFile = function(event) {
                var image = document.getElementById('output');
                image.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>
    </body>

    </html>

<?php } ?>