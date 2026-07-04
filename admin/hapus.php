<?php
require_once "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi, "delete from users where id='$id'");
header("Location: user.php?pesan=hapus");
?>