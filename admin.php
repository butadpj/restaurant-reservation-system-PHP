<?php require_once './includes/db_con.php' ?>

<?php
require 'start.php';
?>

<script>
    function getWithExpiry(key) {
        const itemStr = localStorage.getItem(key);
        // if the item doesn't exist, return null
        if (!itemStr) {
            return null;
        }
        const item = JSON.parse(itemStr);
        const now = new Date();
        // compare the expiry time of the item with the current time
        if (now.getTime() > item.expiry) {
            // If the item is expired, delete the item from storage
            // and return null
            localStorage.removeItem(key);
            return null;
        }
        return item.value;
    }

    let isAuth = getWithExpiry("isAuthenticated")

    if (!isAuth) {
        alert("You don't have permission to enter this page")
        window.location.replace("./")
    }
</script>


<!-- Reservation page content START -->

<!-- Navbar START -->
<?php
require 'navbar/start.php';
?>

<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Admin Panel</a>
</li>

<?php
require "navbar/end.php";
?>
<!-- Navbar END -->


<main class="container mt-5">
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?> 
        alert-dismissible fade show" role="alert">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h2>Customer reservations</h2>
    <hr>
    <br>
    <div class="all-reservations">
        <?php
        $reservations_result = $conn->query("SELECT * FROM reservations") or die(mysqli_error($conn));
        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
        ?>
        <table class="table table-light table-striped">
            <thead>
                <tr>
                    <th scope="col">Customer name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($reservation_row = $reservations_result->fetch_assoc()) :

                    $customer_info = $conn->query("SELECT * FROM `customers` WHERE `customer_id` = '$reservation_row[customer_id]'");

                    while ($customer_row = $customer_info->fetch_assoc()) : ?>
                        <tr>
                            <td class="align-middle">
                                <div name="first_name">
                                    <?php echo $customer_row['first_name'] ?>
                                </div>
                                <div name="last_name">
                                    <?php echo $customer_row['last_name'] ?>
                                </div>
                            </td>
                            <td class="align-middle" name="address"><?php echo $customer_row['address'] ?></td>
                            <td class="align-middle" name="phone_number"><?php echo $customer_row['phone_number'] ?></td>
                            <td class="align-middle date-display" name="date"><?php echo $reservation_row['date'] ?></td>
                            <td class="align-middle">
                                <div class="action-buttons">
                                    <button class="btn btn-primary me-3 edit-btn" data-customer_id="<?= $customer_row['customer_id'] ?>" data-reservation_id="<?= $reservation_row['reservation_id'] ?>" data-first_name="<?= $customer_row['first_name'] ?>" data-last_name="<?= $customer_row['last_name'] ?>" data-address="<?= $customer_row['address'] ?>" data-phone_number="<?= $customer_row['phone_number'] ?>" data-date="<?= $reservation_row['date'] ?>">Edit</button>

                                    <a href="./reservation_process.php?delete=<?php echo $reservation_row['customer_id'] ?>">
                                        <button class="btn btn-danger">Delete</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endwhile; ?>



            </tbody>
        </table>

        <?php

        ?>
    </div>
</main>
<!-- Reservation page content END -->


<?php
require "end.php";
?>