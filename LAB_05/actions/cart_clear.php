<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/cart_lib.php';
require_once __DIR__ . '/../includes/flash.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ../cart.php');
  exit;
}

cart_clear();
set_flash('info', 'Đã xóa toàn bộ giỏ hàng.');
header('Location: ../cart.php');
exit;
