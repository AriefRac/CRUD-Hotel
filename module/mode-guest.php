<?php



function insertGuest($data)
{
    global $koneksi;

    $name = strtolower(mysqli_real_escape_string($koneksi, $data['name']));
    $phone = mysqli_real_escape_string($koneksi, $data['phone']);
    $nik = mysqli_real_escape_string($koneksi, $data['nik']);
    $address = mysqli_real_escape_string($koneksi, $data['address']);

    $cekName = mysqli_query($koneksi, "SELECT name FROM guest WHERE name = '$name'");
    if (mysqli_num_rows($cekName) > 0) {
        echo '<script>
                alert("Name sudah terpakai, Guest baru gagal diregistrasi !");
            </script>';
        return false;
    }

    if (strlen($phone) > 14) {
        echo '<script>
                alert("nomor telephone tidak boleh lebih dari 14 angka!");
            </script>';
        return false;
    }

    $cekPhone = mysqli_query($koneksi, "SELECT phone FROM guest WHERE phone = '$phone'");
    if (mysqli_num_rows($cekPhone) > 0) {
        echo '<script>
                alert("nomor telephone sudah digunakan!");
            </script>';
        return false;
    }

    $sqlGuest = "INSERT INTO guest VALUE (null, '$name', '$phone', '$nik', '$address')";
    mysqli_query($koneksi, $sqlGuest);

    return mysqli_affected_rows($koneksi);
}

function deleteGuest($id)
{
    global $koneksi;

    $sqlDel = "DELETE FROM guest WHERE id = $id";
    mysqli_query($koneksi, $sqlDel);

    return mysqli_affected_rows($koneksi);
}

function updateGuest($data)
{
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data['id']);
    $name = strtolower(mysqli_real_escape_string($koneksi, $data['name']));
    $phone = mysqli_real_escape_string($koneksi, $data['phone']);
    $nik = mysqli_real_escape_string($koneksi, $data['nik']);
    $address = mysqli_real_escape_string($koneksi, $data['address']);
    

    // cek name sekarang
    $queryName = mysqli_query($koneksi, "SELECT * FROM guest WHERE id = $id");
    $dataName = mysqli_fetch_assoc($queryName);
    $curName = $dataName['name'];

    // cek name  baru
    $newName = mysqli_query($koneksi, "SELECT name FROM guest WHERE name = '$name'");

    if ($name !== $curName) {
        if (mysqli_num_rows($newName)) {
            echo '<script>
                alert("name sudah terpakai, update data guest gagal !");
            </script>';
            return false;
        }
    }

    $updateQuery = "UPDATE guest SET name = '$name', phone = '$phone', nik = '$nik', address = '$address' WHERE id = $id";
    mysqli_query($koneksi, $updateQuery);


    return mysqli_affected_rows($koneksi);
}


?>