<?php
include 'config/koneksi.php';
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

if (isset($_POST['kirim'])) {
  $nama = htmlspecialchars(trim($_POST['nama']));
  $email = htmlspecialchars(trim($_POST['email']));
  $isiKomentar = htmlspecialchars(trim($_POST['komentar']));
  mysqli_query($koneksi, "
    insert into komentar (
      artikel_id, nama, email, komentar
    ) values (
      '$id', '$nama', '$email', '$isiKomentar'
    )
  ");
  echo "
    <div class='alert alert-success'>
      Komentar berhasil dikirim
    </div>
  ";
}

$komentar = mysqli_query($koneksi, "select * from komentar where artikel_id='$id' order by id desc");
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

  <!-- komentar -->
  <hr>
  <h3 class="mt-5">Tulis Komentar</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Komentar</label>
      <textarea name="komentar" class="form-control" rows="4" required></textarea>
    </div>
    <button type="submit" name="kirim" class="btn btn-primary">Kirim Komentar</button>
  </form>

  <!-- liat komen -->
  <hr>
  <h3>Komentar Pembaca</h3>
  <?php while($k = mysqli_fetch_assoc($komentar)) : ?>
  <div class="card mb-3 shadow-sm">
    <div class="card-body">
      <h6><?= $k['nama']; ?></h6>
      <small class="text-muted">
        <?= date('d F Y H:i', strtotime($k['tanggal'])); ?>
      </small>
      <p class="mt-2"><?= $k['komentar']; ?></p>
    </div>
  </div>
  <?php endwhile; ?>
</div>
<?php include "includes/footer.php"; ?>