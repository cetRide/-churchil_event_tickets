<?php
session_start();
$id = $_COOKIE["Event"];
$event_name = $_COOKIE["Event_name"];
$regular_price = $_COOKIE["Regular_price"];
$vip_price =  $_COOKIE["Vip_price"];

?>
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
    <?php include('../utils/navbar.php') ?>
    <main class="container">
        <div class="mt-2">
            <img src="../images/logo.png" style="width: 40%; height: 30%;">
            <div class="text-center">
                <p class="h4"><?php echo $event_name = ucfirst($event_name); ?></p>
            </div>
            <hr>
            <div class="col-md-5 ml-auto mr-auto row d-flex justify-content-between">
                <div>
                    <p>Regular Tickets</p>
                    <p>@<?php echo $regular_price; ?>/=</p>
                </div>
                <div>
                    <p>VIP Tickets</>
                        <p>@<?php echo $vip_price; ?>/=</p>
                </div>
            </div>
            <div class="col-md-5 ml-auto mr-auto">
                <p class="font-weight-bold text-warning">You are only allowed to book a maximum of 5 tickets</p>
                <form action="../controllers/reservation.php" method="POST">
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
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-row mb-4">
                        <div class="form-group col">
                            <label for="viptickets">Vip Tickets</label>
                            <select id="viptickets" class="custom-select" name="vip_quantity" required>
                                <option value="0">-- None --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="tickects">Regular Tickets</label>
                            <select id="tickects" class="custom-select" name="regular_quantity" id="" required>
                                <option value="0">-- None --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <input type="email" id="defaultRegisterFormEmail" class="form-control mb-2" name="email" placeholder="Your email address" required>

                        <button class="btn btn-primary text-center" type="submit" name="reserve_ticket" style="border-radius: 15px;"> Reserve ticket</button>

                </form>
            </div>
        </div>
    </main>
    <?php include('../utils/footer.php') ?>
    <?php include('../utils/bottom.php') ?>
</body>

</html>