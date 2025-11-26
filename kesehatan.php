<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Self Health Check</title>
    <link rel="stylesheet" href="css/k.css">
</head>

<body>

    <div class="back">
        <a href="" class="btn btn-light btn-outline-dark">← Back</a>
    </div>

    <!-- FORM SECTION -->
    <div class="container" id="form-section">

        <h2 align="center">Self Health Check</h2>
        <p>Isi pelan-pelan ya (nama), silahkan isi sesuai kondisi kamu sekarang ❤️</p>

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
    <div class="container result" id="result-section">
        <h2>Hasil Kesehatanmu ❤️</h2>
        <p>Ini rangkuman kamu ya (nama).</p>

        <div class="score-box">
            <h3>Total Skor:</h3>
            <p id="totalScore"></p>
            <p id="kategoriFinal" style="font-weight:bold; color:#522B5B;"></p>
        </div>

        <h3>Kriteria Penilaian</h3>
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
        /* -----------------------------
            DATA PERTANYAAN
        ----------------------------- */
        const data = {
            tidur: [
                "Saya tidur 7–8 jam setiap malam.",
                "Saya tidur dan bangun di jam yang sama.",
                "Saya jarang begadang.",
                "Saya bangun dengan segar.",
                "Saya tidak memakai gadget 30 menit sebelum tidur.",
                "Saya jarang terbangun tengah malam.",
                "Saya bisa tidur tanpa kesulitan.",
                "Saya tidak tidur terlalu larut."
            ],
            makan: [
                "Saya sarapan sebelum memulai aktivitas.",
                "Saya makan 3 kali sehari teratur.",
                "Saya makan sayur setiap hari.",
                "Saya makan buah setiap hari.",
                "Saya mengurangi makanan tinggi gula.",
                "Saya menghindari junk food.",
                "Saya tidak makan berlebihan malam hari.",
                "Saya konsumsi protein cukup.",
                "Saya tidak sering ngemil tidak sehat.",
                "Saya mengatur porsi makan."
            ],
            fisik: [
                "Saya olahraga 3x seminggu.",
                "Saya berjalan kaki/aktivitas ringan setiap hari.",
                "Saya tidak duduk terlalu lama.",
                "Saya melakukan peregangan tubuh.",
                "Saya menjaga postur tubuh.",
                "Saya melakukan aktivitas rumah.",
                "Saya tidak sedentari seharian."
            ],
            hidrasi: [
                "Saya minum 6–8 gelas air.",
                "Saya batasi kopi/soda.",
                "Saya tidak merokok.",
                "Saya menjaga kebersihan tubuh.",
                "Saya punya waktu istirahat yang cukup."
            ]
        };

        const categories = ["tidur", "makan", "fisik", "hidrasi"];
        let flat = [];
        categories.forEach(c => data[c].forEach(q => flat.push(q)));

        let step = 0;
        let answers = Array(30).fill(null);

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
            <div>${flat[step]}</div>
            <div class="options">
                <label><input type="radio" name="answer" value="1" ${answers[step] == 1 ? 'checked' : ''}><span>Ya</span></label>
                <label><input type="radio" name="answer" value="0" ${answers[step] == 0 ? 'checked' : ''}><span>Tidak</span></label>
            </div>
            `;
                questionBox.classList.add("show");
            }, 150);

            let catIndex = step < 8 ? 0 : step < 18 ? 1 : step < 25 ? 2 : 3;
            const titles = ["A. Pola Tidur", "B. Pola Makan", "C. Aktivitas Fisik", "D. Hidrasi"];
            categoryTitle.innerHTML = titles[catIndex];

            stepText.innerHTML = `Step ${step + 1} / 30`;
            progressBar.style.width = ((step + 1) / 30 * 100) + "%";
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
    </script>

</body>

</html>