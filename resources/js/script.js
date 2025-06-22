// Contoh data siswa, guru, dan rapor yang bisa di-load dari server atau localStorage
const students = [
    { id: 1, name: "Agus", class: "A", age: 5, nis: "PAUD-001" },
    { id: 2, name: "Azzoyla", class: "A", age: 5, nis: "PAUD-002" },
    { id: 3, name: "Budi", class: "A", age: 6, nis: "PAUD-003" },
    { id: 4, name: "Citra", class: "A", age: 5, nis: "PAUD-004" },
    { id: 5, name: "Agila", class: "B", age: 6, nis: "PAUD-005" },
    { id: 6, name: "Amaiyah", class: "B", age: 5, nis: "PAUD-006" },
    { id: 7, name: "Dito", class: "B", age: 6, nis: "PAUD-007" },
    { id: 8, name: "Eka", class: "B", age: 5, nis: "PAUD-008" },
];

// Contoh data guru
const teachers = {
    A: "Ibu Siti Khadijah, S.Pd",
    B: "Ibu Rina Wijaya, S.Pd",
};

// Fungsi ambil parameter URL
function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

// Fungsi validasi dan redirect jika data tidak lengkap
function validateParams(kelas, id) {
    if (!kelas || !id) {
        alert("Parameter tidak valid!");
        window.location.href = "index.html";
        return false;
    }
    return true;
}

// Fungsi cari siswa berdasarkan kelas dan id
function findStudent(kelas, id) {
    return students.find((s) => s.class === kelas && s.id == id);
}

// Fungsi update info siswa ke elemen HTML
function updateStudentInfo(student) {
    const container = document.querySelector(".student-info");
    if (!container) return;
    container.innerHTML = `
    <div class="flex flex-wrap gap-4">
      <div class="w-full md:w-1/2">
        <p><strong>Nama:</strong> ${student.name}</p>
        <p><strong>Kelas:</strong> Kelas ${student.class}</p>
      </div>
      <div class="w-full md:w-1/2">
        <p><strong>NIS:</strong> ${student.nis}</p>
        <p><strong>Usia:</strong> ${student.age} tahun</p>
      </div>
    </div>
  `;
}

// Fungsi load data rapor dari localStorage
function loadReportData(kelas, studentId) {
    const raw = localStorage.getItem(`rapor-${kelas}-${studentId}`);
    if (!raw) return null;
    return JSON.parse(raw);
}

// Fungsi tampilkan aspek perkembangan di tabel
function renderAspects(aspects) {
    const tbody = document.getElementById("aspects-table");
    if (!tbody) return;

    tbody.innerHTML = "";
    if (!aspects || aspects.length === 0) {
        tbody.innerHTML =
            '<tr><td colspan="4" class="text-center py-4">Tidak ada data perkembangan</td></tr>';
        return;
    }

    aspects.forEach(({ name, description, score, note }) => {
        const stars = score
            ? `<span class="text-yellow-400">${"★".repeat(score)}${"☆".repeat(
                  5 - score
              )}</span>`
            : "-";
        const tr = document.createElement("tr");
        tr.className = "hover:bg-gray-50";
        tr.innerHTML = `
      <td class="border px-4 py-2">${name}</td>
      <td class="border px-4 py-2">${description}</td>
      <td class="border px-4 py-2">${stars}</td>
      <td class="border px-4 py-2">${note || "-"}</td>
    `;
        tbody.appendChild(tr);
    });
}

// Fungsi tampilkan data rapor di halaman
function displayReport(reportData) {
    document.getElementById("special-notes").textContent =
        reportData.specialNotes || "-";
    document.getElementById("present-days").textContent =
        reportData.presentDays || "0";
    document.getElementById("sick-days").textContent =
        reportData.sickDays || "0";
    document.getElementById("permit-days").textContent =
        reportData.permitDays || "0";
    document.getElementById("absent-days").textContent =
        reportData.absentDays || "0";
    document.getElementById("predicate").textContent =
        reportData.predicate || "-";

    const present = parseInt(reportData.presentDays) || 0;
    const sick = parseInt(reportData.sickDays) || 0;
    const permit = parseInt(reportData.permitDays) || 0;
    const absent = parseInt(reportData.absentDays) || 0;
    const totalDays = present + sick + permit + absent;
    const attendancePercent =
        totalDays > 0 ? Math.round((present / totalDays) * 100) : 0;
    document.getElementById(
        "attendance-percent"
    ).textContent = `${attendancePercent}%`;

    renderAspects(reportData.aspects);
}

// Fungsi inisialisasi halaman
function init() {
    const kelas = getQueryParam("kelas");
    const studentId = getQueryParam("id");

    if (!validateParams(kelas, studentId)) return;

    const student = findStudent(kelas, studentId);
    if (!student) {
        alert("Siswa tidak ditemukan!");
        window.location.href = `siswa.html?kelas=${kelas}`;
        return;
    }

    updateStudentInfo(student);

    // Set wali kelas
    document.getElementById("homeroom-teacher").textContent =
        teachers[kelas] || "-";
    document.getElementById("class-group").textContent = kelas;

    // Tanggal laporan
    document.getElementById("report-date").textContent =
        new Date().toLocaleDateString("id-ID", {
            day: "numeric",
            month: "long",
            year: "numeric",
        });

    // Load dan tampilkan data rapor
    const reportData = loadReportData(kelas, student.id);
    if (reportData) {
        displayReport(reportData);
    } else {
        // Jika belum ada data rapor
        document.getElementById("aspects-table").innerHTML =
            '<tr><td colspan="4" class="text-center py-4">Rapor belum diisi</td></tr>';
        document.getElementById("special-notes").textContent =
            "Rapor belum diisi";
    }
}

// Fungsi tombol kembali
function goBack() {
    const kelas = getQueryParam("kelas");
    if (kelas) {
        window.location.href = `siswa.html?kelas=${kelas}`;
    } else {
        window.history.back();
    }
}

// Fungsi tombol edit rapor
function editReport() {
    const kelas = getQueryParam("kelas");
    const id = getQueryParam("id");
    if (kelas && id) {
        window.location.href = `rapor.html?kelas=${kelas}&id=${id}`;
    }
}

// Jalankan inisialisasi saat DOM siap
document.addEventListener("DOMContentLoaded", init);
