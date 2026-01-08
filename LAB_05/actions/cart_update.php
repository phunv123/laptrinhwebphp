<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/cart_lib.php';
require_once __DIR__ . '/../includes/flash.php';
require_once __DIR__ . '/../includes/csrf.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verify($_POST['csrf'] ?? null)) {
  http_response_code(400);
  exit('Bad Request');
}

$qtyMap = $_POST['qty'] ?? [];
if (!is_array($qtyMap)) $qtyMap = [];

foreach ($qtyMap as $pid => $qty) {
  cart_update((int)$pid, (int)$qty);
}

set_flash('info', 'Đã cập nhật giỏ hàng.');
header('Location: ../cart.php');
exit;
