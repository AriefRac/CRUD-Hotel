<?php

session_start();

if (!isset($_SESSION["ssLoginHotel"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../module/mode-guest.php";


$id = $_GET['id'];


if (deleteGuest($id)) {
    header("location: data-guest.php?msg=deleted");
    exit();
} else {
    header("location: data-guest.php?msg=aborted");
    exit();
}
