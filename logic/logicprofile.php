<?php
session_start();
include "../config/koneksi.php";

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $koneksi->prepare("UPDATE users SET name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $user_id);
    $stmt->execute();
    
    $_SESSION['message'] = "Profil berhasil diperbarui!";
    header("Location: ../editprofil.php");
    exit;
}
?>
