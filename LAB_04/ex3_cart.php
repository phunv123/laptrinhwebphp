<?php
function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$products = [
  ['name' => 'Book', 'price' => 10, 'qty' => 2],
  ['name' => 'Pen',  'price' => 3,  'qty' => 5],
  ['name' => 'Bag',  'price' => 25, 'qty' => 1],
];

foreach ($products as &$p) {
  $p['amount'] = $p['price'] * $p['qty'];
}
unset($p);

$total = array_sum(array_column($products, 'amount'));

// tìm amount lớn nhất
$maxItem = null;
$maxAmount = null;
foreach ($products as $p) {
  if ($maxAmount === null || $p['amount'] > $maxAmount) {
    $maxAmount = $p['amount'];
    $maxItem = $p;
  }
}

// sort theo price giảm dần (không mất mảng gốc)
$sorted = $products;
usort($sorted, fn($a,$b) => $b['price'] <=> $a['price']);
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>LAB04 - Bài 3</title>
  <style>
    body{font-family:Arial, sans-serif; background:#f5f6f8; margin:0; padding:24px;}
    .card{max-width:980px; margin:0 auto; background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:18px; box-shadow:0 6px 18px rgba(0,0,0,.06);}
    .title{margin:0 0 10px;}
    .muted{color:#6b7280;}
    hr{border:none; border-top:1px solid #e5e7eb; margin:14px 0;}
    table{width:100%; border-collapse:collapse; overflow:hidden; border-radius:10px;}
    th,td{border:1px solid #e5e7eb; padding:10px; text-align:left;}
    th{background:#f9fafb;}
    .note{background:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:12px;}
  </style>
</head>
<body>
  <div class="card">
    <h2 class="title">LAB 04 — Bài 3: Giỏ hàng</h2>
    <p class="muted">Mảng nhiều chiều + cột phát sinh amount + tổng tiền + sort</p>
    <hr>

    <table>
      <tr>
        <th>STT</th><th>Name</th><th>Price</th><th>Qty</th><th>Amount</th>
      </tr>
      <?php foreach ($products as $i => $p): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= h($p['name']) ?></td>
          <td><?= $p['price'] ?></td>
          <td><?= $p['qty'] ?></td>
          <td><?= $p['amount'] ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="4"><b>Tổng tiền</b></td>
        <td><b><?= $total ?></b></td>
      </tr>
    </table>

    <br>
    <div class="note">
      <b>Amount lớn nhất:</b>
      <?= $maxItem ? h($maxItem['name']) . " (amount=" . $maxItem['amount'] . ")" : "(không có)" ?>
      <hr>
      <b>Danh sách sau sort theo price giảm dần:</b>
      <ul>
        <?php foreach ($sorted as $p): ?>
          <li><?= h($p['name']) ?> — price: <?= $p['price'] ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</body>
</html>
