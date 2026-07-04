<?php
include "config/koneksi.php";

$nama = "Administrator";
$email = "admin@gmail.com";
$password = password_hash("12345", PASSWORD_DEFAULT);
$role = "ketua";

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