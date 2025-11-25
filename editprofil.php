<?php
session_start();
include "config/koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ambil data user
$result = $koneksi->query("SELECT * FROM users WHERE id='$user_id'");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Profil</title>
    <link rel="stylesheet" href="css/styleprofile.css">
</head>

<body>

    <div class="container">
        <h2>Edit Profil</h2>

        <form action="logic/logicprofile.php" method="POST">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">

            <label>Nama</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required>

            <label>Username</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <button type="submit" name="update">Simpan</button>
        </form>

        <a href="profile.php" class="back">← Kembali</a>
    </div>

</body>

</html>