<?php
require_once "../../config/koneksi.php";
$id = $_GET["id"];
mysqli_query($koneksi, "delete from kategori where id='$id'");
header("Location: index.php");
?>