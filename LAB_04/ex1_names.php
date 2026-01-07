<?php
function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$raw = $_GET['names'] ?? '';
$names = [];

if (trim($raw) !== '') {
  $parts = explode(',', $raw);
  $parts = array_map('trim', $parts);
  $names = array_values(array_filter($parts, fn($x) => $x !== ''));
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>LAB04 - Bài 1</title>
  <style>
    body{font-family:Arial, sans-serif; background:#f5f6f8; margin:0; padding:24px;}
    .card{max-width:900px; margin:0 auto; background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:18px 18px 14px; box-shadow:0 6px 18px rgba(0,0,0,.06);}
    .title{margin:0 0 10px;}
    .muted{color:#6b7280;}
    .badge{display:inline-block; padding:4px 10px; border-radius:999px; background:#eef2ff; margin:6px 0 0;}
    code{background:#f3f4f6; padding:2px 6px; border-radius:6px;}
    hr{border:none; border-top:1px solid #e5e7eb; margin:14px 0;}
    .error{color:#b91c1c; font-weight:700;}
  </style>
</head>
<body>
  <div class="card">
    <h2 class="title">LAB 04 — Bài 1: Chuỗi → Danh sách tên (GET)</h2>
    <hr>

    <p><b>Chuỗi gốc:</b> <?= h($raw) ?></p>

    <?php if (count($names) === 0): ?>
      <p class="error">Chưa có dữ liệu hợp lệ</p>
    <?php else: ?>
      <div class="badge"><b>Số lượng tên hợp lệ:</b> <?= count($names) ?></div>
      <ol>
        <?php foreach ($names as $n): ?>
          <li><?= h($n) ?></li>
        <?php endforeach; ?>
      </ol>
    <?php endif; ?>
  </div>
</body>
</html>
