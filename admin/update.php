<?php
require_once '../config/koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$role = $_POST['role'];

mysqli_query($koneksi, "
  update users
  set
    nama='$nama',
    email='$email',
    role='$role'
  where id='$id'
");
header('Location: user.php?pesan=edit');
?>