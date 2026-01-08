<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/cart_lib.php';
require_once __DIR__ . '/../includes/flash.php';
require_once __DIR__ . '/../data/products_data.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ../products.php');
  exit;
}

$id  = (int)($_POST['id'] ?? 0);
$qty = (int)($_POST['qty'] ?? 1);

if ($id <= 0 || !isset($products[$id])) {
  set_flash('error', 'Sản phẩm không hợp lệ.');
  header('Location: ../products.php');
  exit;
}

cart_add($id, $qty);
set_flash('success', 'Đã thêm vào giỏ hàng.');
header('Location: ../products.php');
exit;
