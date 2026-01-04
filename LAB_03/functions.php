<?php
// functions.php
// LAB03 - Thư viện hàm
// Mỗi hàm có mô tả + kiểm tra đầu vào cơ bản (theo yêu cầu đề).

/**
 * max2($a, $b): trả về số lớn hơn trong 2 số
 */
function max2($a, $b) {
    return ($a >= $b) ? $a : $b;
}

/**
 * min2($a, $b): trả về số nhỏ hơn trong 2 số
 */
function min2($a, $b) {
    return ($a <= $b) ? $a : $b;
}

/**
 * isPrime($n): kiểm tra số nguyên tố
 * - n < 2 => false
 */
function isPrime(int $n): bool {
    if ($n < 2) return false;
    if ($n === 2) return true;
    if ($n % 2 === 0) return false;

    for ($i = 3; $i * $i <= $n; $i += 2) {
        if ($n % $i === 0) return false;
    }
    return true;
}

/**
 * factorial($n): tính n! (n >= 0)
 * - nếu n < 0 => null
 */
function factorial(int $n) {
    if ($n < 0) return null;
    $res = 1;
    for ($i = 2; $i <= $n; $i++) $res *= $i;
    return $res;
}

/**
 * gcd($a, $b): ƯCLN theo thuật toán Euclid
 */
function gcd(int $a, int $b): int {
    $a = abs($a);
    $b = abs($b);
    if ($a === 0) return $b;
    if ($b === 0) return $a;

    while ($b !== 0) {
        $tmp = $a % $b;
        $a = $b;
        $b = $tmp;
    }
    return $a;
}
