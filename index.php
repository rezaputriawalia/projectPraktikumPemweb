<?php 
require "components/component.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login / Registrasi</title>

    <link rel="stylesheet" href="css/index.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php
            if (isset($_GET['pesan'])) {
                listAlert($_GET['pesan']);
            }
        ?>
        <!-- <div class="alert alert-danger" role="alert">
            Error : Password tidak sama
        </div> -->
        <div class="form-container login-container">
            <form action="logic/auth.php" method="POST" autocomplete="off">
                <h1>Login</h1>
                <input autocomplete="off" type="email" placeholder="Email" name="email" required>
                <input autocomplete="new-password" type="password" placeholder="Password" name="password" required>
                <!-- <div class="content">
                    <div class="checkbox">
                        <input type="checkbox" id="checkbox">
                        <label for="checkbox">Ingat Saya</label>
                    </div> -->
                    <!-- <div class="pass-link">
                        <a href="#">Forgot password?</a>
                    </div> -->
                <!-- </div> -->
                <!-- <button type="button" onclick="window.location.href='dashboard.php'">Login</button> -->
                <button type="submit" name="login">Login</button>
                <div class="text-center small">
                Belum Punya Akun? <br> Silahkan registrasi terlebih dahulu!
                </div>
                <!-- <span>or use your account</span>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-linkedin"></i></a>
                </div> -->
            </form>
        </div>

        <div class="form-container register-container">
            <form action="logic/auth.php" method="POST" autocomplete="off">
                <h1>Register</h1>
                <input  autocomplete="off" type="text" name="namaLengkap" placeholder="Nama Lengkap">
                <input  autocomplete="off" type="email" name="email" placeholder="Email">
                <input  autocomplete="new-password" type="password" name="password" placeholder="Password">
                <input  autocomplete="new-password" type="password" name="confirmPassword" placeholder="Konfirmasi Password">
                <input  autocomplete="off" type="number" name="usia" placeholder="Usia">
                <select class="select-gender" name="jenKel">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option name="jenKel" value="Laki-laki">Laki-laki</option>
                    <option name="jenKel" value="Perempuan">Perempuan</option>
                </select>
                <!-- <button type="button" onclick="window.location.href='dashboard.php'">Register</button> -->
                <button type="submit" name="register">Register</button>
                
                <!-- <span>or use your account</span>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-linkedin"></i></a>
                </div> -->
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Selamat Datang!</h1>
                    <p>Silahkan login, untuk mengakses fitur kami!</p>
                    <button class="ghost" id="login"> Login <i class="fa-solid fa-arrow-left arrow-left"></i>
                    </button>
                </div>

                <div class="overlay-panel overlay-right">
                    <h1 class="title">Wujudkan hidup sehatmu hari ini</h1>
                    <p>Daftar sekarang untuk mengakses fitur pemantauan kesehatan dan mulai langkah menuju tubuh yang lebih sehat.</p>
                    <button class="ghost" id="register"> Register <i class="fa-solid fa-arrow-right arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script src="js/index.js"></script>

</body>
</html>