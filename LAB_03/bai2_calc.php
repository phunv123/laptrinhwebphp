<?php
// bai2_calc.php
// INPUT: a, b, op (GET) - op: add|sub|mul|div
// OUTPUT: "a op b = result"

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$aRaw = $_GET["a"] ?? null;
$bRaw = $_GET["b"] ?? null;
$op   = $_GET["op"] ?? null;

if ($aRaw === null || $bRaw === null || $op === null) {
    echo "<p>Thiếu tham số. Ví dụ:</p>";
    echo "<ul>
            <li><code>bai2_calc.php?a=10&b=3&op=mul</code></li>
            <li><code>bai2_calc.php?a=10&b=0&op=div</code></li>
          </ul>";
    exit;
}

if (!is_numeric($aRaw) || !is_numeric($bRaw)) {
    echo "<p style='color:red;'><b>Lỗi:</b> a và b phải là số.</p>";
    exit;
}

$a = (float)$aRaw;
$b = (float)$bRaw;

$symbol = "";
$result = null;
$error  = null;

switch ($op) {
    case "add":
        $symbol = "+";
        $result = $a + $b;
        break;
    case "sub":
        $symbol = "-";
        $result = $a - $b;
        break;
    case "mul":
        $symbol = "*";
        $result = $a * $b;
        break;
    case "div":
        $symbol = "/";
        if ($b == 0.0) $error = "Không chia được cho 0";
        else $result = $a / $b;
        break;
    default:
        $error = "op không hợp lệ (chỉ: add|sub|mul|div)";
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Bài 2 - Máy tính mini</title>
</head>
<body>
  <h1>Bài 2 - Máy tính mini</h1>

  <ul>
    <li><b>a:</b> <?= h($a) ?></li>
    <li><b>b:</b> <?= h($b) ?></li>
    <li><b>op:</b> <?= h($op) ?></li>
  </ul>

  <?php if ($error !== null): ?>
    <p style="color:red;"><b>Lỗi:</b> <?= h($error) ?></p>
  <?php else: ?>
    <p><b>Kết quả:</b> <?= h($a) ?> <?= h($symbol) ?> <?= h($b) ?> = <b><?= h($result) ?></b></p>
  <?php endif; ?>

  <p><a href="index.php">← Về index Lab03</a></p>
</body>
</html>
