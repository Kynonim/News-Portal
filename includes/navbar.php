<?php
$data = mysqli_query($koneksi, "select * from kategori");
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">News Portal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigasi">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navigasi" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Kategori</a>
          <ul class="dropdown-menu">
            <?php while ($menu = mysqli_fetch_assoc($data)) : ?>
            <li>
              <a href="kategori.php?id=<?= $menu["id"]; ?>" class="dropdown-item">
                <?= $menu["nama_kategori"]; ?>
              </a>
            </li>
            <?php endwhile; ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tentang.php">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-warning text-dark ms-2 px-3" href="./auth/login.php">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
