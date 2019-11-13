<!DOCTYPE html>
<html lang="en">
<?php include('utils/head.php') ?>
<?php
session_start(); ?>
<style>
    .login-btn {
        border-radius: 50px;
    }
</style>

<body style="background-color: whitesmoke">
    <?php include('utils/navbar.php') ?>
    <main>
        <div class="container">

            <div class="col-md-5 mt-5 ml-auto mr-auto">
                <div class="card mt-3">
                    <div class="card-header p-0"> <img src="../images/logo.png" style="height: 50%; width: 60%" alt="bannerLink" srcset="" class="img-ticket"></div>
                    <form class="text-center px-3" method="POST" action="../controllers/signup.php">
                        <p class="h4 my-4 text-danger">Create Account</p>
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
                        <div class="boder">
                            <div class="md-form md-outline">
                                <input type="email" id="email" name="email" value="<?php echo $_COOKIE["Email"];?>" class="form-control">
                                <label for="email">Email Address</label>
                            </div>
                            <div class="md-form md-outline">
                                <input type="password" id="password" name="password" value="<?php echo $_COOKIE["Password"];?>" class="form-control">
                                <label for="password">Password</label>
                                <small class="form-text text-muted mb-2">
                                    Use 8 or more characters with a mix of digits, letters & symbols
                                </small>
                            </div>
                        </div>
                        <button class="my-1 text-capitalize btn btn-danger btn-block mb-5 py-2" name="signup" type="submit">Sign
                            Up</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php include('utils/footer.php') ?>
    <?php include('utils/bottom.php') ?>
</body>

</html>