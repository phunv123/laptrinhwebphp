<?php
declare(strict_types=1);

// Lưu hash, không lưu password rõ
$users = [
  'admin' => [
    'hash' => password_hash('admin123', PASSWORD_DEFAULT),
    'role' => 'admin',
  ],
  'student' => [
    'hash' => password_hash('student123', PASSWORD_DEFAULT),
    'role' => 'user',
  ],
];
