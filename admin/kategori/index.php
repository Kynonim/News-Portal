<?php
session_start();
if (!isset($_SESSION["role"])) {
  header("Location: ../../auth/login.php");
}
require_once "../../config/koneksi.php";
$data = mysqli_query($koneksi, "select * from kategori");

include "../header.php";
include "../sidebar.php";
?>

<div class="container-fluid">
  <h2>Data Kategori</h2>
  <a href="tambah.php" class="btn btn-primary mb-3">Tambah Kategori</a>
  <div class="card shadow">
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th width="200">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while ($row = mysqli_fetch_assoc($data)) :
          ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row["nama_kategori"]; ?></td>
            <td>
              <a href="edit.php?id=<?= $row["id"]; ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="hapus.php?id=<?= $row["id"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data ?')">Hapus</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include "../footer.php"; ?>