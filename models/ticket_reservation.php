<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\churchil_event_tickets\models\database_connection.php');

class TicketReservation extends dbconnection
{
    public function __construct()
    { }


    public function totalInputTickets($vip_quantity, $regular_quantity)
    {
        return $vip_quantity + $regular_quantity;
    }

    public function totalTicketsInDbOfUser($email)
    {
        $query = "SELECT `vip_ticket_quantity`, `regular_ticket_quantity` FROM churchill_event_tickets.reserved_tickets WHERE email= ? ";
        $pre = $this->connectDb()->prepare($query);
        $pre->execute([$email]);
        $total = 0;
        while ($row = $pre->fetch(PDO::FETCH_ASSOC)) {
            $regular = $row['regular_ticket_quantity'];
            $vip = $row['vip_ticket_quantity'];
            $total = $regular + $vip;
        }

        return $total;
    }
    public function reserveTicket($id, $email, $vip_quantity, $regular_quantity)
    {
        if ($this->totalInputTickets($vip_quantity, $regular_quantity) > 5) {
            // echo "error 1";
            header('Location: ../views/reserve_ticket.php');
            return;
        }
        if ($this->totalTicketsInDbOfUser($email) >= 5) {
            // echo "error 2";
            header('Location: ../views/reserve_ticket.php');
            return;
        }

        if (($this->totalInputTickets($vip_quantity, $regular_quantity) + $this->totalTicketsInDbOfUser($email)) > 5) {
            // echo "error 3";
            header('Location: ../views/reserve_ticket.php');
            return;
        }
        $reservation_id = uniqid();
        $query =  "INSERT INTO  churchill_event_tickets.reserved_tickets(id,email,event_id,vip_ticket_quantity,regular_ticket_quantity) 
         VALUES ('$reservation_id','$email','$id','$vip_quantity','$regular_quantity') ";
        try {
            $this->connectDb()->exec($query);
            // send email

            //alert
            echo '<script> alert(\'Ticket Reserved Successfully.\')</script>';
            echo '<script> window.open(\'../views/viewEvent.php\',\'_self\')</script>';
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
}
