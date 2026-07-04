<?php
require_once "../../config/koneksi.php";
$id = $_GET["id"];
mysqli_query($koneksi, "delete from artikel where id='$id'");
header("Location: index.php");
?>