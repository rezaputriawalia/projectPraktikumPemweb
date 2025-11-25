<?php
session_start();
include "config/koneksi.php";

// sementara pake fake user login id (kalau sudah ada session tinggal ganti $_SESSION['user_id'])
$user_id = $_SESSION['user_id'] ?? 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/inistylemood.css">

    <title>Mood Tracker</title>
</head>

<body>

    <div class="dashboard">
        <a href="dashboard.php" class="btn btn-light btn-outline-dark">← Back</a>
    </div>

    <div class="container">
        <!-- Navigation Tabs -->
        <div class="nav-tabs">
            <button class="tab active" onclick="switchTab('jar', this)">Mood Jar</button>
            <button class="tab" onclick="switchTab('history', this)">History</button>
            <button class="tab" onclick="switchTab('stats', this)">Analytics</button>
        </div>

        <!-- PAGE: Mood Jar -->
        <div id="jar-page" class="page active">
            <h1>Mood Jar</h1>
            <p class="subtitle">Isi jar kamu hari ini 🍯✨</p>

            <div class="card mood-card">
                <div class="card-body position-relative">
                    <div id="jar">
                        <div id="stars"></div>
                    </div>
                </div>
            </div>

            <div style="text-align:center; margin-top:15px;">
                <button onclick="showForm()" style="width:200px;">Tambah Mood</button>
            </div>
        </div>

        <!-- PAGE: Form -->
        <div id="form-section" class="page" style="display:none;">
            <h1>Catatan Mood</h1>

            <label>Pilih Mood:</label>
            <select id="moodSelect">
                <option value="great">Great ⭐</option>
                <option value="good">Good 😊</option>
                <option value="average">Average 😐</option>
                <option value="bad">Bad 😕</option>
            </select>

            <label>Tulis perasaanmu hari ini:</label>
            <textarea id="moodNote" placeholder="Contoh: Hari ini aku capek tapi bangga sama diri sendiri..."></textarea>

            <button onclick="submitMood()">Simpan</button>
        </div>

        <!-- PAGE: History -->
        <div id="history-page" class="page">
            <h1>Riwayat Mood</h1>
            <ul id="history-list"></ul>
        </div>

        <!-- PAGE: Statistics -->
        <div id="stats-page" class="page">
            <h1>Analisa Mood</h1>
            <canvas id="chartMood" style="width:100%; height:260px;"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const userId = <?= $user_id ?>;
        let chartMood = null; // supaya chart bisa di-destroy sebelum render ulang

        function switchTab(page, el) {
            document.querySelectorAll(".page").forEach(p => p.style.display = "none");
            document.querySelectorAll(".tab").forEach(t => t.classList.remove("active"));

            document.getElementById(`${page}-page`).style.display = "block";
            el.classList.add("active");

            if (page === "history") loadHistory();
            if (page === "stats") updateChart();
        }

        function showForm() {
            document.querySelectorAll(".page").forEach(p => p.style.display = "none");
            document.getElementById('form-section').style.display = 'block';
        }

        function submitMood() {
            const mood = document.getElementById("moodSelect").value;
            const note = document.getElementById("moodNote").value;

            if (note.trim() === "") return alert("Isi dulu ya 🫶");

            fetch("logic/logicmood.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `user_id=${userId}&mood=${mood}&note=${note}`
                })
                .then(() => {
                    loadStars();
                    document.getElementById("moodNote").value = "";
                    switchTab("jar", document.querySelectorAll(".tab")[0]);
                });
        }

        function loadHistory() {
            fetch(`logic/logicmood.php?user_id=${userId}`)
                .then(res => res.json())
                .then(data => {
                    const list = document.getElementById("history-list");
                    list.innerHTML = "";

                    if (data.length === 0) {
                        list.innerHTML = `<li style="text-align:center; opacity:.7;">Belum ada mood yang disimpan 😌</li>`;
                        return;
                    }

                    data.forEach(entry => {
                        list.innerHTML += `
                    <li>
                        <strong>${entry.created_at}</strong><br>
                        <b>${entry.mood}</b> — ${entry.note}
                    </li>`;
                    });
                });
        }

        function loadStars() {
            fetch(`logic/logicmood.php?user_id=${userId}`)
                .then(res => res.json())
                .then(data => {
                    const jar = document.getElementById("stars");
                    jar.innerHTML = "";

                    data.forEach(entry => addStar(entry.mood));
                });
        }

        function addStar(mood) {
            const jar = document.getElementById("stars");
            const star = document.createElement("div");

            star.className = `star ${mood}`;
            star.innerHTML = "★";

            star.style.top = Math.random() * 160 + "px";
            star.style.left = Math.random() * 140 + "px";

            jar.appendChild(star);
        }

        function updateChart() {
            fetch(`logic/logicmood.php?user_id=${userId}`)
                .then(res => res.json())
                .then(data => {
                    const ctx = document.getElementById("chartMood");

                    const counts = {
                        great: data.filter(m => m.mood === "great").length,
                        good: data.filter(m => m.mood === "good").length,
                        average: data.filter(m => m.mood === "average").length,
                        bad: data.filter(m => m.mood === "bad").length
                    };

                    if (chartMood !== null) chartMood.destroy();

                    chartMood = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: ["Great", "Good", "Average", "Bad"],
                            datasets: [{
                                label: "Jumlah Mood",
                                data: Object.values(counts),
                                backgroundColor: ["#522B5B", "#854F6C", "#DFB6B2", "#5f3a3a"]
                            }]
                        }
                    });
                });
        }

        document.addEventListener("DOMContentLoaded", loadStars);
    </script>


</body>

</html>