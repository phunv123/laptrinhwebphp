<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/header.php';

require_login();
$user = current_user();
?>
<div class="card shadow-sm">
  <div class="card-body">
    <h4 class="mb-2">Dashboard</h4>
    <p class="mb-0">
      Xin chào <b><?= e((string)$user['username']) ?></b> — role: <b><?= e((string)$user['role']) ?></b>.
    </p>
    <hr>
    <div class="d-flex gap-2">
      <a class="btn btn-primary" href="products.php">Xem sản phẩm</a>
      <a class="btn btn-outline-primary" href="cart.php">Xem giỏ hàng</a>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
