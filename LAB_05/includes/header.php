<?php
declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/flash.php';
require_once __DIR__ . '/csrf.php';
require_once __DIR__ . '/cart_lib.php';

cart_init();
$user = current_user();
$cartCount = cart_count_items();

$success = get_flash('success');
$error   = get_flash('error');
$info    = get_flash('info');
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LAB 05 - Shop Demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Shop Demo</a>

    <div class="d-flex align-items-center gap-2">
      <?php if (is_logged_in()): ?>
        <a class="btn btn-outline-light btn-sm" href="dashboard.php">Dashboard</a>
        <a class="btn btn-outline-light btn-sm" href="products.php">Products</a>
        <a class="btn btn-outline-light btn-sm" href="cart.php">
          Cart <span class="badge bg-warning text-dark"><?= (int)$cartCount ?></span>
        </a>

        <span class="text-white-50 small">
          <?= e((string)($user['username'] ?? '')) ?>
        </span>

        <form method="post" action="logout.php" class="m-0">
          <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
          <button class="btn btn-warning btn-sm" type="submit">Logout</button>
        </form>
      <?php else: ?>
        <a class="btn btn-outline-light btn-sm" href="login.php">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<main class="container py-4">
  <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
  <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
  <?php if ($info): ?><div class="alert alert-info"><?= e($info) ?></div><?php endif; ?>
