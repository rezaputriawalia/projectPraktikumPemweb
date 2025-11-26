<?php 
require "config/koneksi.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php?pesan=login_dulu");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Refleksi Kecemasan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/kc.css">

</head>

<body>
    <div class="back">
        <a href="test.php" class="btn btn-light btn-outline-dark">← Back</a>
    </div>

    <div class="container" id="form-section">
        <h2 align="center">Tes Refleksi Kecemasan 🧠</h2>
        <p>Jawab dengan jujur ya. Ini bukan diagnosis, hanya refleksi awal buat kamu. 🤍</p>

        <div id="stepText">Step 1 / 30</div>

        <div class="progress-wrapper">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <h3 id="categoryTitle">A. Pikiran & Kekhawatiran</h3>

        <div class="question-box" id="questionBox"></div>

        <div class="btn-area">
            <button onclick="prevStep()">Back</button>
            <button onclick="nextStep()">Next</button>
        </div>
    </div>

    <!-- HASIL -->
    <div class="container result" id="result-section">
        <h2>Hasil Tes Refleksi Kamu ❤️</h2>
        <p>Ingat ya, ini hanya alat refleksi — bukan diagnosis.</p>

        <canvas id="circleChart"></canvas>

        <div class="score-box">
            <h3>Total Skor:</h3>
            <p id="totalScore"></p>
            <p id="kategoriFinal" style="font-weight:bold; color:#8A2BE2;"></p>
        </div>

        <div id="motivasiText" style="margin-top:10px;"></div>

        <h3>Keterangan Penilaian</h3>
        <table>
            <tr>
                <th>Skor</th>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td>0–20</td>
                <td>Kecemasan rendah / ringan</td>
            </tr>
            <tr>
                <td>21–40</td>
                <td>Ringan – sedang</td>
            </tr>
            <tr>
                <td>41–60</td>
                <td>Sedang – cukup berat</td>
            </tr>
            <tr>
                <td>61–90</td>
                <td>Cemas berat / signifikan</td>
            </tr>
        </table>

        <br>
        <h3>⚠️ CATATAN penting (Anti Self-Diagnose)</h3>
        <p>Hasil ini bukan diagnosis medis/psikologis.</p>
        <p>Kalau gejala mengganggu hidupmu, konsultasi ke:</p>
        <ul>
            <li>Psikolog Klinis (Puskesmas / RS)</li>
            <li>Halodoc / Riliv / Bicarakan.id</li>
            <li>Psikiater bila gejala fisik & intensitasnya sangat berat</li>
        </ul>

        <br>
        <button onclick="location.reload()">Ulangi Tes</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        /* -------------------------------------
    DATA PERTANYAAN (30)
------------------------------------- */
        const questions = [
            // A. Pikiran & Kekhawatiran
            "Saya sulit mengontrol kekhawatiran yang muncul tiba-tiba.",
            "Saya sering khawatir berlebihan terhadap hal kecil.",
            "Saya sulit berhenti memikirkan kemungkinan buruk.",
            "Pikiran saya terasa ‘lari cepat’ dan tidak mau diam.",
            "Saya merasa takut terjadi sesuatu padahal tidak ada alasan jelas.",
            "Saya sering merasa perlu memeriksa sesuatu berulang kali karena takut salah.",
            "Saya mudah terpicu rasa cemas oleh situasi sosial atau tekanan kecil.",

            // B. Emosi
            "Saya merasa gelisah tanpa penyebab jelas.",
            "Saya mudah tegang atau tersinggung.",
            "Saya merasa takut gagal terus-menerus.",
            "Saya sering merasa tidak aman atau overthinking.",
            "Saya takut membuat kesalahan.",
            "Saya sulit menikmati hal karena kecemasan.",

            // C. Fisik
            "Saya sering merasakan detak jantung cepat.",
            "Saya berkeringat dingin / tangan gemetar.",
            "Saya mengalami sesak napas saat cemas.",
            "Saya merasakan ketegangan otot.",
            "Saya sulit tidur karena pikiran.",
            "Saya merasa lemas/mudah capek.",
            "Saya sering sakit perut atau mual.",
            "Saya mudah kaget (startled).",

            // D. Perilaku
            "Saya menghindari situasi yang membuat cemas.",
            "Saya menunda banyak hal karena takut hasil buruk.",
            "Saya sulit fokus.",
            "Saya sering membutuhkan reassurance dari orang lain.",
            "Saya sulit ambil keputusan kecil.",
            "Saya tidak nyaman di keramaian.",
            "Saya sulit memulai aktivitas karena overwhelmed.",

            // E. Dampak
            "Kecemasan menurunkan produktivitas saya.",
            "Kecemasan mengganggu hubungan sosial saya."
        ];

        let answers = Array(30).fill(null);
        let step = 0;

        const categoryNames = [
            "A. Pikiran & Kekhawatiran",
            "B. Emosi & Perasaan",
            "C. Reaksi Fisik",
            "D. Perilaku",
            "E. Dampak Kehidupan"
        ];

        function getCategory(step) {
            if (step < 7) return categoryNames[0];
            if (step < 13) return categoryNames[1];
            if (step < 21) return categoryNames[2];
            if (step < 28) return categoryNames[3];
            return categoryNames[4];
        }

        const questionBox = document.getElementById("questionBox");
        const categoryTitle = document.getElementById("categoryTitle");
        const stepText = document.getElementById("stepText");
        const progressBar = document.getElementById("progressBar");

        /* ------------------------ RENDER ------------------------ */
        function renderQuestion() {
            questionBox.classList.remove("show");

            setTimeout(() => {
                questionBox.innerHTML = `
            <div>${questions[step]}</div>
            <div class="options">
                <label><input type="radio" name="answer" value="0" ${answers[step] == 0 ? "checked" : ""}> 0 - Tidak Pernah</label>
                <label><input type="radio" name="answer" value="1" ${answers[step] == 1 ? "checked" : ""}> 1 - Kadang</label>
                <label><input type="radio" name="answer" value="2" ${answers[step] == 2 ? "checked" : ""}> 2 - Sering</label>
                <label><input type="radio" name="answer" value="3" ${answers[step] == 3 ? "checked" : ""}> 3 - Hampir Setiap Hari</label>
            </div>
        `;
                questionBox.classList.add("show");
            }, 150);

            categoryTitle.innerHTML = getCategory(step);
            stepText.innerHTML = `Step ${step+1} / 30`;
            progressBar.style.width = ((step + 1) / 30) * 100 + "%";
        }

        renderQuestion();

        /* ------------------------ NEXT & BACK ------------------------ */
        function nextStep() {
            let val = document.querySelector('input[name="answer"]:checked');
            if (!val) return alert("Pilih salah satu dulu ya 🤍");

            answers[step] = Number(val.value);

            if (step < 29) {
                step++;
                renderQuestion();
            } else {
                showResult();
            }
        }

        function prevStep() {
            if (step > 0) {
                step--;
                renderQuestion();
            }
        }

        /* ------------------------ HASIL ------------------------ */
        function showResult() {
            let total = answers.reduce((a, b) => a + b, 0);

            let kategori =
                total <= 20 ? "Kecemasan Rendah / Ringan" :
                total <= 40 ? "Ringan – Sedang" :
                total <= 60 ? "Sedang – Cukup Berat" :
                "Cemas Berat / Signifikan";

            let motivasi = "";
            if (total <= 20) motivasi = "Kamu terlihat cukup stabil. Tetap jaga rutinitas sehat ya 🤍";
            else if (total <= 40) motivasi = "Ada tanda kecemasan ringan. Pelan-pelan, kamu aman. 🌱";
            else if (total <= 60) motivasi = "Gejala mulai terasa. Kamu layak dapat bantuan dan ruang untuk pulih. 🤍";
            else motivasi = "Intensitas cukup tinggi. Kamu nggak sendirian — psikolog bisa sangat membantu kamu. ❤️";

            document.getElementById("form-section").style.display = "none";
            document.getElementById("result-section").style.display = "block";

            document.getElementById("totalScore").innerHTML = total;
            document.getElementById("kategoriFinal").innerHTML = kategori;
            document.getElementById("motivasiText").innerHTML = motivasi;

            // Circle Chart
            new Chart(document.getElementById("circleChart"), {
                type: "doughnut",
                data: {
                    labels: ["Skor Kamu", "Sisa"],
                    datasets: [{
                        data: [total, 90 - total],
                        backgroundColor: ["#7D0A8B", "#FF8FAA"],
                        borderWidth: 0
                    }]
                },
                options: {
                    cutout: "60%"
                }
            });
        }
    </script>

</body>

</html>