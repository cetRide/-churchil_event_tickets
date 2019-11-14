<?php
require_once('database_connection.php');

class manageEvents extends dbconnection
{
    public static $e_event_id;
    public static $e_name;
    public  static $e_location;
    public static $e_date;
    public static $e_description;
    public static $e_vip_quantity;
    public static $e_regular_quantity;
    public static $e_vip_price;
    public static $e_regular_price;

    public function __construct()
    { }

    public function checkEventNamefExists($name)
    {
        $search = "SELECT * FROM CdEgjh5AXU.events WHERE name= ?";
        $pre = $this->connectDb()->prepare($search);
        $pre->execute([$name]);
        $rows = $pre->rowCount();
        if ($rows < 1) {
            return false;
        } else {
            return true;
        }
    }
    public function returnTicketAllocation($id)
    {
        $query = "SELECT `regular_allocation`, `vip_allocation` FROM CdEgjh5AXU.events WHERE event_id= ? ";
        $pre = $this->connectDb()->prepare($query);
        $pre->execute([$id]);
        while ($row = $pre->fetch(PDO::FETCH_ASSOC)) {
            $array_results[] = array($row['regular_allocation'], $row['vip_allocation']);
        }
        return  $array_results;
    }

    public function remainingTickets($id)
    {
        $query = "SELECT `vip_ticket_quantity`, `regular_ticket_quantity` FROM CdEgjh5AXU.reserved_tickets WHERE event_id= ? ";
        $pre = $this->connectDb()->prepare($query);
        $pre->execute([$id]);
        $vip_total = 0;
        $regular_total = 0;
        while ($row = $pre->fetch(PDO::FETCH_ASSOC)) {
            $vip_total = $vip_total + $row['vip_ticket_quantity'];
            $regular_total = $regular_total + $row['regular_ticket_quantity'];
        }
        $allocation_tickets_no = $this->returnTicketAllocation($id);

        $remVip = ($allocation_tickets_no[0] - $vip_total);
        $remRegular =  $allocation_tickets_no[1] - $regular_total;
        $remaining_tickets = array($remVip,  $remRegular);
        return $remaining_tickets;
    }

    public function getEvents()
    {

        $events = array();
        $query = "SELECT * FROM CdEgjh5AXU.events";
        $pre = $this->connectDb()->prepare($query);
        $pre->execute();
        while ($row = $pre->fetch(PDO::FETCH_ASSOC)) {
            $events[] = $row;
        }

        return $events;
    }


    public function deleteEvent($id)
    {
        try {
            $this->connectDb()->beginTransaction();
            $query = "DELETE FROM CdEgjh5AXU.reserved_tickets WHERE `event_id` = ? ";
            $pre = $this->connectDb()->prepare($query);
            $pre->execute([$id]);

            $query = "DELETE FROM CdEgjh5AXU.events WHERE `event_id` = ? ";
            $pre = $this->connectDb()->prepare($query);
            $pre->execute([$id]);
            echo '<script> alert(\'Event deleted successfully\')</script>';
            echo '<script> window.open(\'../views/events.php\',\'_self\')</script>';
            // header('Location: ../views/events.php');
            $this->connectDb()->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->connectDb()->rollBack();
        }
    }

    public function updateEvents(
        $id,
        $name,
        $location,
        $date,
        $description,
        $vip_quantity,
        $regular_quantity,
        $vip_price,
        $regular_price,
        $banner
    ) {
        $query = "UPDATE CdEgjh5AXU.events SET `name`=?, `location`=?, `time`=?, `description`=?, `vip_allocation`=?,`regular_allocation`=?,`vip_price`=?, `regular_price`=?, `banner`=? WHERE `event_id` = ?";
        $pre = $this->connectDb()->prepare($query);
        $pre->execute([$name, $location, $date, $description, $vip_quantity, $regular_quantity, $vip_price, $regular_price, $banner, $id]);

        echo '<script> alert(\'Event successfully eddited\')</script>';
        // echo '<script> window.open(\'../views/events.php\',\'_self\')</script>';
        // header('Location: ../views/events.php');
    }
    public function submitEvent(
        $name,
        $location,
        $date,
        $description,
        $vip_quantity,
        $regular_quantity,
        $vip_price,
        $regular_price,
        $bunner
    ) {

        // session_start();
        $error = null;
        $messages = null;

        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {

            $error = "Invalid Event Name";
            $_SESSION['errors'] = $error;
            header('Location: ../views/addEvent.php');
            return;
        }

        if ((!preg_match("#[0-9]+#", $vip_price)) || (!preg_match("#[0-9]+#", $regular_price))) {
            $error = "Ticket price should be in digits";
            $_SESSION['errors'] = $error;
            header('Location: ../views/addEvent.php');
            return;
        }
        if ((!preg_match("#[0-9]+#", $vip_quantity)) || (!preg_match("#[0-9]+#", $regular_quantity))) {

            $error = "Ticket slots should be in digits";
            $_SESSION['errors'] = $error;
            header('Location: ../views/addEvent.php');
            return;
        }
        if ($this->checkEventNamefExists($name) == true) {
            $error = "Event name already registered.Use another name for the event.";
            $_SESSION['errors'] = $error;
            header('Location: ../views/addEvent.php');
            return;
        }

        $id = uniqid();
        $createEvent = "INSERT INTO  CdEgjh5AXU.events(`event_id`, `name`, `description`, `location`, `banner`, `time`, `vip_allocation`, `regular_allocation`, `vip_price`, `regular_price`
)  VALUES ('$id', '$name','$description','$location','$bunner','$date','$vip_quantity','$regular_quantity','$vip_price','$regular_price'
) ";
        try {
            $this->connectDb()->exec($createEvent);
            // $messages = 'Event created successfully';
            // $_SESSION['messages'] = $messages;
            // header("Location: ../views/events.php");
            echo '<script> alert(\'Event created successfully\')</script>';
            echo '<script> window.open(\'../views/events.php\',\'_self\')</script>';
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
}
