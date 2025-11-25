<?php
include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $user_id = $_POST['user_id'];
    $mood = $_POST['mood'];
    $note = $_POST['note'];

    $stmt = $koneksi->prepare("INSERT INTO mood (user_id, mood, note) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $mood, $note);
    $stmt->execute();

    echo "success";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['user_id'])) {

    $user_id = $_GET['user_id'];
    $result = $koneksi->query("SELECT * FROM mood WHERE user_id='$user_id' ORDER BY created_at DESC");

    $logs = [];
    while ($row = $result->fetch_assoc()) {
        $logs[] = $row;
    }

    echo json_encode($logs);
}
?>
