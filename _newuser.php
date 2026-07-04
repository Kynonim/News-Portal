<?php
include "config/koneksi.php";

$nama = "Riky Ripaldo";
$email = "riky@mail.com";
$password = password_hash("root", PASSWORD_DEFAULT);
$role = "admin";

$query = mysqli_query(
  $koneksi,
  "insert into users (nama, email, password, role) values ('$nama', '$email', '$password', '$role')"
);

if ($query) {
  echo "User berhasil dibuat";
} else {
  echo "User gagal dibuat";
}

?>