<?php
session_start();
require '../config/koneksi.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $sql = mysqli_query($connect, $query);

    $data = mysqli_num_rows($sql);
    if (mysqli_num_rows($sql) == 1) {
        $user = mysqli_fetch_assoc($sql);

        $_SESSION['status'] = "sudah login";
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['nama_lengkap'];

        header("Location: ../dashboard.php");
        exit;
    } else {
        header("Location: ../index.php?pesan=gagal_login");
        exit;
    }
}

if (isset($_POST['register'])) {
    $nama     = $_POST['namaLengkap'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $konfir   = $_POST['confirmPassword'];
    $usia     = $_POST['usia'];
    $jenkel   = $_POST['jenKel'];

    if ($password != $konfir) {
        header("Location: ../index.php?pesan=password_tidak_sama&mode=register");
        exit;
    }

    $cek = mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        header("Location: ../index.php?pesan=email_sudah_ada&mode=register");
        exit;
    }

    $query = "INSERT INTO users (nama_lengkap, jenis_kelamin, email, password, usia)
              VALUES ('$nama', '$jenkel', '$email', '$password', '$usia')";

    mysqli_query($connect, $query);

    header("Location: ../index.php?pesan=register_berhasil");
    exit;
}
?>