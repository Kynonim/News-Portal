<?php
include 'config/koneksi.php';
include 'includes/header.php';
include 'includes/navbar.php';

$id_kategori = $_GET['id'];
$kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "select * from kategori where id='$id_kategori'"));
$keyword = '';

if (isset($_GET['keyword'])) {
  $keyword = $_GET['keyword'];
}

$artikel = mysqli_query($koneksi, "
  select
    artikel.*,
    kategori.nama_kategori,
    users.nama
  from artikel
  left join kategori on artikel.kategori_id = kategori.id
  left join users on artikel.user_id = users.id
  where artikel.kategori_id='$id_kategori'
  and artikel.judul like '%$keyword%'
  order by artikel.id desc
");
?>

<div class="container mt-5">
  <h2>Kategori: <?= $kategori['nama_kategori']; ?></h2>
  <hr>
  <!-- search -->
  <form method="GET">
    <input type="hidden" name="id" value="<?= $id_kategori; ?>">
    <div class="input-group mb-4">
      <input type="text" name="keyword" class="form-control" placeholder="Cari artikel..." value="<?= $keyword; ?>">
      <button class="btn btn-primary">Cari</button>
    </div>
  </form>
  <div class="row">
    <?php while ($row = mysqli_fetch_assoc($artikel)): ?>
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="uploads/<?= $row['thumbnail']; ?>" class="card-img-top" style="height: 220px;object-fit: cover;">
        <div class="card-body">
          <span class="badge bg-primary"><?= $row['nama_kategori']; ?></span>
          <h5 class="mt-2"><?= $row['judul']; ?></h5>
          <small class="text-muted"><?= $row['nama']; ?></small>
          <p class="mt-2">
            <?= substr(strip_tags($row['isi_berita']), 0, 100); ?>...
          </p>
          <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-outline-primary">Baca Selengkapnya</a>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include "includes/footer.php"; ?>