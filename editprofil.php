<?php
session_start();
require "config/koneksi.php";

// cek login
if (!isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['id_user'];

// ambil data user
$query = mysqli_query($connect, "SELECT * FROM users WHERE id_user='$user_id'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/p.css">
</head>

<body>

<div class="container">
    <h2>Edit Profil</h2>

    <form action="logic/logicedit.php" method="POST">
        <input type="hidden" name="user_id" value="<?= $user['id_user'] ?>">

        <label>Nama Lengkap</label>
        <input type="text" name="namaLengkap" 
               value="<?= htmlspecialchars($user['nama_lengkap']) ?>" required>

        <label>Email</label>
        <input type="email" name="email" 
               value="<?= htmlspecialchars($user['email']) ?>" required>

        <label>Usia</label>
        <input type="number" name="usia" 
               value="<?= htmlspecialchars($user['usia']) ?>" required>

        <label>Jenis Kelamin</label>
        <select name="jenKel" required>
            <option value="Laki-laki" 
                <?= $user['jenis_kelamin'] == "Laki-laki" ? "selected" : "" ?>>
                Laki-laki
            </option>
            <option value="Perempuan"
                <?= $user['jenis_kelamin'] == "Perempuan" ? "selected" : "" ?>>
                Perempuan
            </option>
        </select>

        <button type="submit" name="update">Simpan Perubahan</button>
    </form>

    <a href="dashboard.php" class="back">← Kembali</a>
</div>

</body>
</html>
