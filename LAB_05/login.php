<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/flash.php';
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/data/users.php';

if (is_logged_in()) {
  header('Location: dashboard.php');
  exit;
}

$prefill = (string)($_COOKIE['remember_username'] ?? '');
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim((string)($_POST['username'] ?? ''));
  $password = (string)($_POST['password'] ?? '');
  $remember = !empty($_POST['remember']);

  if ($username === '' || $password === '') {
    $error = 'Vui lòng nhập đầy đủ username và password.';
  } else {
    if (!empty($users[$username]) && password_verify($password, (string)$users[$username]['hash'])) {
      $_SESSION['auth'] = true;
      $_SESSION['user'] = [
        'username' => $username,
        'role' => (string)$users[$username]['role'],
      ];

      if ($remember) {
        setcookie('remember_username', $username, time() + 7*24*60*60, '/');
      }

      set_flash('success', 'Đăng nhập thành công.');
      header('Location: dashboard.php');
      exit;
    } else {
      $error = 'Sai tài khoản hoặc mật khẩu.';
    }
  }

  $prefill = $username;
}

require_once __DIR__ . '/includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h4 class="mb-3">Đăng nhập</h4>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" action="login.php" autocomplete="off">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input class="form-control" name="username" value="<?= e($prefill) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" required>
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember username (7 ngày)</label>
          </div>

          <button class="btn btn-dark w-100" type="submit">Login</button>

          <div class="mt-3 small text-muted">
            Test: <b>admin/admin123</b> hoặc <b>student/student123</b>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
