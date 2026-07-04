<?php
session_start();
if (!isset($_SESSION["role"])) { 
  header("Location: ../../auth/login.php");
  exit;
}

if ($_SESSION["role"] != 'ketua') {
  header("Location: ../admin/index.php");
  exit;
}

require_once "../config/koneksi.php";
require_once "header.php";
require_once "sidebar.php";

$user = mysqli_query($koneksi, "select * from users order by id desc");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>Kelola User</h2>
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah User</button>
</div>
<!-- pesan notifikasi -->
<?php if(isset($_GET['pesan'])) : ?>
<div class="alert alert-success">
  Data user berhasil
  <?= $_GET['pesan']; ?>
</div>
<?php endif; ?>
<!-- Tabel User -->
<div class="card shadow">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th width="20%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while($u = mysqli_fetch_assoc($user)):
          ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $u['nama']; ?></td>
            <td><?= $u['email']; ?></td>
            <td><?php if($u['role']=='ketua'){ ?>
              <span class="badge bg-success">Ketua</span>
              <?php } else { ?>
              <span class="badge bg-primary">Admin</span>
              <?php } ?>
            </td>
            <td>
              <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $u['id']; ?>">Edit</button>
              <a href="hapus.php?id=<?= $u['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
            </td>
          </tr>
          <!-- modal edit -->
          <div class="modal fade" id="edit<?= $u['id']; ?>" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="update.php" method="POST">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $u['id']; ?>">
                    <div class="mb-3">
                      <label>Nama</label>
                      <input type="text" name="nama" value="<?= $u['nama']; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                      <label>Email</label>
                      <input type="email" name="email" value="<?= $u['email']; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                      <label>Role</label>
                      <select name="role" class="form-select">
                        <option value="admin" <?=($u['role']=='admin' ) ? 'selected' : ''; ?>>Admin</option>
                        <option value="ketua" <?=($u['role']=='ketua' ) ? 'selected' : ''; ?>>Ketua</option>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- modal tambah user -->
<div class="modal fade" id="modalTambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="simpan.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Tambah User</h5>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-select">
              <option value="admin">Admin</option>
              <option value="ketua">Ketua</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Simpan</button>
        </div>
    </div>
    </form>
  </div>
</div>
</div>
<?php include "footer.php"; ?>