<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styledashboardyaaa.css">
    <title>Dashboard UI</title>

</head>

<body>

    <div class="main">
        <div class="header">
            <div class="title">Welcome, (nama)
                <h5 style="width : 75%">Dari kelemahan hingga pencapaian, kami menemanimu dalam perjalanan menerima dan menyayangi diri sendiri sepenuhnya.</h5>
            </div>
            <div class="profil">
                <button class="profile-btn" onclick="toggleProfileMenu()">👤 Profil ▾</button>

                <div class="dropdown-menu" id="profileMenu">
                    <a href="editprofil.php">✏ Edit Profil</a> <br>
                    <a href="logout.php" class="logout">🚪 Logout</a>
                </div>
            </div>


        </div>


        <div class="cards">
            <div class="card">
                <img src="https://i0.wp.com/blog.gceasy.io/wp-content/uploads/2020/08/check1.png?fit=1200%2C628&ssl=1" class="card-img-top" alt="gambar">
                <div class="card-body">
                    <h4 class="card-title">Ayo Kenali Dirimu Melalui Tes Disini!</h4>
                    <p class="card-text">Belajar menerjemahkan bahasa rasa sakit dan kelelahan menjadi langkah-langkah nyata menuju pemulihan yang abadi.</p>
                    <a href="test.php" class="btn btn-primary">Mulai Tes</a>
                </div>
            </div>
            <div class="card">
                <img src="https://cdn.rri.co.id/berita/Samarinda/o/1712119787441-Baldwin-1-Easy-Ways-to-Boost-Your-Mood/plr93flttc9o8mo.jpeg" class="card-img-top" alt="gambar">
                <div class="card-body">
                    <h4 class="card-title">Catat Mood Harianmu!</h4>
                    <p class="card-text">Jangan Menunggu Badai Berlalu, Belajarlah Menari di Tengah Hujan.</p>
                    <a href="moodtracker.php" class="btn btn-primary">Catat Disini ^_^</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card" style="width: 24rem;">
                <img src="https://klinikkeluarga.com/assets/uploads/artikels/klinik-keluarga-pentingnya-gaya-hidup-sehat-menjaga-kesehatan-tubuh-dan-pikiran.jpg" class="card-img-top" alt="gambar">
                <div class="card-body">
                    <h4 class="card-title">Pola Hidup Sehat Remaja</h4>
                    <p class="card-text">Semua orang pasti ingin selalu hidup sehat dan terhindar dari berbagai penyakit. Sebab, dengan tubuh dan pikiran yang selalu sehat, seagala aktivitas yang kita kerjakan akan selesai lebih cepat.</p>
                    <a href="https://diskes.badungkab.go.id/artikel/51691-pola-hidup-sehat-remaja" class="btn btn-primary">Lihat Artikel</a>
                </div>
            </div>
            <div class="card" style="width: 24rem;">
                <img src="https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,f_auto,q_auto:best,w_640/v1636206945/a2sa6mniqh9yqulpchcu.jpg" class="card-img-top" alt="gambar">
                <div class="card-body">
                    <h4 class="card-title">Terlalu Sering Begadang, Ini Dampaknya pada Tubuh</h4>
                    <p class="card-text">Terlalu sering begadang membuat seseorang kurang tidur. Jika dilakukan sesekali saja tidak masalah. Namun jika terlalu sering, ada banyak sekali dampak kesehatan yang bisa saja terjadi. </p>
                    <a href="https://www.halodoc.com/artikel/terlalu-sering-begadang-ini-dampaknya-pada-tubuh?srsltid=AfmBOorbZlsYAPxWNBwPSj_6at7ElPf3OeaapVzIjxGWo8HqcgIz7wGa" class="btn btn-primary">Lihat Artikel</a>
                </div>
            </div>
            <div class="card" style="width: 24rem;">
                <img src="https://cdn.rri.co.id/berita/Ranai/o/1731256012401-KBRN_(4)_-_Images/tjgykyvbp6rcgs3.jpeg" class="card-img-top" alt="gambar">
                <div class="card-body">
                    <h4 class="card-title">Mood Swing belum Tentu Bipolar</h4>
                    <p class="card-text">Seseorang dapat dipertimbangkan bipolar jika mengalami gejala-gejala depresi, manik, atau hipomanik. Namun, selain keluhan yang ada saat ini, penting untuk mengetahui adanya episode mood di masa lalu beserta jumlah, frekuensi, intensitas dan durasinya.</p>
                    <a href="https://rs.ui.ac.id/umum/berita-artikel/artikel-populer/mood-swing-belum-tentu-bipolar" class="btn btn-primary">Lihat Artikel</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleProfileMenu() {
            const menu = document.getElementById("profileMenu");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        document.addEventListener("click", function(event) {
            const menu = document.getElementById("profileMenu");
            const btn = document.querySelector(".profile-btn");

            if (!btn.contains(event.target) && !menu.contains(event.target)) {
                menu.style.display = "none";
            }
        });
    </script>



</body>

</html>