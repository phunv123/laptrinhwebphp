<?php
$name  = "Nguyễn Văn Phú";
$class = "DCCNTT 14.2";
$email = "phuvuive3@gmail.com";
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>BT1 - Variables</title>
</head>
<body>
  <h1>BT1 - variables.php</h1>

  <ul>
    <li><b>Họ tên:</b> <?= htmlspecialchars($name) ?></li>
    <li><b>Lớp:</b> <?= htmlspecialchars($class) ?></li>
    <li><b>Email:</b> <?= htmlspecialchars($email) ?></li>
  </ul>

  <p><a href="index.php">← Về menu LAB 02</a></p>
</body>
</html>
