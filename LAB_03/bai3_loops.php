<?php
// bai3_loops.php
// INPUT: n (GET) ví dụ: ?n=25
// OUTPUT: (A) bảng cửu chương 1..9, (B) tổng chữ số của n, (C) số lẻ 1..N (break > 15)

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$nRaw = $_GET["n"] ?? 25;
if (!is_numeric($nRaw)) $nRaw = 25;
$n = (int)$nRaw;
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Bài 3 - Vòng lặp</title>
  <style>
    table { border-collapse: collapse; }
    td, th { border: 1px solid #999; padding: 6px 10px; text-align: center; }
  </style>
</head>
<body>
  <h1>Bài 3 - Vòng lặp</h1>

  <h2>A) Bảng cửu chương 1..9</h2>
  <table>
    <tr>
      <th>x</th>
      <?php for ($j = 1; $j <= 9; $j++): ?>
        <th><?= $j ?></th>
      <?php endfor; ?>
    </tr>
    <?php for ($i = 1; $i <= 9; $i++): ?>
      <tr>
        <th><?= $i ?></th>
        <?php for ($j = 1; $j <= 9; $j++): ?>
          <td><?= $i * $j ?></td>
        <?php endfor; ?>
      </tr>
    <?php endfor; ?>
  </table>

  <h2>B) Tổng chữ số của n (while)</h2>
  <?php
    $tmp = abs($n);
    $sumDigits = 0;

    // while để tính tổng chữ số
    while ($tmp > 0) {
        $sumDigits += ($tmp % 10);
        $tmp = intdiv($tmp, 10);
    }

    // nếu n = 0 thì tổng chữ số là 0
    if ($n === 0) $sumDigits = 0;
  ?>
  <p>n = <b><?= h($n) ?></b> ⇒ tổng chữ số = <b><?= h($sumDigits) ?></b></p>

  <h2>C) In số lẻ từ 1..N (continue + break)</h2>
  <p>N bạn nhập: <b><?= h($n) ?></b> (nhưng sẽ dừng sớm nếu vượt 15)</p>
  <ul>
    <?php
      for ($i = 1; $i <= $n; $i++) {
          if ($i % 2 === 0) continue;     // bỏ qua số chẵn
          if ($i > 15) break;             // dừng sớm khi vượt 15
          echo "<li>$i</li>";
      }
    ?>
  </ul>

  <p><a href="index.php">← Về index Lab03</a></p>
</body>
</html>
