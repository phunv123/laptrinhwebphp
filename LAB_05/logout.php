<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verify($_POST['csrf'] ?? null)) {
  http_response_code(400);
  exit('Bad Request');
}

session_unset();
session_destroy();

// Xóa cookie remember_username
setcookie('remember_username', '', time() - 3600, '/');

// Tạo session mới để flash
session_start();
set_flash('info', 'Bạn đã đăng xuất.');
header('Location: login.php');
exit;
