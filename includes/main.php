<?php
/**
 * timezone saya ganti ke tokyo
 * karena saya di luar negeri pak dan waktu di laptop
 * mengikuti waktu di device saya,
 * saya jujur tidak tau kenapa waktunya bentrok dengan waktu php servernya
 * kalau tidak saya ganti ke tokyo, waktunya jadi minus dan error
*/
date_default_timezone_set("Asia/Tokyo"); //japan

function waktu_lalu($datetime) {
  $selisih = time() - strtotime($datetime);

  if ($selisih < 0) $selisih = 0; // waktu - set ke 0

  if ($selisih < 60) {
    return $selisih . " detik yang lalu";
  } elseif ($selisih < 3600) {
    return floor($selisih / 60) . " menit yang lalu";
  } elseif ($selisih < 86400) {
    return floor($selisih / 3600) . " jam yang lalu";
  } elseif ($selisih < 604800) {
    return floor($selisih / 86400) . "hari yang lalu";
  } elseif ($selisih < 2592000) {
    return floor($selisih / 604800) . " minggu yang lalu";
  } elseif ($selisih < 31536000) {
    return floor($selisih / 2592000) . " bulan yang lalu";
  } else {
    return floor($selisih / 31536000) . " tahun yang lalu";
  }
}

$hero = mysqli_fetch_assoc(mysqli_query($koneksi, "
  select 
    artikel.*, kategori.nama_kategori
  from artikel
  left join kategori on artikel.kategori_id = kategori.id
  order by artikel.id desc
  limit 1
"));


$terbaru = mysqli_query($koneksi, "
  select
    artikel.*, kategori.nama_kategori, users.nama
  from artikel
  left join kategori on artikel.kategori_id = kategori.id
  left join users on artikel.user_id = users.id
  order by artikel.id desc
  limit 6
");

$kategori = mysqli_query($koneksi, "select * from kategori order by nama_kategori asc");
?>
<!-- hero news -->
<div class="container mt-4">
  <?php if($hero): ?>
  <div class="card shadow border-0">
    <img src="uploads/<?= $hero["thumbnail"]; ?>" class="card-img-top" style="height:450px; object-fit:cover;">
    <div class="card-body">
      <div class="mb-2">
        <span class="badge bg-danger"><?= $hero["nama_kategori"]; ?></span>
        <small class="text-muted ms-2"><?= waktu_lalu($hero["tanggal"]); ?></small>
      </div>
      <h2 class="mt-3"><?= $hero["judul"]; ?></h2>
      <p><?= substr(strip_tags($hero["isi_berita"]),0,200); ?>...</p>
      <a href="detail.php?id=<?= $hero["id"]; ?>" class="btn btn-primary">Baca Selengkapnya</a>
    </div>
  </div>
  <?php endif; ?>
</div>

<!-- berita terbaru -->
<div class="container mt-5">
  <h2 class="mb-4">Berita Terbaru</h2>
  <div class="row">
    <?php while($row = mysqli_fetch_assoc($terbaru)): ?>
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="uploads/<?= $row["thumbnail"]; ?>" class="card-img-top" style="height:220px; object-fit:cover;">
        <div class="card-body">
          <span class="badge bg-primary"><?= $row["nama_kategori"]; ?></span>
          <h5 class="mt-2"><?= $row["judul"]; ?></h5>
          <small class="text-muted">
            <?= $row["nama"]; ?>
            &nbsp; | &nbsp;
            <?= waktu_lalu ($row["tanggal"]); ?>
          </small>
          <p class="mt-2"><?= substr(strip_tags($row['isi_berita']),0,100); ?>...</p>
          <a href="detail.php?id=<?= $row["id"]; ?>" class="btn btn-outline-primary">Baca Selengkapnya</a>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<?php while($kat = mysqli_fetch_assoc($kategori)) :
$id_kategori = $kat['id'];
$artikel_kategori = mysqli_query($koneksi, "
  select
    artikel.*, users.nama
  from artikel
  left join users on artikel.user_id = users.id
  where kategori_id='$id_kategori'
  order by artikel.id desc
  limit 3
");
?>

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2><?= $kat["nama_kategori"]; ?></h2>
  </div>
  <div class="row">
    <?php while($a = mysqli_fetch_assoc($artikel_kategori)) : ?>
    <div class="col-md-4 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="uploads/<?= $a["thumbnail"]; ?>" class="card-img-top" style="height: 220px; object-fit:cover;">
        <div class="card-body">
          <h5><?= $a["judul"]; ?></h5>
          <small class="text-muted">
            <?= $a["nama"]; ?>
            &nbsp; | &nbsp;
            <?= waktu_lalu($a["tanggal"]); ?>
          </small>
          <p class="mt-2"><?= substr(strip_tags($a['isi_berita']),0,80); ?>...</p>
          <a href="detail.php?id=<?= $a['id']; ?>" class="btn btn-primary">Baca Selengkapnya</a>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<?php endwhile; ?>