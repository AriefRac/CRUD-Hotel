<?php

session_start();

if (!isset($_SESSION["ssLoginHotel"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../module/mode-user.php";


$id = $_GET['id'];


if (deleteUser($id)) {
    header("location: data-user.php?msg=deleted");
    exit();
} else {
    header("location: data-user.php?msg=aborted");
    exit();
}
