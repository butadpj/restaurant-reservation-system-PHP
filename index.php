<?php
require 'start.php';
?>

<!-- Home page content START -->

<!-- Navbar START -->
<?php
require "navbar/start.php";
?>
<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="./reservation.php">Reservation</a>
</li>

<?php
require "navbar/end.php";
?>
<!-- Navbar END -->

<div class="home-bg">
    <div class="bg-text">
        <p>Don't miss a chance. Reserve your table now</p>
        <br>
        <a href="./reservation.php">
            <button class="cta btn btn-light btn-lg">
                Reserve a Table
            </button>
        </a>

    </div>

    <img src="static/images/home-bg.jpg" class="img-fluid home-bg" alt="home-background">
</div>

<h2 class="mt-5 tagline text-center">The most popular sweets place in the world</h2>


<!-- index.php content END -->

<?php
require "end.php";
?>