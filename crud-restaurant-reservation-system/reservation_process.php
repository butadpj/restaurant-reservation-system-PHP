<?php require './includes/db_con.php';


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $date = $_POST['date'];


    $conn->query("INSERT INTO reserved_customers (name, contact, date) VALUES('$name', '$contact', '$date')") or
        die($conn->error);

    $_SESSION['message'] = "A new reservation has been added";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}


if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $name = $_GET['name'];
    $contact = $_GET['contact'];
    $date = $_GET['date'];

    $conn->query("UPDATE reserved_customers SET name='$name', contact='$contact', date='$date' WHERE id=$id") or
        die($conn->error);

    header("location: admin.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $conn->query("DELETE from reserved_customers WHERE id=$id") or
        die($conn->error);

    $_SESSION['message'] = "Reservation has been deleted";
    $_SESSION['msg_type'] = "danger";

    header("location: admin.php");
}
