<?php

session_start();

if(!isset($_SESSION['ssLoginHotel'])){
    header('Location: ../auth/login.php');
    exit();
}

require_once '../module/mode-user.php';
require_once '../config/config.php';
require_once '../config/function.php';

$title = "Data User | Hotel";
include_once '../template/header.php';
include_once '../template/sidebar.php';
include_once '../template/navbar.php';

?>


<?php

require_once '../template/footer.php';

?>