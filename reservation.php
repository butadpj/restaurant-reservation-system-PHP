<?php require_once './includes/db_con.php'; ?>


<?php
require 'start.php';
?>

<!-- Reservation page content START -->

<!-- Navbar START -->
<?php
require "navbar/start.php";
?>
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="./">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="./reservation.php">Reservation</a>
</li>

<?php
require "navbar/end.php";
?>
<!-- Navbar END -->

<main class="container mt-5">

    <div class="admin-login mb-5">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary admin-modal-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Admin?
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Admin's Login Panel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="admin-login-form">
                            <div class="mb-3">
                                <label for="exampleInputUsername" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="exampleInputUsername">

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                            </div>

                            <button type="submit" class="btn btn-primary admin-login-submit">Login</button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <h2>Customer Reservation Form</h2>
    <hr>

    <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
    <div class="bootstrap-iso">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <form action="./reservation_process.php" method="POST">
                        <div class="form-group ">
                            <label class="control-label requiredField" for="name">
                                First name
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <input class="form-control" id="first_name" name="first_name" placeholder="Ex. George" value="<?php echo $first_name; ?>" type="text" required />
                        </div>
                        <div class="form-group ">
                            <label class="control-label requiredField" for="name">
                                Last name
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <input class="form-control" id="last_name" name="last_name" placeholder="Ex. Harrison" value="<?php echo $last_name; ?>" required type="text" />
                        </div>
                        <div class="form-group ">
                            <label class="control-label requiredField" for="contact">
                                Address
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <input class="form-control" id="address" name="address" placeholder="9100 Upper Cambridge, Brgy. San Juan, Antipolo Rizal, 1870" value="<?php echo $address; ?>" required type="text" />
                        </div>
                        <div class="form-group ">
                            <label class="control-label requiredField" for="contact">
                                Phone number
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <input class="form-control" id="phone_number" name="phone_number" placeholder="09xxxxxxxxx" value="<?php echo $phone_number; ?>" required type="text" />
                        </div>
                        <div class="form-group ">
                            <label class="control-label requiredField" for="date">
                                Date
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar">
                                    </i>
                                </div>
                                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" required type="text" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button class="btn btn-primary " name="submit" type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
<!-- Reservation page content END -->


<?php
require "end.php";
?>