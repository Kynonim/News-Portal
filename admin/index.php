<?php
session_start();
if (!isset($_SESSION["role"])) {
  header("Location: ../auth/login.php");
}
require_once "../config/koneksi.php";

$artikel = mysqli_query($koneksi, "select count(*) as total_artikel from artikel");
$total_artikel = mysqli_fetch_assoc($artikel);
$kategori = mysqli_query($koneksi, "select count(*) as total_kategori from kategori");
$total_kategori = mysqli_fetch_assoc($kategori);

include "header.php";
include "sidebar.php";
?>
<h2>Dashboard Admin Portal Berita</h2>
<hr>
<div class="row">
  <!-- total artikel -->
  <div class="col-md-4">
    <div class="card shadow border-0">
      <div class="card-body">
        <h5>Total Artikel</h5>
        <h2><?= $total_artikel["total_artikel"]; ?></h2>
      </div>
    </div>
  </div>
  <!-- total kategori -->
    <div class="col-md-4">
    <div class="card shadow border-0">
      <div class="card-body">
        <h5>Total Kategori</h5>
        <h2><?= $total_kategori["total_kategori"]; ?></h2>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>