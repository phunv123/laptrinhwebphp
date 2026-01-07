<?php
$scores = [8.5, 7.0, 9.25, 6.5, 8.0, 5.75];

$avg = array_sum($scores) / count($scores);
$ge8 = array_values(array_filter($scores, fn($x)=> $x >= 8.0));
$max = max($scores);
$min = min($scores);

$asc = $scores; sort($asc);
$desc = $scores; rsort($desc);
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>LAB04 - Bài 2</title>
  <style>
    body{font-family:Arial, sans-serif; background:#f5f6f8; margin:0; padding:24px;}
    .card{max-width:900px; margin:0 auto; background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:18px; box-shadow:0 6px 18px rgba(0,0,0,.06);}
    .title{margin:0 0 10px;}
    .muted{color:#6b7280;}
    hr{border:none; border-top:1px solid #e5e7eb; margin:14px 0;}
    .row{display:flex; gap:14px; flex-wrap:wrap;}
    .box{flex:1; min-width:240px; background:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:12px;}
    code{background:#f3f4f6; padding:2px 6px; border-radius:6px;}
  </style>
</head>
<body>
  <div class="card">
    <h2 class="title">LAB 04 — Bài 2: Mảng điểm</h2>
    <p class="muted">Mảng gốc: <code>[<?= implode(', ', $scores) ?>]</code></p>
    <hr>

    <div class="row">
      <div class="box">
        <b>Điểm trung bình:</b> <?= number_format($avg, 2) ?><br>
        <b>Max:</b> <?= $max ?> — <b>Min:</b> <?= $min ?>
      </div>

      <div class="box">
        <b>Điểm ≥ 8.0 (<?= count($ge8) ?>):</b><br>
        <?= count($ge8) ? implode(', ', $ge8) : '(không có)' ?>
      </div>

      <div class="box">
        <b>Tăng dần (copy rồi sort):</b><br>
        <?= implode(', ', $asc) ?><br><br>
        <b>Giảm dần (copy rồi rsort):</b><br>
        <?= implode(', ', $desc) ?>
      </div>
    </div>
  </div>
</body>
</html>
