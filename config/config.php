<?php

$server = "localhost";
$user = "root";
$pass =  "";
$db = "hotel";
$koneksi = mysqli_connect($server, $user, $pass, $db);

if(!$koneksi){
    die("Gagal terhubung dengan database: ". mysqli_connect_error());
}

$main_url = 'http://localhost/hotel2/CRUD-Hotel/';


?>