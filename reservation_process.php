<?php require './includes/db_con.php';


if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $date = $_POST['date'];

    $conn->query("INSERT INTO customers (first_name, last_name, address, phone_number) VALUES('$first_name', '$last_name', '$address', '$phone_number')") or
        die($conn->error);

    $conn->query("INSERT INTO `reservations` (customer_id, date) VALUES ('$conn->insert_id', '$date');");

    $_SESSION['message'] = "A new reservation has been added";
    $_SESSION['msg_type'] = "success";



    header("location: index.php");
}


if (isset($_GET['edit'])) {
    $customer_id = $_GET['edit'];
    $reservation_id = $_GET['reservation_id'];
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $address = $_GET['address'];
    $phone_number = $_GET['phone_number'];
    $date = $_GET['date'];

    $conn->query("UPDATE customers SET first_name='$first_name', last_name='$last_name', address='$address', phone_number='$phone_number' WHERE customer_id=$customer_id") or
        die($conn->error);

    $conn->query("UPDATE reservations SET date='$date' WHERE reservation_id=$reservation_id") or
        die($conn->error);


    header("location: admin.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $conn->query("DELETE from customers WHERE customer_id=$id") or
        die($conn->error);

    $_SESSION['message'] = "Reservation has been deleted";
    $_SESSION['msg_type'] = "danger";

    header("location: admin.php");
}
