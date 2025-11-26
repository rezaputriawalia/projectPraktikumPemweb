<?php
include "../config/koneksi.php";
session_start();

// Pastikan user login
if (!isset($_SESSION['id_user'])) {
    echo json_encode(["error" => "not_logged_in"]);
    exit;
}

$user_id = $_SESSION['id_user'];

// ================= POST: Simpan Mood =================
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $mood = isset($_POST['mood']) ? mysqli_real_escape_string($koneksi, trim($_POST['mood'])) : '';
    $note = isset($_POST['note']) ? mysqli_real_escape_string($koneksi, trim($_POST['note'])) : '';

    if ($mood === '' || $note === '') {
        echo json_encode(["error" => "invalid_input"]);
        exit;
    }

    $query = "INSERT INTO mood (user_id, mood, note) VALUES ($user_id, '$mood', '$note')";
    if (mysqli_query($koneksi, $query)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => mysqli_error($koneksi)]);
    }

    exit;
}

// ================= GET: Ambil Mood =================
if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $query = "SELECT * FROM mood WHERE user_id = $user_id ORDER BY created_at DESC";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $logs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $logs[] = $row;
        }
        echo json_encode($logs);
    } else {
        echo json_encode(["error" => mysqli_error($koneksi)]);
    }

    exit;
}
?>
