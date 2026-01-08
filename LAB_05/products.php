<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/data/products_data.php';

require_login();
?>
<div class="d-flex align-items-center justify-content-between mb-3">
  <h4 class="m-0">Products</h4>
  <span class="text-muted small">Thêm sản phẩm vào giỏ bằng nút Add.</span>
</div>

<div class="row g-3">
  <?php foreach ($products as $p): ?>
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title"><?= e((string)$p['name']) ?></h5>
          <p class="card-text mb-3">
            Giá: <b><?= number_format((int)$p['price']) ?> đ</b>
          </p>

          <form method="post" action="actions/cart_add.php" class="d-flex gap-2">
            <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
            <input class="form-control form-control-sm" type="number" name="qty" value="1" min="1" style="max-width: 90px;">
            <button class="btn btn-sm btn-dark" type="submit">Add</button>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
