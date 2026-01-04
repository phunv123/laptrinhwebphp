<?php
function h($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

$name = $_GET['name'] ?? null;
$age  = $_GET['age']  ?? null;
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>GET Demo</title>
</head>
<body>
  <h1>GET Demo</h1>

  <?php if ($name === null || $age === null || $name === '' || $age === ''): ?>
    <p><b>Thiếu tham số!</b></p>
    <p>Vui lòng truy cập theo mẫu:</p>
    <p><code>get_demo.php?name=Phú&amp;age=20</code></p>
  <?php else: ?>
    <p>Xin chào <b><?= h($name) ?></b>, tuổi: <b><?= h($age) ?></b></p>
  <?php endif; ?>
</body>
</html>
