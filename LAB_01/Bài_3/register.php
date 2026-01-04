<?php
function h($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

$errors = [];
$data = [
  'fullname' => '',
  'email' => '',
  'gender' => '',
  'hobbies' => [],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data['fullname'] = trim($_POST['fullname'] ?? '');
  $data['email']    = trim($_POST['email'] ?? '');
  $data['gender']   = $_POST['gender'] ?? '';
  $data['hobbies']  = $_POST['hobbies'] ?? [];

  if ($data['fullname'] === '') $errors[] = 'Họ tên không được để trống.';
  if ($data['email'] === '') $errors[] = 'Email không được để trống.';
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Register (POST Demo)</title>
</head>
<body>
  <h1>POST Demo - Form Register</h1>
  <p>Bộ môn công nghệ thông tin, Khoa CNTT, Đại học Công nghệ Đông Á.</p>

  <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)): ?>
    <h2>Dữ liệu đã gửi</h2>
    <ul>
      <li><b>Họ tên:</b> <?= h($data['fullname']) ?></li>
      <li><b>Email:</b> <?= h($data['email']) ?></li>
      <li><b>Giới tính:</b> <?= h($data['gender']) ?></li>
      <li><b>Sở thích:</b>
        <?php if (!empty($data['hobbies'])): ?>
          <ul>
            <?php foreach ($data['hobbies'] as $hb): ?>
              <li><?= h($hb) ?></li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          (Không chọn)
        <?php endif; ?>
      </li>
    </ul>

    <p><a href="register.php">← Quay lại form</a></p>

  <?php else: ?>

    <?php if (!empty($errors)): ?>
      <div style="border:1px solid #999;padding:10px;">
        <b>Lỗi:</b>
        <ul>
          <?php foreach ($errors as $e): ?>
            <li><?= h($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" action="register.php">
      <p>
        <label>Họ tên:</label><br>
        <input type="text" name="fullname" value="<?= h($data['fullname']) ?>">
      </p>

      <p>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= h($data['email']) ?>">
      </p>

      <p>
        <label>Giới tính:</label><br>
        <label><input type="radio" name="gender" value="Nam" <?= $data['gender']==='Nam'?'checked':''; ?>> Nam</label>
        <label><input type="radio" name="gender" value="Nữ" <?= $data['gender']==='Nữ'?'checked':''; ?>> Nữ</label>
        <label><input type="radio" name="gender" value="Khác" <?= $data['gender']==='Khác'?'checked':''; ?>> Khác</label>
      </p>

      <p>
        <label>Sở thích:</label><br>
        <?php
          $opts = ['Đọc sách', 'Chơi thể thao', 'Nghe nhạc', 'Chơi game'];
          foreach ($opts as $opt):
            $checked = in_array($opt, $data['hobbies'], true) ? 'checked' : '';
        ?>
          <label><input type="checkbox" name="hobbies[]" value="<?= h($opt) ?>" <?= $checked; ?>> <?= h($opt) ?></label><br>
        <?php endforeach; ?>
      </p>

      <button type="submit">Submit</button>
    </form>
  <?php endif; ?>
</body>
</html>
