<?php
include "config/koneksi.php";
include 'includes/header.php';
include 'includes/navbar.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "
  select
    artikel.*,
    kategori.nama_kategori,
    users.nama
  from artikel
  left join kategori on artikel.kategori_id = kategori.id
  left join users on artikel.user_id = users.id
  where artikel.id='$id'
");

$data = mysqli_fetch_assoc($query);
?>

<div class="container mt-5">
  <h1><?= $data['judul']; ?></h1>
  <hr>
  <span class="badge bg-primary"><?= $data['nama_kategori']; ?></span>
  <p class="mt-2 text-muted">
    Oleh :
    <?= $data['nama']; ?>
    <?= date('d M Y', strtotime($data['tanggal'])); ?>
  </p>
  <img src="uploads/<?= $data['thumbnail']; ?>" ☐☐ class="img-fluid rounded">
  <div class="mt-4"><?= nl2br($data['isi_berita']); ?></div>
  <!-- tombol back -->
  <div class="mt-4">
    <a href="index.php" class="btn btn-secondary">Kembali ke Beranda</a>
  </div>
</div>
<?php include "includes/footer.php"; ?>