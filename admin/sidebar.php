<div class="d-flex">
  <!-- sidebar -->
  <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
    <h3 class="mb-4">News Portal</h3>
    <ul class="nav flex-column">
      <li class="nav-item mb-2">
        <a href="/admin/index.php" class="nav-link text-white">Dashboard</a>
      </li>
      <?php if ($_SESSION["role"] == "ketua") : ?>
      <li class="nav-item mb-2">
        <a href="/admin/user.php" class="nav-link text-white">Kelola User</a>
      </li>
      <?php endif; ?>
      <li class="nav-item mb-2">
        <a href="/admin/kategori/index.php" class="nav-link text-white">Kategori</a>
      </li>
      <li class="nav-item mb-2">
        <a href="/admin/artikel/index.php" class="nav-link text-white">Artikel</a>
      </li>
      <li class="nav-item mb-2">
        <a href="/admin/logout.php" class="nav-link text-danger">Logout</a>
      </li>
    </ul>
  </div>

  <div class="p-4 w-100">