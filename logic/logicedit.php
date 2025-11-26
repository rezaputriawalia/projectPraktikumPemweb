<?php
session_start();
require "../config/koneksi.php";

if (isset($_POST['update'])) {

    $id      = $_POST['user_id'];
    $nama    = $_POST['namaLengkap'];
    $email   = $_POST['email'];
    $usia    = $_POST['usia'];
    $jenkel  = $_POST['jenKel'];

    $query = "
        UPDATE users SET 
        nama_lengkap='$nama',
        email='$email',
        usia='$usia',
        jenis_kelamin='$jenkel'
        WHERE id_user='$id'
    ";

    mysqli_query($connect, $query);

    header("Location: ../dashboard.php?pesan=profil_updated");
    exit();
}
