<?php
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
    <?php include('../views/navbar.php') ?>
    <main class="container">
        <div>
            <img src="../images/logo.png" style="width: 50%; height: 40%;">

            <p>Event name : <?php echo $event_name; ?></p>
            <p>regular price : <?php echo $regular_price; ?></p>
            <p>Vip price : <?php echo $vip_price; ?></p>
            <p>You are only allowed to book a maximum of 5 tickets</p>
            <form action="../controllers/reservation.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-2">

                    <div class="form-group">
                        <label for="viptickets">Vip Tickets</label>
                        <select id="viptickets" class="custom-select" name="vip_quantity">
                            <option value="0">-- None --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="mb-2">

                    <div class="form-group">
                        <label for="tickects">Regular Tickets</label>
                        <select id="tickects" class="custom-select" name="regular_quantity" id="">
                            <option value="0">-- None --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="venue">Email Address</label>
                    <input class="form-control form-control-sm" type="email" name="email" required>
                </div>
                <button class="btn btn-primary p-3" type="submit" name="reserve_ticket" style="border-radius: 25px;"> Reserve ticket</button>

            </form>
        </div>
    </main>
    <?php include('../views/footer.php') ?>
    <?php include('../utils/bottom.php') ?>
</body>

</html>