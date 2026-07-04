<?php
session_start();
require_once "../config/koneksi.php";

if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $query = mysqli_query($koneksi, "select * from users where email='$email'");
  $data = mysqli_fetch_assoc($query);

  if ($data) {
    if (password_verify($password, $data["password"])) {
      $_SESSION["id"] = $data["id"];
      $_SESSION["nama"] = $data["nama"];
      $_SESSION["role"] = $data["role"];

      if ($data["role"] == "ketua") {
        header("Location: ../admin/dashboard.php");
      } else {
        header("Location: ../admin/dashboard.php");
      }
    } else {
      $error = "Password salah";
    }
  } else {
    $error = "Email tidak ditemukan";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card mt-5 shadow">
          <div class="card-body">
            <h3 class="text-center mb-4">Login Admin</h3>
            <?php if (isset($error)) : ?>
              <div class="alert alert-danger">
                <?php echo $error; ?>
              </div>
            <?php endif; ?>
            <form method="POST">
              <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required />
              </div>
              <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required />
              </div>
              <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>