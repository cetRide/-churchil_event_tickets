 <?php
    session_start();
    $id = $_COOKIE["Event"];
    $event_name = $_COOKIE["Event_name"];
    $vip_price = $_COOKIE["Vip_price"];
    $regular_price = $_COOKIE["Regular_price"];
    $location =  $_COOKIE["Location"];
    $date = $_COOKIE["Date"]; ?>
 <!DOCTYPE html>
 <html lang="en">
 <?php include('utils/head.php') ?>
 <?php require_once('../models/manage_events.php'); ?>

 <body style="background-color: whitesmoke">
     <?php include('utils/navbar.php') ?>
     <main>
         <div class="container py-4">
             <div class="container">
                 <div class="card shadow">
                     <div class="card-header p-0"> <img src="../images/logo.png" style="height: 20%; width: 30%" alt="bannerLink" srcset="" class="img-ticket"></div>
                     <div class="card-body px-5">
                         <h3 class="card-title mt-4"><?php echo $event_name = ucfirst($event_name); ?></h3>
                         <div class="row">
                             <div class="col-md-6">
                                 <p class="m-0"><i aria-hidden="true" class="fas fa-map-marker-alt mr-4 text-danger"></i><?php echo $location = ucfirst($location); ?> </p>
                                 <p class="m-0"><i aria-hidden="true" class="fa fa-calendar mr-4 text-danger"></i>
                                     <?php echo $date = date("F j, Y, g:i a"); ?></p>
                             </div>
                             <div class="col-md-6">
                                 <table class="table justify-content-between">
                                     <thead>
                                         <tr>
                                             <th colspan="2" class="font-weight-bold">Tickets</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td scope="row">VIP</td>
                                             <td class="text-right">Kes <?php echo $vip_price; ?> </td>
                                         </tr>
                                         <tr>
                                             <td scope="row">Regular</td>
                                             <td class="text-right">Kes <?php echo $regular_price; ?> </td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                         <hr>
                         <h3 class="card-title">Purchase Ticket</h3>
                         <div class="col-md-10">
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
                                     <input type="email" id="defaultRegisterFormEmail" class="form-control mb-2" name="email" placeholder="Your email address" value="<?php if (isset($_COOKIE['Email'])) echo $_COOKIE['Email']; ?>" required>
                                     <button class=" btn btn-danger text-center text-capitalize" type="submit" name="reserve_ticket" style="border-radius: 15px;"> Reserve ticket</button>

                             </form>
                         </div>
                         <hr>

                     </div>
                 </div>
             </div>
         </div>
     </main>
     <?php include('utils/bottom.php') ?>
 </body>