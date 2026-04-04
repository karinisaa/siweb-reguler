<?php
require_once __DIR__ . '/../config/db.php';

$message  = '';
$type     = '';
$username = '';
$email    = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email']    ?? '');

    if ($username === '' || $email === '') {
        $message = 'Username dan email tidak boleh kosong.';
        $type    = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Format email tidak valid.';
        $type    = 'error';
    } else {
        $cekUser = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $cekUser->execute([$username]);
        if ($cekUser->fetch()) {
            $message = 'Username sudah terdaftar.';
            $type    = 'error';
        } else {
            $cekEmail = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $cekEmail->execute([$email]);
            if ($cekEmail->fetch()) {
                $message = 'Email sudah terdaftar.';
                $type    = 'error';
            } else {
                $pdo->prepare("INSERT INTO users (username, email) VALUES (?, ?)")
                    ->execute([$username, $email]);
                $message  = 'Data berhasil disimpan!';
                $type     = 'success';
                $username = '';
                $email    = '';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Data</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2 class="page-title">Create Data</h2>

    <?php if ($message): ?>
    <div class="alert alert-<?= $type === 'success' ? 'success' : 'danger' ?>">
        <?= htmlspecialchars($message) ?>
    </div>
    <?php endif; ?>

    <form method="POST" id="createForm" novalidate class="form-body">
        <div class="form-group">
            <label for="username">Name:</label>
            <input type="text" id="username" name="username"
                placeholder="Your name"
                value="<?= htmlspecialchars($username) ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                placeholder="Your email"
                value="<?= htmlspecialchars($email) ?>">
        </div>
        <button type="submit" class="btn-insert">Insert</button>
    </form>

    <nav class="nav-bar">
        <a href="create.php">CREATE</a>
        <a href="read.php">READ</a>
    </nav>
</div>

<div id="toast"></div>

<script>
    var phpMessage = <?= json_encode($message) ?>;
    var phpType    = <?= json_encode($type === 'success' ? 'success' : 'error') ?>;
</script>
<script src="../js/script.js"></script>
</body>
</html>