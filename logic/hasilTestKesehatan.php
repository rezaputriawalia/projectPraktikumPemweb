<?php
require "../config/koneksi.php";
session_start();

// pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: index.php?pesan=login_dulu");
} else {
    $id_user = $_SESSION['id_user']; 
    
    $score = $_POST['score'] ?? null;
    
    if ($score === null) {
        echo "no_score";
        exit;
    }
    
    // Tentukan keterangan
    if ($score <= 10) {
        $ket = "Tidak Sehat";
    } elseif ($score <= 20) {
        $ket = "Kurang Sehat";
    } elseif ($score <= 25) {
        $ket = "Sehat";
    } else {
        $ket = "Sangat Sehat";
    }
    
    $sql = "INSERT INTO test (jenis_test, skortotal, ket, id_user) VALUES ('Pola Hidup Sehat', '$score', '$ket', '$id_user')";
    $query = mysqli_query($connect, $sql);
    
    echo $query ? "success" : "error";
}
?>
