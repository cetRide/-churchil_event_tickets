<?php
require_once('../models/ticket_reservation.php');

if (isset($_POST['reserve_ticket'])) {
    $event_id = $_POST['id'];
    $regular_tickets = $_POST['regular_quantity'];
    $vip_tickets = $_POST['vip_quantity'];
    $email = $_POST['email'];
    $ticketRes = new TicketReservation();
    $ticketRes->reserveTicket($event_id, $email, $vip_tickets, $regular_tickets);
}

if (isset($_POST['reserve'])) {
    $event_id = $_POST['event_id'];
    $regular_price = $_POST['regular_price'];
    $vip_price = $_POST['vip_price'];
    $event_name = $_POST['event_name'];

    setcookie("Event", $event_id, time() + (86400 * 30), "/");
    setcookie("Regular_price", $regular_price, time() + (86400 * 30), "/");
    setcookie("Vip_price", $vip_price, time() + (86400 * 30), "/");
    setcookie("Event_name", $event_name, time() + (86400 * 30), "/");
    echo '<script> window.open(\'../views/reserve_ticket.php\',\'_self\')</script>';
}
