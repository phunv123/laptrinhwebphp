<?php
require_once "functions.php";

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$action = $_GET["action"] ?? "home";

$a = $_GET["a"] ?? null;
$b = $_GET["b"] ?? null;
$n = $_GET["n"] ?? null;

?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>LAB03 - Mini Utility</title>
</head>
<body>
  <h2>LAB03 - Mini Utility</h2>

  <p>
    <a href="?action=home">Home</a> |
    <a href="?action=max&a=10&b=22">Max</a> |
    <a href="?action=min&a=10&b=22">Min</a> |
    <a href="?action=prime&n=17">Prime</a> |
    <a href="?action=fact&n=6">Factorial</a> |
    <a href="?action=gcd&a=12&b=18">GCD</a>
  </p>

  <hr>

  <?php
  $error = null;
  $output = "";

  switch ($action) {
    case "home":
      $output = "<p>Chọn một chức năng ở menu phía trên.</p>";
      $output .= "<p>Bài 1–3:</p>
        <ul>
          <li><a href='bai1_grade.php?score=8.2'>Bài 1 - Grade</a></li>
          <li><a href='bai2_calc.php?a=10&b=3&op=mul'>Bài 2 - Calc</a></li>
          <li><a href='bai3_loops.php?n=25'>Bài 3 - Loops</a></li>
        </ul>";
      break;

    case "max":
      if ($a === null || $b === null || !is_numeric($a) || !is_numeric($b)) {
        $error = "Thiếu hoặc sai tham số a, b (cần là số).";
      } else {
        $output = "<p>max2(" . h($a) . ", " . h($b) . ") = <b>" . h(max2((float)$a, (float)$b)) . "</b></p>";
      }
      break;

    case "min":
      if ($a === null || $b === null || !is_numeric($a) || !is_numeric($b)) {
        $error = "Thiếu hoặc sai tham số a, b (cần là số).";
      } else {
        $output = "<p>min2(" . h($a) . ", " . h($b) . ") = <b>" . h(min2((float)$a, (float)$b)) . "</b></p>";
      }
      break;

    case "prime":
      if ($n === null || !is_numeric($n)) {
        $error = "Thiếu hoặc sai tham số n (cần là số nguyên).";
      } else {
        $nInt = (int)$n;
        $output = "<p>n = <b>" . h($nInt) . "</b> → ";
        $output .= isPrime($nInt) ? "<b>Là số nguyên tố</b>" : "<b>Không phải số nguyên tố</b>";
        $output .= "</p>";
      }
      break;

    case "fact":
      if ($n === null || !is_numeric($n)) {
        $error = "Thiếu hoặc sai tham số n (cần là số nguyên).";
      } else {
        $nInt = (int)$n;
        $fact = factorial($nInt);
        if ($fact === null) $error = "n phải >= 0 để tính giai thừa.";
        else $output = "<p>" . h($nInt) . "! = <b>" . h($fact) . "</b></p>";
      }
      break;

    case "gcd":
      if ($a === null || $b === null || !is_numeric($a) || !is_numeric($b)) {
        $error = "Thiếu hoặc sai tham số a, b (cần là số nguyên).";
      } else {
        $aInt = (int)$a;
        $bInt = (int)$b;
        $output = "<p>gcd(" . h($aInt) . ", " . h($bInt) . ") = <b>" . h(gcd($aInt, $bInt)) . "</b></p>";
      }
      break;

    default:
      $error = "action không hợp lệ.";
  }

  if ($error !== null) {
    echo "<p style='color:red;'><b>Lỗi:</b> " . h($error) . "</p>";
  } else {
    echo $output;
  }
  ?>

  <hr>
</body>
</html>
