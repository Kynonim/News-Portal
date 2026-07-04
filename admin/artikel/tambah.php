<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: ../../auth/login.php");
  require_once "../../config/koneksi.php";
}

$kategori = mysqli_query($koneksi, "select * from kategori");
if (isset($_POST['simpan'])) {
  $judul = $_POST['judul'];
  $slug = strtolower(str_replace("", "-", $judul));
  $isi = $_POST['isi_berita'];
  $kategori_id = $_POST['kategori_id'];
  $user_id = $_SESSION['id'];

  $gambar = $_FILES['thumbnail']['name'];
  $tmp = $_FILES['thumbnail']['tmp_name'];

  move_uploaded_file($tmp, "../../uploads/" . $gambar);
  $simpan = mysqli_query($koneksi, "
    insert into artikel (
      judul, slug, isi_berita, thumbnail, kategori_id, user_id
    ) values (
      '$judul', '$slug', '$isi', '$gambar', '$kategori_id', '$user_id'
    )
  ");

  if ($simpan) {
    echo "
      <script>
        alert('Artikel berhasil ditambahkan');
        window.location='index.php';
      </script>
    ";
  }
}

include "../header.php";
include "../sidebar.php";
?>

