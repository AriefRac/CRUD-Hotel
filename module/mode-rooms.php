<?php

if (userLogin()['privilege'] !== 'Admin') {
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insertRoom($data)
{
    global $koneksi;

    $roomNumber = mysqli_real_escape_string($koneksi, $data['roomNumber']);
    $typeId     = mysqli_real_escape_string($koneksi, $data['typeId']);
    $status     = mysqli_real_escape_string($koneksi, $data['status']);
    
    $sqlRoom = "INSERT INTO rooms VALUE (null, '$roomNumber', '$typeId', '$status')";
    mysqli_query($koneksi, $sqlRoom);

    return mysqli_affected_rows($koneksi);
}

function deleteRoom($id)
{
    global $koneksi;

    $sqlDel = "DELETE FROM rooms WHERE id = $id";
    mysqli_query($koneksi, $sqlDel);

    return mysqli_affected_rows($koneksi);
}

function updateRooms($data)
{
    global $koneksi;

    $id         = mysqli_real_escape_string($koneksi, $data['id']);
    $roomNumber = mysqli_real_escape_string($koneksi, $data['roomNumber']);
    $typeId     = mysqli_real_escape_string($koneksi, $data['typeId']);
    $status     = mysqli_real_escape_string($koneksi, $data['status']);

    $updateQuery = "UPDATE rooms SET room_number = '$roomNumber', type_id = '$typeId', status = '$status' WHERE id = $id";
    mysqli_query($koneksi, $updateQuery);


    return mysqli_affected_rows($koneksi);
}



?>