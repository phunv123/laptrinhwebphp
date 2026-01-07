<?php
require_once "Student.php";
function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$raw = '';
$threshold = '';
$doSort = false;

$error = null;
$list = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $raw = $_POST['data'] ?? '';
  $threshold = $_POST['threshold'] ?? '';
  $doSort = isset($_POST['sort']);

  $records = array_filter(array_map('trim', explode(';', $raw)), fn($x)=>$x!=='');
  foreach ($records as $rec) {
    $parts = array_map('trim', explode('-', $rec));
    if (count($parts) !== 3) continue;

    [$id,$name,$gpaStr] = $parts;
    if ($id === '' || $name === '' || !is_numeric($gpaStr)) continue;

    $list[] = new Student($id, $name, (float)$gpaStr);
  }

  if (count($list) === 0) {
    $error = "Danh sách rỗng (hoặc tất cả record sai định dạng).";
  } else {
    if (trim($threshold) !== '' && is_numeric($threshold)) {
      $t = (float)$threshold;
      $list = array_values(array_filter($list, fn($s)=>$s->getGpa() >= $t));
    }

    if ($doSort) {
      usort($list, fn($a,$b)=> $b->getGpa() <=> $a->getGpa());
    }
  }
}

$avg = null; $max = null; $min = null;
$stats = ["Giỏi"=>0,"Khá"=>0,"Trung bình"=>0];

if ($list) {
  $gpas = array_map(fn($s)=>$s->getGpa(), $list);
  $avg = array_sum($gpas)/count($gpas);
  $max = max($gpas);
  $min = min($gpas);
  foreach ($list as $s) $stats[$s->rank()]++;
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>LAB04 - Bài 5</title>
  <style>
    body{font-family:Arial, sans-serif; background:#f5f6f8; margin:0; padding:24px;}
    .card{max-width:980px; margin:0 auto; background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:18px; box-shadow:0 6px 18px rgba(0,0,0,.06);}
    .title{margin:0 0 10px;}
    .muted{color:#6b7280;}
    hr{border:none; border-top:1px solid #e5e7eb; margin:14px 0;}
    label{display:block; margin:10px 0 6px; font-weight:700;}
    textarea,input{width:100%; padding:10px; border:1px solid #e5e7eb; border-radius:10px; font-family:inherit;}
    .row{display:flex; gap:12px; flex-wrap:wrap; align-items:flex-end;}
    .col{flex:1; min-width:220px;}
    .btn{padding:10px 14px; border:0; border-radius:10px; background:#111827; color:#fff; cursor:pointer;}
    .hint{background:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:10px;}
    .error{color:#b91c1c; font-weight:700; background:#fef2f2; border:1px solid #fecaca; padding:10px; border-radius:10px;}
    table{width:100%; border-collapse:collapse; overflow:hidden; border-radius:10px; margin-top:12px;}
    th,td{border:1px solid #e5e7eb; padding:10px; text-align:left;}
    th{background:#f9fafb;}
    .pill{display:inline-block; padding:6px 10px; border-radius:999px; background:#f3f4f6; margin:6px 8px 0 0;}
    code{background:#f3f4f6; padding:2px 6px; border-radius:6px;}
  </style>
</head>
<body>
  <div class="card">
    <h2 class="title">LAB 04 — Bài 5: Student Manager (POST)</h2>
    <div class="hint">
      <b>Dữ liệu mẫu:</b>
      <code>SV001-An-3.2;SV002-Binh-2.6;SV003-Chi-3.5;SV004-Dung-3.8</code>
    </div>
    <hr>

    <form method="post">
      <label>Textarea dữ liệu (định dạng: ID-Name-GPA; ...)</label>
      <textarea name="data" rows="4" placeholder="SV001-An-3.2;SV002-Binh-2.6;SV003-Chi-3.5"><?= h($raw) ?></textarea>

      <div class="row">
        <div class="col">
          <label>Threshold (lọc GPA >= ...)</label>
          <input name="threshold" value="<?= h($threshold) ?>" placeholder="VD: 3.0">
        </div>
        <div class="col" style="max-width:260px;">
          <label>
            <input type="checkbox" name="sort" <?= $doSort ? 'checked' : '' ?>>
            Sort GPA giảm dần
          </label>
          <button class="btn" type="submit">Parse &amp; Show</button>
        </div>
      </div>
    </form>

    <?php if ($error): ?>
      <p class="error"><?= h($error) ?></p>
    <?php endif; ?>

    <?php if ($list): ?>
      <table>
        <tr><th>STT</th><th>ID</th><th>Name</th><th>GPA</th><th>Rank</th></tr>
        <?php foreach ($list as $i => $s): ?>
          <tr>
            <td><?= $i+1 ?></td>
            <td><?= h($s->getId()) ?></td>
            <td><?= h($s->getName()) ?></td>
            <td><?= number_format($s->getGpa(), 2) ?></td>
            <td><?= h($s->rank()) ?></td>
          </tr>
        <?php endforeach; ?>
      </table>

      <div style="margin-top:10px;">
        <span class="pill"><b>AVG:</b> <?= number_format($avg, 2) ?></span>
        <span class="pill"><b>MAX:</b> <?= number_format($max, 2) ?></span>
        <span class="pill"><b>MIN:</b> <?= number_format($min, 2) ?></span>
        <span class="pill"><b>Giỏi:</b> <?= $stats["Giỏi"] ?></span>
        <span class="pill"><b>Khá:</b> <?= $stats["Khá"] ?></span>
        <span class="pill"><b>Trung bình:</b> <?= $stats["Trung bình"] ?></span>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
