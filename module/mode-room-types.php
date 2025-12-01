<?php

if (userLogin()['privilege'] !== 'Admin') {
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insertRoomType($data)
{
    global $koneksi;

    $name   = mysqli_real_escape_string($koneksi, $data['name']);
    $desc   = mysqli_real_escape_string($koneksi, $data['description']);
    $price  = mysqli_real_escape_string($koneksi, $data['price']);
    
    $sqlRoomType = "INSERT INTO room_types VALUE (null, '$name', '$desc', '$price')";
    mysqli_query($koneksi, $sqlRoomType);

    return mysqli_affected_rows($koneksi);
}

function deleteRoomType($id)
{
    global $koneksi;

    $sqlDel = "DELETE FROM room_types WHERE id = $id";
    mysqli_query($koneksi, $sqlDel);

    return mysqli_affected_rows($koneksi);
}

function updateRoomsType($data)
{
    global $koneksi;

    $id     = mysqli_real_escape_string($koneksi, $data['id']);
    $name   = mysqli_real_escape_string($koneksi, $data['name']);
    $desc   = mysqli_real_escape_string($koneksi, $data['description']);
    $price  = mysqli_real_escape_string($koneksi, $data['price']);

    // cek name sekarang
    $queryName = mysqli_query($koneksi, "SELECT * FROM room_types WHERE id = $id");
    $dataName = mysqli_fetch_assoc($queryName);
    $curName = $dataName['name'];

    // cek name  baru
    $newName = mysqli_query($koneksi, "SELECT name FROM room_types WHERE name = '$name'");

    if ($name !== $curName) {
        if (mysqli_num_rows($newName)) {
            echo '<script>
                alert("name sudah terpakai, update data gagal!");
            </script>';
            return false;
        }
    }

    $updateQuery = "UPDATE room_types SET name = '$name', description = '$desc', price = '$price' WHERE id = $id";
    mysqli_query($koneksi, $updateQuery);


    return mysqli_affected_rows($koneksi);
}



?>