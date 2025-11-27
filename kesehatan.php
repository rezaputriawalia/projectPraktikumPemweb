<?php
require "config/koneksi.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php?pesan=login_dulu");
}

$query = mysqli_query($connect,
"SELECT q.question, c.category 
     FROM questionkesehatan q 
     JOIN questioncategory c ON q.id_category = c.id_category
     ORDER BY q.id_question ASC"
);
$questions = [];

while ($row = mysqli_fetch_assoc($query)) {
    $questions[] = [
        "text" => $row['question'],
        "category" => $row['category']
    ];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>Self Health Check</title>
    <link rel="stylesheet" href="css/k.css">
</head>

<body>

    <div class="back">
        <a href="test.php" class="btn btn-light btn-outline-dark">← Back</a>
    </div>

    <!-- FORM SECTION -->
    <div class="container" id="form-section">

        <h2 align="center">Self Health Check</h2>
        <p>Isi pelan-pelan ya <?= $_SESSION['username'] ?>, silahkan isi sesuai kondisi kamu sekarang ❤️</p>

        <div class="step-text" id="stepText">Step 1 / 30</div>

        <div class="progress-wrapper">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <h3 id="categoryTitle">A. Pola Tidur</h3>

        <div class="question-box" id="questionBox"></div>

        <div class="btn-area">
            <button onclick="prevStep()">Back</button>
            <button onclick="nextStep()">Next</button>
        </div>
    </div>

    <!-- RESULT SECTION -->
    <!-- RESULT SECTION -->
    <div class="container result" id="result-section">
        <h2>Hasil Kesehatanmu ❤️</h2>
        <p>Ini rangkuman kamu ya <?= $_SESSION['username'] ?>.</p>
        
        <div class="score-box">
            <h3>Total Skor:</h3>
            <p id="totalScore"></p>
            <p id="kategoriFinal" style="font-weight:bold; color:#522B5B;"></p>
        </div>

        <!-- MOTIVATION TEXT -->
        <div class="motivasi" id="motivasiText"> </div>

        <h3>Keterangan Penilaian</h3>
        <table class="table-kriteria">
            <tr>
                <th>Skor</th>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td>0 – 10</td>
                <td>Tidak Sehat</td>
            </tr>
            <tr>
                <td>11 – 20</td>
                <td>Kurang Sehat</td>
            </tr>
            <tr>
                <td>21 – 25</td>
                <td>Sehat</td>
            </tr>
            <tr>
                <td>26 – 30</td>
                <td>Sangat Sehat</td>
            </tr>
        </table>

        <br>
        <button onclick="location.reload()">Ulangi Tes</button>
    </div>


    <script>
        const flat = <?php echo json_encode($questions); ?>;
        let step = 0;
        let answers = Array(flat.length).fill(null);
        /* -----------------------------
            DATA PERTANYAAN
        ----------------------------- */
        // const data = {
        //     tidur: [
        //         "Saya tidur 7–8 jam setiap malam.",
        //         "Saya tidur dan bangun di jam yang sama.",
        //         "Saya jarang begadang.",
        //         "Saya bangun dengan segar.",
        //         "Saya tidak memakai gadget 30 menit sebelum tidur.",
        //         "Saya jarang terbangun tengah malam.",
        //         "Saya bisa tidur tanpa kesulitan.",
        //         "Saya tidak tidur terlalu larut."
        //     ],
        //     makan: [
        //         "Saya sarapan sebelum memulai aktivitas.",
        //         "Saya makan 3 kali sehari teratur.",
        //         "Saya makan sayur setiap hari.",
        //         "Saya makan buah setiap hari.",
        //         "Saya mengurangi makanan tinggi gula.",
        //         "Saya menghindari junk food.",
        //         "Saya tidak makan berlebihan malam hari.",
        //         "Saya konsumsi protein cukup.",
        //         "Saya tidak sering ngemil tidak sehat.",
        //         "Saya mengatur porsi makan."
        //     ],
        //     fisik: [
        //         "Saya olahraga 3x seminggu.",
        //         "Saya berjalan kaki/aktivitas ringan setiap hari.",
        //         "Saya tidak duduk terlalu lama.",
        //         "Saya melakukan peregangan tubuh.",
        //         "Saya menjaga postur tubuh.",
        //         "Saya melakukan aktivitas rumah.",
        //         "Saya tidak sedentari seharian."
        //     ],
        //     hidrasi: [
        //         "Saya minum 6–8 gelas air.",
        //         "Saya batasi kopi/soda.",
        //         "Saya tidak merokok.",
        //         "Saya menjaga kebersihan tubuh.",
        //         "Saya punya waktu istirahat yang cukup."
        //     ]
        // };

        // const categories = ["tidur", "makan", "fisik", "hidrasi"];
        // let flat = [];
        // categories.forEach(c => data[c].forEach(q => flat.push(q)));

        // let step = 0;
        // let answers = Array(30).fill(null);

        const questionBox = document.getElementById("questionBox");
        const categoryTitle = document.getElementById("categoryTitle");
        const stepText = document.getElementById("stepText");
        const progressBar = document.getElementById("progressBar");
        const formSection = document.getElementById("form-section");
        const resultSection = document.getElementById("result-section");

        /* -----------------------------
            RENDER PERTANYAAN
        ----------------------------- */
        function renderQuestion() {
            questionBox.classList.remove("show");

            setTimeout(() => {
                questionBox.innerHTML = `
            <div>${flat[step].text}</div>
            <div class="options">
                <label><input type="radio" name="answer" value="1" ${answers[step] == 1 ? 'checked' : ''}><span>Ya</span></label>
                <label><input type="radio" name="answer" value="0" ${answers[step] == 0 ? 'checked' : ''}><span>Tidak</span></label>
            </div>
            `;
                questionBox.classList.add("show");
            }, 150);

            let catIndex = step < 8 ? 0 : step < 18 ? 1 : step < 25 ? 2 : 3;
            const titles = ["A. Pola Tidur", "B. Pola Makan", "C. Aktivitas Fisik", "D. Hidrasi"];
            categoryTitle.innerHTML = flat[step].category;

            // stepText.innerHTML = `Step ${step + 1} / 30`;
            // progressBar.style.width = ((step + 1) / 30 * 100) + "%";
            stepText.innerHTML = `Step ${step + 1} / ${flat.length}`;
            progressBar.style.width = ((step + 1) / flat.length * 100) + "%";
        }

        renderQuestion();

        /* -----------------------------
            NEXT & BACK
        ----------------------------- */
        function nextStep() {
            let val = document.querySelector('input[name="answer"]:checked');
            if (!val) return alert("Pilih salah satu dulu ya ❤️");

            answers[step] = Number(val.value);

            if (step < 29) {
                step++;
                renderQuestion();
            } else showResult();
        }

        function prevStep() {
            if (step > 0) {
                step--;
                renderQuestion();
            }
        }

        /* -----------------------------
            HITUNG HASIL
        ----------------------------- */
        function showResult() {
            let total = answers.reduce((a, b) => a + b, 0);

            let kategori =
                total <= 10 ? "Tidak Sehat" :
                total <= 20 ? "Kurang Sehat" :
                total <= 25 ? "Sehat" :
                "Sangat Sehat";

            formSection.style.display = "none";
            resultSection.style.display = "block";

            document.getElementById("totalScore").innerHTML = total;
            document.getElementById("kategoriFinal").innerHTML = kategori;
        }

        function showResult() {
            let total = answers.reduce((a, b) => a + b, 0);

            let kategori =
                total <= 10 ? "Tidak Sehat" :
                total <= 20 ? "Kurang Sehat" :
                total <= 25 ? "Sehat" :
                "Sangat Sehat";

            // Motivasi berdasarkan kategori
            let motivasi = "";
            if (total <= 10) {
                motivasi = "Kamu lagi butuh perhatian ekstra nih. Pelan-pelan ya, kamu tetap berharga dan masih bisa jauh lebih baik dari ini. 🤍";
            } else if (total <= 20) {
                motivasi = "Kamu sudah berusaha, tapi masih ada beberapa hal yang perlu dirapikan. Satu langkah kecil setiap hari itu cukup, jangan keras sama diri sendiri. 🌱";
            } else if (total <= 25) {
                motivasi = "Kondisimu cukup baik! Pertahankan ritme sehat kamu dan terus dengarkan tubuhmu. Kamu hebat. 💪💖";
            } else {
                motivasi = "Kamu berada dalam kondisi yang sangat baik! Jaga pola hidupmu ya, kamu lagi ada di jalur yang benar banget. ✨";
            }

            formSection.style.display = "none";
            resultSection.style.display = "block";

            document.getElementById("motivasiText").innerHTML = `<p>${motivasi}</p>`;
            document.getElementById("totalScore").innerHTML = total;
            document.getElementById("kategoriFinal").innerHTML = kategori;

            saveToDatabase(total, kategori);
        }

        function saveToDatabase(total, kategori) {
            const formData = new FormData();
            formData.append("score", total);
            formData.append("keterangan", kategori);

            fetch("logic/hasilTestKesehatan.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(res => console.log("Server:", res))
            .catch(err => console.error(err));
        }
    </script>

</body>

</html>