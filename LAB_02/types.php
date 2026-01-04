<?php
/**
 * INPUT: Không có
 * OUTPUT: In var_dump 5 kiểu dữ liệu cơ bản của PHP
 */
$anInteger = 2025;              // int
$aFloat    = 3.14;              // float
$aString   = "Hello PHP";       // string
$aBool     = true;              // boolean
$anArray   = ["PHP", 8, false]; // array
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>BT2 - Types</title>
</head>
<body>
  <h1>BT2 - types.php</h1>

  <p><b>In var_dump 5 kiểu dữ liệu:</b></p>

  <pre><?php
    var_dump($anInteger);
    var_dump($aFloat);
    var_dump($aString);
    var_dump($aBool);
    var_dump($anArray);
  ?></pre>

  <p><a href="index.php">← Về menu LAB 02</a></p>
</body>
</html>
