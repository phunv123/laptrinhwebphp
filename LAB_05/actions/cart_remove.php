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

$id = (int)($_POST['id'] ?? 0);
if ($id > 0) cart_remove($id);

set_flash('info', 'Đã xóa sản phẩm khỏi giỏ.');
header('Location: ../cart.php');
exit;
