<?php require_once './includes/db_con.php' ?>

<?php
require 'start.php';
?>


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
        $result = $conn->query("SELECT * FROM reserved_customers") or die(mysqli_error($conn));
        // pre_r($result);
        // pre_r($result->fetch_assoc());
        // pre_r($result->fetch_assoc());
        // pre_r($result->fetch_assoc());

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
                    <th scope="col">Name</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td class="align-middle" name="name"><?php echo $row['name'] ?></td>
                        <td class="align-middle" name="contact"><?php echo $row['contact'] ?></td>
                        <td class="align-middle date-display" name="date"><?php echo $row['date'] ?></td>
                        <td class="align-middle">
                            <div class="action-buttons">
                                <button class="btn btn-primary me-3 edit-btn" data-id="<?= $row['id'] ?>" data-name="<?= $row['name'] ?>" data-contact="<?= $row['contact'] ?>" data-date="<?= $row['date'] ?>">Edit</button>

                                <a href="./reservation_process.php?delete=<?php echo $row['id'] ?>">
                                    <button class="btn btn-danger">Delete</button>
                                </a>
                            </div>
                        </td>

                    </tr>
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