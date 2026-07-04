<?php
session_start();
if (!isset($_SESSION["role"])) {
  header("Location: ../../auth/login.php");
}
require_once "../../config/koneksi.php";

$id = $_GET["id"];
$query_kategori = mysqli_query($koneksi, "select * from kategori where id='$id'");
$data = mysqli_fetch_assoc($query_kategori);

if (isset($_POST["update"])) {
  $nama = $_POST["nama_kategori"];
  $update = mysqli_query($koneksi, "update kategori set nama_kategori='$nama' where id='$id'");
  if ($update) {
    echo "
      <script>
        alert('Kategori berhasil diperbarui');
        window.location = 'index.php';
      </script>
    ";
  }
}

include "../header.php";
include "../sidebar.php";
?>

<div class="container-fluid">
  <div class="card shadow">
    <div class="card-body">
      <h3>Edit Kategori</h3>
      <hr>
      <form method="POST">
        <div class="mb-3">
          <label>Nama Kategori</label>
          <input type="text" name="nama_kategori" class="form-control" value="<?= $data["nama_kategori"]; ?>" required />
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>

<?php include "../footer.php"; ?>