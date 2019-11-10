<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\churchil_event_tickets\models\database_connection.php');

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
        $search = "SELECT * FROM churchill_event_tickets.events WHERE name= ?";
        $pre = $this->connectDb()->prepare($search);
        $pre->execute([$name]);
        $rows = $pre->rowCount();
        if ($rows < 1) {
            return false;
        } else {
            return true;
        }
    }

    public function getEvents()
    {

        $events = array();
        $query = "SELECT * FROM churchill_event_tickets.events";
        $pre = $this->connectDb()->prepare($query);
        $pre->execute();
        while ($row = $pre->fetch(PDO::FETCH_ASSOC)) {
            $events[] = $row;
        }

        return $events;
    }


    public function deleteEvent($id)
    {
        $query = "DELETE FROM churchill_event_tickets.events WHERE `event_id` = ? ";
        $pre = $this->connectDb()->prepare($query);
        $pre->execute([$id]);
        header('Location: ../views/events.php');
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
        $regular_price
    ) {
        $query = "UPDATE churchill_event_tickets.events SET `name`=?, `location`=?, `time`=?, `description`=?, `vip_allocation`=?,`regular_allocation`=?,`vip_price`=?, `regular_price`=? WHERE `event_id` = ?";
        $pre = $this->connectDb()->prepare($query);
        $pre->execute([$name, $location, $date, $description, $vip_quantity, $regular_quantity, $vip_price, $regular_price, $id]);
        header('Location: ../views/events.php');
    }
    public function submitEvent(
        $name,
        $location,
        $date,
        $description,
        $vip_quantity,
        $regular_quantity,
        $vip_price,
        $regular_price
    ) {

        session_start();
        $error = null;
        $messages = null;

        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {

            $error = "Invalid Event Name";
            $_SESSION['errors'] = $error;
            header('Location: ../views/addEvent.php');
            return;
        }
        if (!preg_match("/^[a-zA-Z ]*$/", $location)) {
            $error = "Invalid Location Name";
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
        $createEvent = "INSERT INTO  churchill_event_tickets.events(event_id, name, description, location, time, vip_allocation, regular_allocation, vip_price, regular_price
)  VALUES ('$id', '$name','$description','$location','$date','$vip_quantity','$regular_quantity','$vip_price','$regular_price'
) ";
        try {
            $this->connectDb()->exec($createEvent);
            $messages = 'Event created successfully';
            $_SESSION['messages'] = $messages;
            header("Location: ../views/events.php");
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
}
