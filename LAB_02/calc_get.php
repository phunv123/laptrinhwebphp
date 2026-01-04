<?php
function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$a  = $_GET['a']  ?? null;
$b  = $_GET['b']  ?? null;
$op = $_GET['op'] ?? null;

$hasAll = ($a !== null && $b !== null && $op !== null);
$isNum  = ($hasAll && is_numeric($a) && is_numeric($b));

$result = null;
$error  = null;

if ($hasAll && $isNum) {
  $aNum = (float)$a;
  $bNum = (float)$b;

  switch ($op) {
    case 'add':
      $result = $aNum + $bNum;
      break;
    case 'sub':
      $result = $aNum - $bNum;
      break;
    case 'mul':
      $result = $aNum * $bNum;
      break;
    case 'div':
      if ($bNum == 0.0) $error = "Không thể chia cho 0!";
      else $result = $aNum / $bNum;
      break;
    default:
      $error = "op không hợp lệ! Chỉ nhận: add | sub | mul | div";
  }
} elseif ($hasAll && !$isNum) {
  $error = "a và b phải là số!";
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>BT4 - calc_get</title>
</head>
<body>
  <h1>BT4 - calc_get.php</h1>

  <?php if (!$hasAll): ?>
    <p><b>Thiếu tham số!</b></p>
    <p>Vui lòng truy cập theo mẫu:</p>
    <ul>
      <li><code>calc_get.php?a=10&b=5&op=add</code></li>
      <li><code>calc_get.php?a=10&b=5&op=sub</code></li>
      <li><code>calc_get.php?a=10&b=5&op=mul</code></li>
      <li><code>calc_get.php?a=10&b=5&op=div</code></li>
    </ul>
  <?php else: ?>
    <ul>
      <li><b>a:</b> <?= h($a) ?></li>
      <li><b>b:</b> <?= h($b) ?></li>
      <li><b>op:</b> <?= h($op) ?></li>
    </ul>

    <?php if ($error !== null): ?>
      <p style="color:red;"><b>Lỗi:</b> <?= h($error) ?></p>
    <?php else: ?>
      <p><b>Kết quả:</b> <?= h($result) ?></p>
    <?php endif; ?>
  <?php endif; ?>

  <p><a href="index.php">← Về menu LAB 02</a></p>
</body>
</html>
