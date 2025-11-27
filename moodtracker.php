<?php
session_start();
include "config/koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id_user'];

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $connect->query("DELETE FROM mood WHERE id_mood = $delete_id AND id_user = $user_id");
    header("Location: moodtracker.php"); // refresh halaman
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $mood = $_POST['mood'] ?? '';
    $note = $_POST['note'] ?? '';

    if ($mood && $note) {
        $mood = $connect->real_escape_string($mood);
        $note = $connect->real_escape_string($note);
        $connect->query("INSERT INTO mood (id_user, mood, note) VALUES ($user_id, '$mood', '$note')");
        header("Location: moodtracker.php"); // refresh setelah insert
        exit;
    }
}

// Ambil data mood user
$result = $connect->query("SELECT * FROM mood WHERE id_user = $user_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Tracker Simple</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/inistylemood.css">
</head>
<body>
<div class="back">
    <a href="dashboard.php" class="btn btn-light btn-outline-dark">← Back</a>
</div>
<br><br>

<div class="container">
    <h2>Mood Tracker</h2>
    <form method="POST">
        <label>Pilih Mood:</label>
        <select name="mood" class="form-select mb-3" required>
            <option value="">-- Pilih Mood --</option>
            <option value="great">Great ⭐</option>
            <option value="good">Good 😊</option>
            <option value="average">Average 😐</option>
            <option value="bad">Bad 😕</option>
        </select>

        <label>Catatan:</label>
        <textarea name="note" class="form-control mb-3" rows="3" placeholder="Tulis perasaanmu..." required></textarea>

        <button type="submit" class="btn btn-primary w-100">Simpan Mood</button>
    </form>

    <hr>
    <h4>Riwayat Mood</h4>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="history-item d-flex justify-content-between align-items-start">
                <div>
                    <span class="mood-tag"><?= htmlspecialchars($row['mood']) ?></span><br>
                    <?= nl2br(htmlspecialchars($row['note'])) ?><br>
                    <small><?= $row['created_at'] ?></small>
                </div>
                <div>
                    <a href="moodtracker.php?delete_id=<?= $row['id_mood'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Yakin mau hapus mood ini?')">Hapus</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Belum ada mood tersimpan 😌</p>
    <?php endif; ?>
</div>
</body>
</html>