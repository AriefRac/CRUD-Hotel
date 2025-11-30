<?php

session_start();

if(!isset($_SESSION['ssLoginHotel'])){
    header('Location: ../auth/login.php');
    exit();
}

require_once '../config/config.php';
require_once '../config/function.php';
require_once '../module/mode-user.php';

$title = "Tambah User - Hotel";
include_once '../template/header.php';
include_once '../template/sidebar.php';
include_once '../template/navbar.php';


if (isset($_POST['simpat'])) {
    
}
?>

<main>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <div x-data="{ pageName: `Tambah User`}">
            <include src="./partials/breadcrumb.html" />
        </div>





    </div>
</main>

<?php include_once '../template/footer.php'; ?>