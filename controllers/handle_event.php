
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\churchil_event_tickets\models\manage_events.php');
class handleEvent extends manageEvents
{
    private $name;
    private $location;
    private $date;
    private $description;
    private $vip_quantity;
    private $regular_quantity;
    private $vip_price;
    private $regular_price;

    public function __construct()
    { }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setLocation($location)
    {
        $this->location = $location;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setVip_quantity($vip_quantity)
    {
        $this->vip_quantity = $vip_quantity;
    }
    public function setRegular_quantity($regular_quantity)
    {
        $this->regular_quantity = $regular_quantity;
    }
    public function setVip_price($vip_price)
    {
        $this->vip_price = $vip_price;
    }
    public function setRegular_price($regular_price)
    {
        $this->regular_price = $regular_price;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getLocation()
    {
        return $this->location;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getVip_quantity()
    {
        return $this->vip_quantity;
    }
    public function getRegular_quantity()
    {
        return $this->regular_quantity;
    }
    public function getVip_price()
    {
        return $this->vip_price;
    }
    public function getRegular_price()
    {
        return $this->regular_price;
    }
}

//create event
if (isset($_POST['add_event'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $description = $_POST['event_description'];
    $vip_quantity = $_POST['vip_quantity'];
    $regular_quantity = $_POST['regular_quantity'];
    $vip_price = $_POST['vip_price'];
    $regular_price = $_POST['regular_price'];

    $newEvent = new handleEvent();
    $newEvent->setName($name);
    $newEvent->setLocation($location);
    $newEvent->setDate($date);
    $newEvent->setDescription($description);
    $newEvent->setVip_price($vip_price);
    $newEvent->setVip_quantity($vip_quantity);
    $newEvent->setRegular_price($regular_price);
    $newEvent->setRegular_quantity($regular_quantity);

    $newEvent->submitEvent(

        $newEvent->getName(),
        $newEvent->getLocation(),
        $newEvent->getDate(),
        $newEvent->getDescription(),
        $newEvent->getVip_price(),
        $newEvent->getVip_quantity(),
        $newEvent->getRegular_price(),
        $newEvent->getRegular_quantity()
    );
}



// update event
if (isset($_POST['edit_event'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $description = $_POST['event_description'];
    $vip_quantity = $_POST['vip_quantity'];
    $regular_quantity = $_POST['regular_quantity'];
    $vip_price = $_POST['vip_price'];
    $regular_price = $_POST['regular_price'];
    $id = $_POST['id'];

    $newEvent = new handleEvent();
    $newEvent->setName($name);
    $newEvent->setLocation($location);
    $newEvent->setDate($date);
    $newEvent->setDescription($description);
    $newEvent->setVip_price($vip_price);
    $newEvent->setVip_quantity($vip_quantity);
    $newEvent->setRegular_price($regular_price);
    $newEvent->setRegular_quantity($regular_quantity);

    $newEvent->updateEvents(
        $id,
        $newEvent->getName(),
        $newEvent->getLocation(),
        $newEvent->getDate(),
        $newEvent->getDescription(),
        $newEvent->getVip_price(),
        $newEvent->getVip_quantity(),
        $newEvent->getRegular_price(),
        $newEvent->getRegular_quantity()
    );
}

//delete events
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $viewEvent  = new manageEvents();
    $viewEvent->deleteEvent($id);
}
?>