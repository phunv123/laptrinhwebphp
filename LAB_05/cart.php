<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/cart_lib.php';
require_once __DIR__ . '/data/products_data.php';

require_login();
cart_init();

$cart = $_SESSION['cart'];
?>
<div class="d-flex align-items-center justify-content-between mb-3">
  <h4 class="m-0">Cart</h4>
  <form method="post" action="actions/cart_clear.php" class="m-0">
    <button class="btn btn-outline-danger btn-sm" type="submit" <?= empty($cart) ? 'disabled' : '' ?>>Clear all</button>
  </form>
</div>

<?php if (empty($cart)): ?>
  <div class="alert alert-secondary">
    Giỏ hàng đang trống. <a href="products.php">Đi mua hàng</a>
  </div>
<?php else: ?>
  <div class="card shadow-sm">
    <div class="card-body">

      <form method="post" action="actions/cart_update.php">
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">

        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr>
                <th>Sản phẩm</th>
                <th style="width:140px;">Giá</th>
                <th style="width:160px;">Số lượng</th>
                <th style="width:160px;">Thành tiền</th>
                <th style="width:100px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cart as $pid => $qty): ?>
                <?php
                  $pid = (int)$pid;
                  $qty = (int)$qty;
                  if (!isset($products[$pid])) continue;
                  $p = $products[$pid];
                  $line = (int)$p['price'] * $qty;
                ?>
                <tr>
                  <td><?= e((string)$p['name']) ?></td>
                  <td><?= number_format((int)$p['price']) ?> đ</td>
                  <td>
                    <input class="form-control form-control-sm"
                           type="number" min="0"
                           name="qty[<?= $pid ?>]"
                           value="<?= $qty ?>">
                    <div class="small text-muted">Nhập 0 để xóa dòng</div>
                  </td>
                  <td><b><?= number_format($line) ?> đ</b></td>
                  <td>
                    <form method="post" action="actions/cart_remove.php" class="m-0">
                      <input type="hidden" name="id" value="<?= $pid ?>">
                      <button class="btn btn-sm btn-outline-danger" type="submit">Xóa</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-between align-items-center">
          <a class="btn btn-outline-primary" href="products.php">← Mua tiếp</a>

          <div class="text-end">
            <div class="mb-2">
              Tổng: <span class="fs-5"><b><?= number_format(cart_total($products)) ?> đ</b></span>
            </div>
            <button class="btn btn-dark" type="submit">Update cart</button>
          </div>
        </div>
      </form>

    </div>
  </div>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
