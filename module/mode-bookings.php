<?php

function insertBooking($data)
{
    global $koneksi;

    $guestId = mysqli_real_escape_string($koneksi, $data['guest_id']);
    $roomId = mysqli_real_escape_string($koneksi, $data['room_id']);
    $checkIn = mysqli_real_escape_string($koneksi, $data['check_in']);
    $checkOut = mysqli_real_escape_string($koneksi, $data['check_out']);
    $totalPrice = mysqli_real_escape_string($koneksi, $data['total_price']);
    $status = mysqli_real_escape_string($koneksi, $data['status']);
    
    

    $sqlGuest = "INSERT INTO bookings VALUE (null, '$roomId', '$guestId', '$checkIn', '$checkOut', $totalPrice, '$status')";
    mysqli_query($koneksi, $sqlGuest);

    return mysqli_affected_rows($koneksi);
}

function deleteBooking($id)
{
    global $koneksi;

    $sqlDel = "DELETE FROM bookings WHERE id = $id";
    mysqli_query($koneksi, $sqlDel);

    return mysqli_affected_rows($koneksi);
}

function updateBooking($data)
{
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data['id']);
    $roomId = mysqli_real_escape_string($koneksi, $data['room_id']);
    $guestId = mysqli_real_escape_string($koneksi, $data['guest_id']);
    $checkIn = mysqli_real_escape_string($koneksi, $data['check_id']);
    $checkOut = mysqli_real_escape_string($koneksi, $data['check_id']);
    $totalPrice = mysqli_real_escape_string($koneksi, $data['total_price']);
    $status = mysqli_real_escape_string($koneksi, $data['status']);
    

   
    $updateQuery = "UPDATE bookings SET room_id = '$roomId', guest_id = '$guestId', check_in = '$checkIn', check_out = '$checkOut', total_price = '$totalPrice', status = '$status' WHERE id = $id";
    mysqli_query($koneksi, $updateQuery);


    return mysqli_affected_rows($koneksi);
}


?>