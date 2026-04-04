<?php
require_once __DIR__ . '/../config/db.php';
$users = $pdo->query("SELECT * FROM users ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Data</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2 class="page-title">Read Data</h2>

    <?php if (count($users) > 0): ?>
    <div class="user-list">
        <?php foreach ($users as $u): ?>
        <div class="user-item">
            <div class="user-info">
                <div class="username"><?= htmlspecialchars($u['username']) ?></div>
                <div class="email"><?= htmlspecialchars($u['email']) ?></div>
            </div>
            <div class="user-actions">
                <a href="update.php?id=<?= $u['id'] ?>" class="btn btn-edit">Edit</a>
                <button class="btn btn-delete"
                    onclick="confirmDelete(<?= $u['id'] ?>, '<?= htmlspecialchars(addslashes($u['username'])) ?>')">
                    Delete
                </button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p class="empty-text">Belum ada data.</p>
    <?php endif; ?>

    <nav class="nav-bar">
        <a href="create.php">CREATE</a>
        <a href="read.php">READ</a>
    </nav>
</div>

<!-- Modal Delete -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal">
        <p id="modalText">Yakin ingin menghapus data ini?</p>
        <div class="modal-actions">
            <button class="btn btn-secondary" onclick="closeModal()">Batal</button>
            <button class="btn btn-delete" id="confirmDelBtn">Hapus</button>
        </div>
    </div>
</div>

<div id="toast"></div>

<script src="../js/script.js"></script>
</body>
</html>