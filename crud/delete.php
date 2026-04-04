<?php
require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json');

$id = (int)($_GET['id'] ?? 0);

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID tidak valid.']);
    exit;
}

$cek = $pdo->prepare("SELECT id FROM users WHERE id = ?");
$cek->execute([$id]);
if (!$cek->fetch()) {
    echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan.']);
    exit;
}

$pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);

echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus.']);