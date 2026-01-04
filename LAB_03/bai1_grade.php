<?php
// bai1_grade.php
// INPUT: score (GET) - ví dụ: ?score=8.2
// OUTPUT: "Điểm: X – Xếp loại: ..."

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$scoreRaw = $_GET["score"] ?? null;

if ($scoreRaw === null) {
    echo "<p>Thiếu tham số. Hãy truyền theo mẫu:</p>";
    echo "<code>bai1_grade.php?score=8.2</code>";
    exit;
}

if (!is_numeric($scoreRaw)) {
    echo "<p style='color:red;'><b>Lỗi:</b> score phải là số.</p>";
    exit;
}

$score = (float)$scoreRaw;

if ($score < 0 || $score > 10) {
    echo "<p style='color:red;'><b>Lỗi:</b> score phải nằm trong [0, 10].</p>";
    exit;
}

if ($score >= 8.5) $rank = "Giỏi";
elseif ($score >= 7.0) $rank = "Khá";
elseif ($score >= 5.0) $rank = "Trung bình";
else $rank = "Yếu";
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Bài 1 - Phân loại điểm</title>
</head>
<body>
  <h1>Bài 1 - Phân loại điểm</h1>
  <p>Điểm: <b><?= h($score) ?></b> – Xếp loại: <b><?= h($rank) ?></b></p>

  <p><a href="index.php">← Về index Lab03</a></p>
</body>
</html>
