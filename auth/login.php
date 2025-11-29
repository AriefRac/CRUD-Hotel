<?php

session_start();

if(isset($_SESSION['ssLoginHotel'])) {
    header('Location: ../dashboard.php');
    exit();
}

require '../config/config.php';

if (isset($_POST['login'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $queryLogin =  mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'");

    if (mysqli_num_rows($queryLogin)){
        // $row = mysqli_fetch_assoc($queryLogin);
        // if (password_verify($password, $row['password'])){
            $_SESSION['ssLoginHotel'] = true;
            $_SESSION['ssUserHotel'] = $username;

            header('Location: ../dashboard.php');
            exit();
        // } else {
        //     echo "<script>alert('Password salah..);</script>";
        // }
    } else {
        echo "<script>alert('Password salah..);</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Hotel </title>

    <!-- Main Style -->
    <link rel="stylesheet" href="<?= $main_url ?>asset/tailadmin-template-main/src/style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="login" class="">Sign In</button>
    </form>

    <p class="my-3 text-center">
        <strong>Copyright &copy; 2024 <span class="text-info">Kelompok 3</span></strong>
    </p>
</body>
</html>