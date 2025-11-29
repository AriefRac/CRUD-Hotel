<?php

session_start();

if(!isset($_SESSION['ssLoginHotel'])){
    header('Location: ../auth/login.php');
    exit();
}

require '../config/config.php';
require '../config/function.php';
require '../module/mode-user.php';

$title = "Data User | Hotel";
require '../template/header.php';
require '../template/navbar.php';
require '../template/sidebar.php';

?>


<div>
    
</div>


<?php

require '../template/footer.php';

?>