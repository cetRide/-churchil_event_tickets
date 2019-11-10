<!DOCTYPE html>
<html lang="en">
<?php include('utils/head.php') ?>
<style>
    .login-btn {
        border-radius: 50px;
    }
</style>

<body style="background-color: whitesmoke">
    <?php include('utils/navbar.php') ?>
    <main>
        <div class="container">
            <div class="row d-flex justify-content-end mt-5">
                <div class="col mt-5 px-5">
                    <img src="images/logo.png" style="width: 50%; height: 40%;">
                    <h1>Grab your ticket now !!</h1>
                    <p>Join others in this world of comedy and have fun.Check out on the upcoming events and reserve your
                        ticket.You can also reserve for your friends too...</p>
                    <a href="" data-toggle="modal" data-target="#login">
                        <button class="hoverable text-primary text-capitalize btn login-btn border border-primary">Log
                            in</button>
                    </a>
                </div>
                <div class="col-md-5 mt-5 mb-3">
                    <div class="card mt-3">
                        <form class="text-center px-3" method="POST" action="controllers/signup.php">
                            <p class="h4 my-4 text-primary">Create Account</p>
                            <div class="md-form md-outline">
                                <input type="text" id="name" name="f_name" class="form-control">
                                <label for="name">Full Name</label>
                            </div>
                            <div class="md-form md-outline">
                                <input type="email" id="email" name="email" class="form-control">
                                <label for="email">Email Address</label>
                            </div>
                            <div class="md-form md-outline">
                                <input type="password" id="password" name="password" class="form-control">
                                <label for="password">Password</label>
                                <small class="form-text text-muted mb-2">
                                    Use 8 or more characters with a mix of digits, letters & symbols
                                </small>
                            </div>
                            <button class="my-1 text-capitalize btn btn-primary btn-block mb-5 py-2" name="signup" type="submit">Sign
                                Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- log in modal -->
        <div class="modal fade " id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog card" role="document">
                <div class="modal-content p-5">
                    <div class="row d-flex justify-content-between">
                        <div>
                            <h5 class="text-primary text-center font-weight-bolder">Log in.</h5>
                        </div>
                        <div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="border border-primary mt-5" style="border-radius: 15px">
                        <form method="POST" action="controllers/login.php">
                            <div class="modal-body mx-3">
                                <div class="md-form mb-5">
                                    <input type="text" id="email" name="email" class="form-control validate">
                                    <label for="email">Email</label>
                                </div>
                                <div class="md-form mb-4">
                                    <input type="password" id="password" name="password" class="form-control validate">
                                    <label for="password">Password</label>
                                </div>
                                <div>
                                    <button type="submit" id="submit" name="login" class="btn btn-block py-2 btn-primary text-capitalize">Log
                                        in</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php include('utils/bottom.html') ?>
</body>

</html>