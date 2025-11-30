<?php

if (userLogin()['privilege'] !== 'Admin') {
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insertUser($data)
{
    global $koneksi;

    $username = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname = mysqli_real_escape_string($koneksi, $data['fullname']);
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    $password2 = mysqli_real_escape_string($koneksi, $data['password2']);
    $address = mysqli_real_escape_string($koneksi, $data['address']);
    $telephone = mysqli_real_escape_string($koneksi, $data['telephone']);
    $privilege = mysqli_real_escape_string($koneksi, $data['privilege']);

    if ($password !== $password2) {
        echo '<script>
                alert("konfirmasi password tidak sesuai, user baru gagal diregistrasi !");
            </script>';
        return false;
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);

    $cekUsername = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername) > 0) {
        echo '<script>
                alert("username sudah terpakai, user baru gagal diregistrasi !");
            </script>';
        return false;
    }

    if (strlen($telephone) > 13) {
        echo '<script>
                alert("nomor telephone tidak boleh lebih dari 13 angka!");
            </script>';
        return false;
    }

    $cekTelephone = mysqli_query($koneksi, "SELECT telephone FROM users WHERE telephone = '$telephone'");
    if (mysqli_num_rows($cekTelephone) > 0) {
        echo '<script>
                alert("nomor telephone sudah digunakan!");
            </script>';
        return false;
    }

    $sqlUser = "INSERT INTO users VALUE (null, '$username', '$fullname', '$pass', '$address', '$telephone', '$privilege')";
    mysqli_query($koneksi, $sqlUser);

    return mysqli_affected_rows($koneksi);
}

function deleteUser($id)
{
    global $koneksi;

    $sqlDel = "DELETE FROM users WHERE user_id = $id";
    mysqli_query($koneksi, $sqlDel);

    return mysqli_affected_rows($koneksi);
}

function updateUser($data)
{
    global $koneksi;

    $user_id = mysqli_real_escape_string($koneksi, $data['id']);
    $username = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname = mysqli_real_escape_string($koneksi, $data['fullname']);
    $address = mysqli_real_escape_string($koneksi, $data['address']);
    $telephone = mysqli_real_escape_string($koneksi, $data['telephone']);
    $privilege = mysqli_real_escape_string($koneksi, $data['privilege']);
    

    // cek username sekarang
    $queryUsername = mysqli_query($koneksi, "SELECT * FROM users WHERE user_id = $user_id");
    $dataUsername = mysqli_fetch_assoc($queryUsername);
    $curUsername = $dataUsername['username'];

    // cek username  baru
    $newUsername = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");

    if ($username !== $curUsername) {
        if (mysqli_num_rows($newUsername)) {
            echo '<script>
                alert("username sudah terpakai, update data user gagal !");
            </script>';
            return false;
        }
    }

    $updateQuery = "UPDATE users SET username = '$username', fullname = '$fullname', address = '$address', telephone = '$telephone', privilege = '$privilege' WHERE user_id = $user_id";
    mysqli_query($koneksi, $updateQuery);


    return mysqli_affected_rows($koneksi);
}

function selectUser1($level)
{
    $result = null;
    if ($level === 'Admin') {
        $result = "selected";
    }
    return $result;
}

function selectUser2($level)
{
    $result = null;
    if ($level === 'Staff') {
        $result = "selected";
    }
    return $result;
}

?>