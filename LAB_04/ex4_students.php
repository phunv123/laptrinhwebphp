<?php
require_once "Student.php";
function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$students = [
  new Student("SV001", "An",   3.2),
  new Student("SV002", "Binh", 2.6),
  new Student("SV003", "Chi",  3.5),
  new Student("SV004", "Dung", 3.8),
  new Student("SV005", "Hoa",  2.2),
];

$gpas = array_map(fn($s) => $s->getGpa(), $students);
$avg = array_sum($gpas) / count($gpas);

$stats = ["Giỏi"=>0, "Khá"=>0, "Trung bình"=>0];
foreach ($students as $s) {
  $stats[$s->rank()]++;
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>LAB04 - Bài 4</title>
  <style>
    body{font-family:Arial, sans-serif; background:#f5f6f8; margin:0; padding:24px;}
    .card{max-width:980px; margin:0 auto; background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:18px; box-shadow:0 6px 18px rgba(0,0,0,.06);}
    .title{margin:0 0 10px;}
    .muted{color:#6b7280;}
    hr{border:none; border-top:1px solid #e5e7eb; margin:14px 0;}
    table{width:100%; border-collapse:collapse; overflow:hidden; border-radius:10px;}
    th,td{border:1px solid #e5e7eb; padding:10px; text-align:left;}
    th{background:#f9fafb;}
    .pill{display:inline-block; padding:6px 10px; border-radius:999px; background:#f3f4f6; margin-right:8px;}
  </style>
</head>
<body>
  <div class="card">
    <h2 class="title">LAB 04 — Bài 4: OOP Student</h2>
    <p class="muted">Render bảng + GPA trung bình + thống kê xếp loại</p>
    <hr>

    <table>
      <tr><th>STT</th><th>ID</th><th>Name</th><th>GPA</th><th>Rank</th></tr>
      <?php foreach ($students as $i => $s): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= h($s->getId()) ?></td>
          <td><?= h($s->getName()) ?></td>
          <td><?= number_format($s->getGpa(), 2) ?></td>
          <td><?= h($s->rank()) ?></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <br>
    <div>
      <span class="pill"><b>GPA TB:</b> <?= number_format($avg, 2) ?></span>
      <span class="pill"><b>Giỏi:</b> <?= $stats["Giỏi"] ?></span>
      <span class="pill"><b>Khá:</b> <?= $stats["Khá"] ?></span>
      <span class="pill"><b>Trung bình:</b> <?= $stats["Trung bình"] ?></span>
    </div>
  </div>
</body>
</html>
