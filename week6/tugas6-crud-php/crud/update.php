<?php
require_once __DIR__ . '/../config/db.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: read.php'); exit; }

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();
if (!$user) { header('Location: read.php'); exit; }

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email']    ?? '');

    if ($username === '' || $email === '') {
        $message = 'Username dan email tidak boleh kosong.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Format email tidak valid.';
    } else {
        $cekUser = $pdo->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
        $cekUser->execute([$username, $id]);
        if ($cekUser->fetch()) {
            $message = 'Username sudah digunakan pengguna lain.';
        } else {
            $cekEmail = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
            $cekEmail->execute([$email, $id]);
            if ($cekEmail->fetch()) {
                $message = 'Email sudah digunakan pengguna lain.';
            } else {
                $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?")
                    ->execute([$username, $email, $id]);
                header('Location: read.php?updated=1');
                exit;
            }
        }
    }
    $user['username'] = $username;
    $user['email']    = $email;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2 class="page-title">Update User</h2>

    <?php if ($message): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($message) ?>
    </div>
    <?php endif; ?>

    <form method="POST" id="updateForm" novalidate class="form-body">
        <div class="form-group">
            <label for="username">Name:</label>
            <input type="text" id="username" name="username"
                placeholder="Your name"
                value="<?= htmlspecialchars($user['username']) ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                placeholder="Your email"
                value="<?= htmlspecialchars($user['email']) ?>">
        </div>
        <button type="submit" class="btn-update">Update</button>
        <a href="read.php" class="btn-cancel-link">Batal</a>
    </form>

    <nav class="nav-bar">
        <a href="create.php">CREATE</a>
        <a href="read.php">READ</a>
    </nav>
</div>

<div id="toast"></div>

<script>
    var phpMessage = <?= json_encode($message) ?>;
    var phpType    = 'error';
</script>
<script src="../js/script.js"></script>
</body>
</html>