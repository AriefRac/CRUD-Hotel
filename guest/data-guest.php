<?php

session_start();

if(!isset($_SESSION['ssLoginHotel'])){
    header('Location: auth/login.php');
    exit();
}

require_once 'config/config.php';
require_once 'config/function.php';

$title = 'Dashboard | Hotel';
include_once 'template/header.php';
include_once 'template/sidebar.php';
include_once 'template/navbar.php';

// count data

?>

<?php include 'template/footer.php'; ?>