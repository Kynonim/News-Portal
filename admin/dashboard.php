<?php
session_start();
if (!isset($_SESSION["role"])) {
  header("Location: ../auth/login.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-body">
        <h2>Selamat datang, <?php echo $_SESSION["nama"]; ?></h2>
        <hr>
        <h5>Role: <?php echo $_SESSION["role"]; ?></h5>
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
      </div>
    </div>
  </div>
</body>
</html>