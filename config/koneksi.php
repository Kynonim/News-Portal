<?php
$host = "localhost";
$user = "root";
$pass = "aku_ngantuk_19";
$db = "newsportal_db";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
  die("Koneksi database gagal: ". mysqli_connect_error());
}
?>