<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) session_start();

function cart_init(): void {
  if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // [productId => qty]
  }
}

function cart_add(int $id, int $qty = 1): void {
  cart_init();
  if ($qty < 1) $qty = 1;
  $_SESSION['cart'][$id] = (int)(($_SESSION['cart'][$id] ?? 0) + $qty);
}

function cart_update(int $id, int $qty): void {
  cart_init();
  if ($qty <= 0) unset($_SESSION['cart'][$id]);
  else $_SESSION['cart'][$id] = $qty;
}

function cart_remove(int $id): void {
  cart_init();
  unset($_SESSION['cart'][$id]);
}

function cart_clear(): void {
  $_SESSION['cart'] = [];
}

function cart_count_items(): int {
  cart_init();
  $sum = 0;
  foreach ($_SESSION['cart'] as $q) $sum += (int)$q;
  return $sum;
}

function cart_total(array $products): int {
  cart_init();
  $sum = 0;
  foreach ($_SESSION['cart'] as $pid => $qty) {
    $pid = (int)$pid; $qty = (int)$qty;
    if (!isset($products[$pid])) continue;
    $sum += (int)$products[$pid]['price'] * $qty;
  }
  return $sum;
}
