<?php

$r = 5; // bạn đổi tùy ý
$pi = 3.141592653589793;

$chuVi = 2 * $pi * $r;
$dienTich = $pi * $r * $r;
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>BT3 - Operators Math</title>
</head>
<body>
  <h1>BT3 - operators_math.php</h1>

  <ul>
    <li><b>Bán kính r:</b> <?= htmlspecialchars((string)$r) ?></li>
    <li><b>Chu vi:</b> <?= htmlspecialchars((string)round($chuVi, 2)) ?></li>
    <li><b>Diện tích:</b> <?= htmlspecialchars((string)round($dienTich, 2)) ?></li>
  </ul>

  <p><a href="index.php">← Về menu LAB 02</a></p>
</body>
</html>
