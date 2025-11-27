<?php 
require "config/koneksi.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php?pesan=login_dulu");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="css/test.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
    <div class="back">
        <a href="dashboard.php" class="btn btn-light btn-outline-dark">← Back</a>
    </div>
    <div class="container">
        <div class="judul">
            <h1>Yuk, Test Kebiasaan dan Kecemasanmu!</h1>
        </div>
        <div class="card-wrapper">
            <div class="card">
                <img src="asset/image/sehat.png" class="iconTest" alt="">
                <div class="card-body">
                    <h3>Test Pola Hidup Sehat</h3>
                    <p>Pilih test ini biar kamu tau seberapa sehat hidupmu!</p>
                    <a href="kesehatan.php"><button type="button">Mulai Test</button></a>
                </div>
            </div>
            <div class="card">
                <img src="asset/image/cemas.png" class="iconTest" alt="">
                <div class="card-body">
                    <h3>Test Kecemasan</h3>
                    <p>Kenali sinyal kecemasan dalam dirimu dan pahami bagaimana perasaanmu belakangan ini!</p>
                    <a href="kecemasan.php"><button type="button">Mulai Test</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>