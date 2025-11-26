<?php
session_start();
require "../config/koneksi.php";

if (!isset($_SESSION['username']) || !isset($_SESSION['id_user'])) {
    header("Location: ../index.php?pesan=login_dulu");
    exit();
}

$id_user = $_SESSION['id_user'];

// Pastikan jawaban dikirim sebagai array via POST
if (!isset($_POST['answers']) || !is_array($_POST['answers'])) {
    die("Data jawaban tidak valid.");
}

$answers = $_POST['answers'];
$totalScore = array_sum($answers);

// Tentukan kategori
if ($totalScore <= 20) $ket = "Kecemasan Rendah / Ringan";
elseif ($totalScore <= 40) $ket = "Ringan – Sedang";
elseif ($totalScore <= 60) $ket = "Sedang – Cukup Berat";
else $ket = "Cemas Berat / Signifikan";

// Escape string supaya aman
$ket_safe = mysqli_real_escape_string($connect, $ket);

// Simpan ke tabel test
$query = "INSERT INTO test (skortotal, ket, id_user) VALUES ($totalScore, '$ket_safe', $id_user)";
mysqli_query($connect, $query);
$id_test = mysqli_insert_id($connect);

// Simpan jawaban ke detailtest
foreach ($answers as $i => $score) {
    $id_question = $i + 1; // asumsi urutan 1-30
    $query2 = "INSERT INTO detailtest (id_question, skor, id_test) VALUES ($id_question, $score, $id_test)";
    mysqli_query($connect, $query2);
}

$connect->close();

// Redirect ke halaman hasil
header("Location: ../hasil.php?id_test=$id_test");
exit();
