@extends('layouts.app')

@section('title', 'Nilai Rapot')

@section('content')
<div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">

    <!-- Bagian Daftar Kelas -->
    <div id="daftar-kelas">
        <h1 class="text-2xl font-semibold text-indigo-600 mb-2">Daftar Kelas</h1>
        <p class="text-gray-600 dark:text-gray-300 mb-6">Pilih kelas untuk melihat nilai rapot siswa</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <!-- Card Kelas A -->
            <div
                class="card bg-white dark:bg-gray-700 rounded-lg p-4 border border-gray-300 dark:border-gray-600 cursor-pointer flex flex-col justify-between transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:border-indigo-500">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-icons text-indigo-600">school</span>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Kelas A</h2>
                    </div>
                    <p class="dark:text-gray-300"><span class="font-semibold">Usia:</span> 4–5 Tahun</p>
                    <p class="dark:text-gray-300"><span class="font-semibold">Wali Kelas:</span> Ibu Siti Khadijah, S.Pd
                    </p>
                    <p class="dark:text-gray-300"><span class="font-semibold">Jumlah Siswa:</span> 4</p>
                    <p class="dark:text-gray-300"><span class="font-semibold">Lokasi:</span> Ruang Melati</p>
                </div>
                <div class="flex justify-end mt-4">
                    <button onclick="showSiswa('A')"
                        class="bg-indigo-500 text-white px-4 py-2 rounded flex items-center gap-1 hover:bg-indigo-600 transition-colors duration-300">
                        <span class="material-icons text-sm">chevron_right</span> Lihat Nilai
                    </button>
                </div>
            </div>

            <!-- Card Kelas B -->
            <div
                class="card bg-white dark:bg-gray-700 rounded-lg p-4 border border-gray-300 dark:border-gray-600 cursor-pointer flex flex-col justify-between transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:border-indigo-500">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-icons text-indigo-600">school</span>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Kelas B</h2>
                    </div>
                    <p class="dark:text-gray-300"><span class="font-semibold">Usia:</span> 5–6 Tahun</p>
                    <p class="dark:text-gray-300"><span class="font-semibold">Wali Kelas:</span> Ibu Rina Wijaya, S.Pd
                    </p>
                    <p class="dark:text-gray-300"><span class="font-semibold">Jumlah Siswa:</span> 4</p>
                    <p class="dark:text-gray-300"><span class="font-semibold">Lokasi:</span> Ruang Anggrek</p>
                </div>
                <div class="flex justify-end mt-4">
                    <button onclick="showSiswa('B')"
                        class="bg-indigo-500 text-white px-4 py-2 rounded flex items-center gap-1 hover:bg-indigo-600 transition-colors duration-300">
                        <span class="material-icons text-sm">chevron_right</span> Lihat Nilai
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Daftar Siswa -->
    <div id="daftar-siswa" class="hidden">
        <div class="flex justify-between items-center mb-4">
            <h2 id="judul-kelas" class="text-xl font-semibold text-gray-700 dark:text-gray-200"></h2>
            <div class="flex gap-2">
                <button onclick="openModalTambahSiswa()"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">+ Tambah Siswa</button>
                <button onclick="backToKelas()"
                    class="bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-lg">Kembali</button>
            </div>
        </div>
        <div class="mb-6">
            <input type="text" id="searchInput" placeholder="Cari siswa..."
                class="w-full p-3 rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200" />
        </div>
        <!-- Notes untuk mencetak Rapot Siswa -->
        <div class="bg-indigo-200 text-indigo-800 p-3 rounded-lg text-center mb-6 shadow-sm">
            <p class="font-medium">Peringatan! Untuk mencetak Rapot Siswa diharapkan menggunakan tampilan <span
                    class="font-bold">Light Mode</span></p>
        </div>
        <div id="student-cards" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
    </div>

    <!-- Modal Tambah Siswa -->
    <div id="modalTambahSiswa"
        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-96">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-4">Tambah Siswa</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 dark:text-gray-200 mb-1">Nama</label>
                    <input type="text" id="modalStudentName"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-200 mb-1">NISN</label>
                    <input type="text" id="modalStudentNISN"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-200 mb-1">Usia</label>
                    <input type="number" id="modalStudentAge" min="1"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                </div>
            </div>
            <div class="flex justify-end mt-6 gap-2">
                <button onclick="closeModalTambahSiswa()"
                    class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button onclick="simpanTambahSiswa()"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Bagian Form Rapor -->
    <div id="form-rapor" class="hidden">
        <h1 class="text-3xl font-bold text-center mb-8 text-indigo-700">Form Isi Rapor Anak</h1>
        <form id="reportForm" class="space-y-8">
        <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
            <!-- Tambahkan input hidden siswa_id -->
        <input type="hidden" id="reportFormSiswaId" name="siswa_id" value="">
            <!-- Tombol Kembali -->
            <button type="button" onclick="backToDaftarSiswa()"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                Kembali
            </button>
            <!-- Info Siswa -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="reportFormStudentName"
                        class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Nama
                        Siswa</label>
                    <input type="text" id="reportFormStudentName" name="studentName" required readonly
                        class="w-full border border-indigo-300 dark:border-gray-600 rounded px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none cursor-not-allowed" />
                </div>
                <div>
                    <label for="reportFormGender"
                        class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Jenis
                        Kelamin</label>
                    <select id="reportFormGender" name="gender" required
                        class="w-full border border-indigo-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label for="reportFormClass"
                        class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Kelas</label>
                    <select id="reportFormClass" name="class" required
                        class="w-full border border-indigo-300 dark:border-gray-600 rounded px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none cursor-not-allowed"
                        readonly>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="A">Kelas A</option>
                        <option value="B">Kelas B</option>
                    </select>
                </div>
                <div>
                    <label for="reportFormNISN"
                        class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">NISN</label>
                    <input type="text" id="reportFormNISN" name="nisn" required readonly
                        class="w-full border border-indigo-300 dark:border-gray-600 rounded px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none cursor-not-allowed" />
                </div>
            </div>

            <!-- Aspek Perkembangan -->
            <fieldset class="border border-indigo-300 dark:border-gray-600 rounded p-6">
                <legend class="text-xl font-semibold mb-4 text-indigo-600">Nilai Perkembangan Anak</legend>
                <div id="aspectsContainer" class="space-y-4">
                    <!-- Initial aspect field is generated by addAspectField() on load/creation -->
                </div>
                <button type="button" id="addAspectBtn"
                    class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">+ Tambah
                    Aspek</button>
            </fieldset>

            <!-- Catatan Khusus -->
            <div>
                <label for="specialNotes" class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Catatan
                    Khusus</label>
                <textarea id="specialNotes" name="specialNotes" rows="4" required
                    class="w-full border border-indigo-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>

            <!-- Kehadiran -->
            <fieldset class="border border-indigo-300 dark:border-gray-600 rounded p-6">
                <legend class="text-xl font-semibold mb-4 text-indigo-600">Kehadiran</legend>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div>
                        <label for="presentDays"
                            class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Hadir</label>
                        <input type="number" id="presentDays" name="presentDays" min="0" value="0" required
                            class="w-full border border-indigo-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                        <label for="permitDays"
                            class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Izin</label>
                        <input type="number" id="permitDays" name="permitDays" min="0" value="0" required
                            class="w-full border border-indigo-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                        <label for="sickDays"
                            class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Sakit</label>
                        <input type="number" id="sickDays" name="sickDays" min="0" value="0" required
                            class="w-full border border-indigo-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                        <label for="absentDays"
                            class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Alpha</label>
                        <input type="number" id="absentDays" name="absentDays" min="0" value="0" required
                            class="w-full border border-indigo-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                </div>
            </fieldset>

            <!-- Nama Wali Kelas -->
            <div>
                <label for="teacherName" class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Nama Wali
                    Kelas</label>
                <input type="text" id="teacherName" name="teacherName" required
                    class="w-full border border-indigo-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <!-- Tombol -->
            <div class="flex justify-between">
                <button type="button" id="resetBtn"
                    class="bg-gray-400 dark:bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-500 dark:hover:bg-gray-500 transition">Reset</button>
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">Simpan</button>
            </div>
        </form>
    </div>

    <!-- Bagian Lihat Rapor (View Rapor) -->
    <div id="view-rapor-container" class="hidden">
        <!-- Konten Rapor yang akan dicetak, dibungkus dalam div terpisah untuk html2pdf -->
        <div id="rapor-printable-content"
            class="max-w-4xl mx-auto bg-white dark:bg-gray-700 p-6 rounded-lg shadow text-sm mt-0">
            <!-- Header Rapor -->
            <div class="text-left border-b-2 border-indigo-500 mb-8 pb-5">
                <h1 class="text-2xl font-bold text-indigo-600 uppercase dark:text-indigo-400">PAUD GEMILANG</h1>
                <p class="text-gray-600 dark:text-gray-300">Jl. Benda Baru No.6 RT.06/01 Pamulang, Tangerang Selatan</p>
                <p class="text-gray-600 dark:text-gray-300">Telp: 0896-1234-5678</p>
            </div>

            <!-- Info Siswa -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Data Siswa</h2>
                <table class="w-full border text-left border-gray-300 dark:border-gray-600">
                    <tbody>
                        <tr>
                            <td class="p-2 w-1/3 text-gray-700 dark:text-gray-300">Nama</td>
                            <td id="viewStudentName" class="p-2 text-gray-800 dark:text-gray-200">: </td>
                        </tr>
                        <tr>
                            <td class="p-2 text-gray-700 dark:text-gray-300">Jenis Kelamin</td>
                            <td id="viewGender" class="p-2 text-gray-800 dark:text-gray-200">: </td>
                        </tr>
                        <tr>
                            <td class="p-2 text-gray-700 dark:text-gray-300">Kelas</td>
                            <td id="viewClass" class="p-2 text-gray-800 dark:text-gray-200">: </td>
                        </tr>
                        <tr>
                            <td class="p-2 text-gray-700 dark:text-gray-300">Wali Kelas</td>
                            <td id="viewTeacherNameInfo" class="p-2 text-gray-800 dark:text-gray-200">: </td>
                        </tr>
                        <tr>
                            <td class="p-2 text-gray-700 dark:text-gray-300">NISN</td>
                            <td id="viewNISN" class="p-2 text-gray-800 dark:text-gray-200">: </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Nilai -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Nilai Rapor</h2>
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-600 text-sm">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="border p-2">Aspek</th>
                            <th class="border p-2">Nilai</th>
                            <th class="border p-2">Keterangan</th>
                            <th class="border p-2">Catatan Guru</th>
                        </tr>
                    </thead>
                    <tbody id="viewAspectsTableBody">
                        <!-- Data aspek akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Kehadiran -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Kehadiran</h2>
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-600 text-sm">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="border p-2">Hadir</th>
                            <th class="border p-2">Izin</th>
                            <th class="border p-2">Sakit</th>
                            <th class="border p-2">Alpha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="viewPresentDays" class="border p-2 text-center text-gray-800 dark:text-gray-200">
                            </td>
                            <td id="viewPermitDays" class="border p-2 text-center text-gray-800 dark:text-gray-200">
                            </td>
                            <td id="viewSickDays" class="border p-2 text-center text-gray-800 dark:text-gray-200"></td>
                            <td id="viewAbsentDays" class="border p-2 text-center text-gray-800 dark:text-gray-200">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Catatan -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Catatan Wali Kelas</h2>
                <p id="viewSpecialNotes" class="text-gray-700 dark:text-gray-300"></p>
            </div>

            <!-- Tanda Tangan -->
            <div class="flex justify-end mt-10">
                <div class="text-center">
                    <p class="dark:text-gray-300">Tangerang Selatan, <span id="viewReportDate"></span></p>
                    <p class="dark:text-gray-300">Wali Kelas</p>
                    <div class="h-16"></div>
                    <p class="font-semibold text-gray-800 dark:text-gray-200" id="viewTeacherNameSignature"></p>
                </div>
            </div>
        </div>
        <!-- Tombol Kembali dan Edit (ini tidak dicetak) -->
        <div class="flex justify-between mt-10 print:hidden">
            <button onclick="backToDaftarSiswa()"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-gray-200">
                Kembali
            </button>
            <div class="flex gap-2">
                <button onclick="printRapor()"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded">
                    Cetak Rapor
                </button>
                <button id="editRaporBtn"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                    Edit Rapor
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Custom Info Modal (pengganti alert) -->
<div id="info-modal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden modal-overlay">
    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-xl w-96 max-w-sm mx-4">
        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Informasi</h3>
        <p id="info-modal-message" class="mb-6 text-gray-700 dark:text-gray-300"></p>
        <div class="flex justify-end">
            <button id="info-modal-ok"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">OK</button>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
// Data Siswa (daftar siswa yang terdaftar)
let students = @json($siswa);

// Data Rapor (akan disimpan terpisah berdasarkan NIS)
let studentReports = @json($rapor);

// Fungsi Utility untuk modal info
const infoModalElements = {
    modal: document.getElementById("info-modal"),
    message: document.getElementById("info-modal-message"),
    okBtn: document.getElementById("info-modal-ok")
};

function showInfoModal(message) {
    infoModalElements.message.textContent = message;
    infoModalElements.modal.classList.remove("hidden");
}

infoModalElements.okBtn.addEventListener("click", () => {
    infoModalElements.modal.classList.add("hidden");
});


// Menentukan bagian yang akan ditampilkan
const daftarKelasSection = document.getElementById('daftar-kelas');
const daftarSiswaSection = document.getElementById('daftar-siswa');
const formRaporSection = document.getElementById('form-rapor');
const viewRaporSection = document.getElementById('view-rapor-container');
const modalTambahSiswa = document.getElementById('modalTambahSiswa');

let currentClass = ''; // Menyimpan kelas yang sedang aktif

// Fungsi Inisialisasi
window.onload = function () {
    students.forEach(student => {
        student.hasReport = studentReports.some(r => r.nisn === student.nisn);
    });
    showSection('daftar-kelas');
};


// Fungsi untuk mengelola tampilan section
function showSection(sectionId) {
    // Sembunyikan semua section utama
    daftarKelasSection.classList.add('hidden');
    daftarSiswaSection.classList.add('hidden');
    formRaporSection.classList.add('hidden');
    viewRaporSection.classList.add('hidden');
    modalTambahSiswa.classList.add('hidden'); // Pastikan modal tersembunyi jika ini bukan section yang akan ditampilkan

    // Tampilkan section yang diminta
    document.getElementById(sectionId).classList.remove('hidden');
}


// Fungsi navigasi
function showSiswa(kelas) {
    currentClass = kelas;
    document.getElementById('judul-kelas').innerText = `Daftar Siswa Kelas ${kelas}`;
    renderStudents(kelas); // Memuat daftar siswa
    showSection('daftar-siswa'); // Navigasi ke tampilan daftar siswa
}

function backToKelas() {
    showSection('daftar-kelas');
}

function backToDaftarSiswa() {
    showSection('daftar-siswa');
    renderStudents(currentClass); // Render ulang daftar siswa setelah kembali dari form/view
}

// Render Student Cards
function renderStudents(kelas) {
    const studentCards = document.getElementById('student-cards');
    studentCards.innerHTML = '';
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();

    const filtered = students.filter(s =>
        s.kelas === kelas &&
        (s.name.toLowerCase().includes(searchTerm) || s.nisn.toLowerCase().includes(searchTerm))
    );

    if (filtered.length === 0) {
    studentCards.innerHTML = `<p class="text-gray-500 dark:text-gray-400 text-center col-span-full">Tidak ada siswa yang ditemukan di kelas ini.</p>`;
    return;
}

filtered.forEach(student => {
    const card = document.createElement('div');
    card.className = 'bg-white dark:bg-gray-700 border rounded-xl p-4 shadow';

    // Cek apakah siswa sudah punya rapor
    let buttons = '';
    if (student.hasReport) {
        buttons = `
            <div class="flex gap-2 mt-2">
                <button onclick="viewReport('${student.nisn}')" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg">Lihat</button>
                <button onclick="editReport('${student.nisn}')" class="border border-gray-400 dark:border-gray-600 px-4 py-2 rounded-lg flex items-center gap-1 text-sm dark:text-gray-200">Edit</button>
            </div>`;
    } else {
        buttons = `
            <p class="text-red-500 italic dark:text-red-400">Belum ada rapor</p>
            <button onclick="showFormRapor('${student.nisn}', 'create')" class="mt-2 inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg">+ Buat</button>`;
    }

    card.innerHTML = `
        <h3 class="text-lg font-semibold dark:text-gray-200">${student.name}</h3>
        <p class="dark:text-gray-300"><strong>NISN:</strong> ${student.nisn}</p>
        <p class="dark:text-gray-300"><strong>Usia:</strong> ${student.age} tahun</p>
        ${buttons}`;

    studentCards.appendChild(card);
    });

}

document.getElementById('searchInput').addEventListener('input', function() {
    renderStudents(currentClass);
});


// Fungsi Modal Tambah Siswa
function openModalTambahSiswa() {
    // Reset form di modal
    document.getElementById('modalStudentName').value = '';
    document.getElementById('modalStudentNISN').value = '';
    document.getElementById('modalStudentAge').value = '';
    // HANYA tampilkan modal, jangan sembunyikan section lain
    modalTambahSiswa.classList.remove('hidden');
}

function closeModalTambahSiswa() {
    // HANYA sembunyikan modal
    modalTambahSiswa.classList.add('hidden');
}

function simpanTambahSiswa() {
    const name = document.getElementById('modalStudentName').value.trim();
    const nisn = document.getElementById('modalStudentNISN').value.trim();
    const age = parseInt(document.getElementById('modalStudentAge').value);
    const kelas = currentClass; // Gunakan currentClass dari daftar siswa yang aktif

    if (!name || !nisn || !age) {
        showInfoModal('Harap lengkapi semua kolom.');
        return;
    }

    // Cek NIS duplikat
    if (students.some(s => s.nisn === nisn)) {
        showInfoModal('NIS sudah ada. Gunakan NIS yang berbeda.');
        return;
    }

    const newStudent = {
        id: students.length > 0 ? Math.max(...students.map(s => s.id)) + 1 : 1, // Generate ID unik
        name,
        nisn,
        age,
        hasReport: false,
        kelas
    };
    students.push(newStudent);
    closeModalTambahSiswa();
    renderStudents(kelas); // Render ulang daftar siswa
    // Mengubah pesan notifikasi sesuai permintaan
    showInfoModal('data rapot siswa berhasil ditambahkan! :)');
}


// Fungsi Form Rapor (Create/Edit)
let currentNISN = null; // Menyimpan NIS siswa yang sedang diisi/diedit rapornya

function showFormRapor(nisn, mode) {
    currentNISN = nisn;
    const student = students.find(s => s.nisn === nisn);
    if (!student) {
        showInfoModal('Siswa tidak ditemukan.');
        return;
    }

    // Isi data siswa di form rapor
    document.getElementById('reportFormStudentName').value = student.name;
    document.getElementById('reportFormNISN').value = student.nisn;
    document.getElementById('reportFormClass').value = student.kelas;
    document.getElementById('reportFormSiswaId').value = student.id;

    const aspectsContainer = document.getElementById('aspectsContainer');
    aspectsContainer.innerHTML = ''; // Bersihkan aspek yang ada

    if (mode === 'edit') {
        const report = studentReports.find(r => r.nisn === nisn);
        if (report) {
            document.getElementById('reportFormGender').value = report.gender;
            document.getElementById('specialNotes').value = report.specialNotes;
            document.getElementById('presentDays').value = report.presentDays;
            document.getElementById('permitDays').value = report.permitDays;
            document.getElementById('sickDays').value = report.sickDays;
            document.getElementById('absentDays').value = report.absentDays;
            document.getElementById('teacherName').value = report.teacherName;

            // Isi aspek-aspek
            (report.aspects || []).forEach(aspect => {
                addAspectField(aspect);
            });
        } else {
            // Jika mode edit tapi rapor tidak ditemukan, mungkin ada inkonsistensi data
            showInfoModal('Rapor tidak ditemukan untuk siswa ini. Silakan buat rapor baru.');
            addAspectField(); // Tambahkan satu baris kosong
        }
    } else { // mode === 'create'
        // Reset form untuk pembuatan baru
        document.getElementById('reportFormGender').value = '';
        document.getElementById('specialNotes').value = '';
        document.getElementById('presentDays').value = '0';
        document.getElementById('permitDays').value = '0';
        document.getElementById('sickDays').value = '0';
        document.getElementById('absentDays').value = '0';
        document.getElementById('teacherName').value = '';
        addAspectField(); // Tambahkan satu baris kosong untuk input aspek pertama
    }

    showSection('form-rapor');
}

function addAspectField(aspect = null) {
    const container = document.getElementById('aspectsContainer');
    const aspectGroup = document.createElement('div');
    aspectGroup.className = 'grid grid-cols-1 md:grid-cols-4 gap-4 items-center aspect-group';
    aspectGroup.innerHTML =
        `
        <input type="text" name="aspectName[]" placeholder="Aspek Perkembangan" required class="border border-indigo-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500" value="${aspect ? aspect.name : ''}" />
        <input type="text" name="aspectDesc[]" placeholder="Keterangan" required class="border border-indigo-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500" value="${aspect ? aspect.desc : ''}" />
        <select name="aspectScore[]" required class="border border-indigo-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="">Nilai</option>
            <option value="1" ${aspect && aspect.score === '1' ? 'selected' : ''}>1 ★☆☆☆☆</option>
            <option value="2" ${aspect && aspect.score === '2' ? 'selected' : ''}>2 ★★☆☆☆</option>
            <option value="3" ${aspect && aspect.score === '3' ? 'selected' : ''}>3 ★★★☆☆</option>
            <option value="4" ${aspect && aspect.score === '4' ? 'selected' : ''}>4 ★★★★☆</option>
            <option value="5" ${aspect && aspect.score === '5' ? 'selected' : ''}>5 ★★★★★</option>
        </select>
        <div class="flex items-center gap-2">
            <input type="text" name="aspectNote[]" placeholder="Catatan Guru" class="flex-grow border border-indigo-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500" value="${aspect ? aspect.note : ''}" />
            <button type="button" onclick="removeAspectField(this)" class="text-red-500 hover:text-red-700 text-lg font-bold" title="Hapus Aspek">&times;</button>
        </div>`;
    container.appendChild(aspectGroup);
}
function removeAspectField(button) {
    const container = document.getElementById('aspectsContainer');
    if (container.children.length > 1) {
        button.closest('.aspect-group').remove();
    } else {
        showInfoModal('Minimal satu aspek harus tersedia.');
    }
}

document.getElementById('addAspectBtn').addEventListener('click', () => addAspectField());


document.getElementById('reportForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const aspects = Array.from(document.querySelectorAll('.aspect-group')).map(group => ({
        name: group.querySelector('input[name="aspectName[]"]').value,
        desc: group.querySelector('input[name="aspectDesc[]"]').value,
        score: group.querySelector('select[name="aspectScore[]"]').value,
        note: group.querySelector('input[name="aspectNote[]"]').value,
    }));

    const siswa_id = document.getElementById('reportFormSiswaId').value;
    const kelas = document.getElementById('reportFormClass').value;
    const gender = document.getElementById('reportFormGender').value;
    const nisn = document.getElementById('reportFormNISN').value;
    const specialNotes = document.getElementById('specialNotes').value;
    const presentDays = document.getElementById('presentDays').value;
    const permitDays = document.getElementById('permitDays').value;
    const sickDays = document.getElementById('sickDays').value;
    const absentDays = document.getElementById('absentDays').value;
    const teacherName = document.getElementById('teacherName').value;

    const formData = {
        siswa_id,
        kelas,
        jenis_kelamin: gender,
        nisn,
        catatan_wali: specialNotes,
        hadir: presentDays,
        izin: permitDays,
        sakit: sickDays,
        alpha: absentDays,
        wali_kelas: teacherName,
        aspek: JSON.stringify(aspects)
    };

    try {

        const csrfToken = document.getElementById('csrfToken').value;

        const response = await fetch('/rapor', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(formData)
    });

    if (!response.ok) {
        const result = await response.json();
        const errorList = Object.values(result.errors || {}).flat().join(', ');
        showInfoModal('Gagal menyimpan rapor: ' + result.message + (errorList ? ' — ' + errorList : ''));
        return;
    }

        const result = await response.json();

        const newReport = {
            nisn,
            studentName: document.getElementById('reportFormStudentName').value,
            gender,
            class: kelas,
            aspects,
            specialNotes,
            presentDays,
            permitDays,
            sickDays,
            absentDays,
            teacherName,
            reportDate: new Date().toISOString().slice(0, 10)
        };

        const existingReportIndex = studentReports.findIndex(r => r.nisn === nisn);
        if (existingReportIndex > -1) {
            studentReports[existingReportIndex] = newReport;
            showInfoModal('Rapor berhasil diperbarui!');
        } else {
            studentReports.push(newReport);
            showInfoModal('Rapor berhasil disimpan!');
        }

        const studentInList = students.find(s => s.nisn === nisn);
        if (studentInList) {
            studentInList.hasReport = true;
        }

        this.reset();
        showSection('daftar-siswa');
        renderStudents(kelas);
    } catch (error) {
        showInfoModal('Terjadi kesalahan: ' + error.message);
    }
});


document.getElementById('resetBtn').addEventListener('click', function() {
    document.getElementById('reportForm').reset();
    document.getElementById('aspectsContainer').innerHTML = ''; // Hapus semua aspek
    addAspectField(); // Tambahkan satu aspek kosong lagi
    showInfoModal('Form rapor berhasil direset.');
});


// Fungsi Lihat Rapor (View)
function viewReport(nisn) {
    currentViewNISN = nisn; // simpan global
    const report = studentReports.find(r => r.nisn === nisn);
    if (!report) {
        showInfoModal('Rapor untuk siswa ini belum ada.');
        return;
    }

    document.getElementById('viewStudentName').textContent = `: ${report.studentName}`;
    document.getElementById('viewGender').textContent = `: ${report.gender}`;
    document.getElementById('viewClass').textContent = `: ${report.class}`;
    document.getElementById('viewTeacherNameInfo').textContent = `: ${report.teacherName}`;
    document.getElementById('viewNISN').textContent = `: ${report.nisn}`;
    document.getElementById('viewSpecialNotes').textContent = report.specialNotes;


    const tbody = document.getElementById('viewAspectsTableBody');
    tbody.innerHTML = '';
    (report.aspects || []).forEach(aspect => {
        tbody.innerHTML += `
        <tr>
            <td class="border p-2">${aspect.name}</td>
            <td class="border p-2">${'★'.repeat(aspect.score)}</td>
            <td class="border p-2">${aspect.desc}</td>
            <td class="border p-2">${aspect.note}</td>
        </tr>`;
    });

    document.getElementById('viewPresentDays').textContent = report.presentDays;
    document.getElementById('viewPermitDays').textContent = report.permitDays;
    document.getElementById('viewSickDays').textContent = report.sickDays;
    document.getElementById('viewAbsentDays').textContent = report.absentDays;

    // Set tanggal otomatis dalam format Indonesia
    const today = new Date();
    const options = {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    };
    const formattedDate = today.toLocaleDateString('id-ID', options);
    document.getElementById('viewReportDate').textContent = formattedDate;

    const editBtn = document.getElementById('editRaporBtn');
    if (editBtn) {
        editBtn.onclick = function () {
            editReport(nisn);
        };
    }

    // Set listener untuk tombol edit di halaman view rapor
    document.getElementById('editRaporBtn').onclick = () => editReport(nisn);

    showSection('view-rapor-container');
}

// Fungsi Edit Rapor (dari tombol 'Edit' di daftar siswa atau 'Edit Rapor' di tampilan rapor)
function editReport(nisn) {
    showFormRapor(nisn, 'edit');
}


// Fungsi Cetak Rapor (mengunduh PDF)
function printRapor() {
    // Pastikan konten rapor yang ingin dicetak adalah elemen yang benar-benar terlihat
    // dan hanya konten rapor saja, bukan seluruh halaman aplikasi.
    const element = document.getElementById('rapor-printable-content');

    if (!element) {
        showInfoModal('Error: Konten rapor tidak ditemukan untuk dicetak.');
        console.error('Elemen #rapor-printable-content tidak ditemukan.');
        return;
    }

    // Memberikan feedback visual saat proses dimulai
    showInfoModal('Sedang menyiapkan rapor untuk diunduh...');

    html2pdf(element, {
        margin: 0.5,
        filename: 'rapor-siswa.pdf',
        image: {
            type: 'jpeg',
            quality: 0.98
        },
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'in',
            format: 'letter',
            orientation: 'portrait'
        }
    }).then(() => {
        // Ini akan dieksekusi setelah html2pdf selesai menghasilkan PDF dan memicu unduhan.
        infoModalElements.modal.classList.add("hidden"); // Menyembunyikan modal
        console.log('Rapor berhasil diunduh.');
    }).catch(error => {
        console.error('Error saat mengunduh rapor:', error);
        showInfoModal('Gagal mengunduh rapor. Silakan coba lagi. Cek konsol browser untuk detail.');
        infoModalElements.modal.classList.add("hidden"); // Pastikan modal disembunyikan bahkan jika ada error
    });
}

let currentViewNISN = null;

window.onload = function () {
    students.forEach(student => {
        student.hasReport = studentReports.some(r => r.nisn === student.nisn);
    });

    // Set global handler untuk tombol Edit di halaman View
    const editBtn = document.getElementById('editRaporBtn');
    if (editBtn) {
        editBtn.onclick = function () {
            if (currentViewNISN) {
                editReport(currentViewNISN);
            } else {
                showInfoModal('Data rapor tidak ditemukan. Silakan coba lagi.');
            }
        };
    }

    showSection('daftar-kelas');
};


function editReport(nisn) {
    showFormRapor(nisn, 'edit');
}
</script>
<style>
@media print {

    /* Sembunyikan elemen yang tidak perlu dicetak */
    .print\:hidden {
        display: none !important;
    }

    /* Paksa latar belakang putih dan teks hitam untuk seluruh body saat mencetak */
    body {
        background-color: #ffffff !important;
        color: #000000 !important;
        margin: 0;
        padding: 0;
        -webkit-print-color-adjust: exact;
        /* Penting untuk mencetak warna latar belakang */
    }

    /* Atur ulang gaya untuk konten rapor agar terlihat baik saat dicetak */
    #rapor-printable-content {
        box-shadow: none !important;
        /* Hapus bayangan saat dicetak */
        margin: 0 !important;
        /* Hapus margin agar sesuai halaman */
        padding: 0.5in !important;
        /* Tambahkan padding agar tidak terlalu mepet tepi */
        width: 100%;
        /* Pastikan lebar 100% */
        background-color: #ffffff !important;
        /* Paksa latar belakang putih */
        color: #000000 !important;
        /* Paksa warna teks hitam */
    }

    /* Paksa semua elemen di dalam rapor menjadi hitam dan latar belakang transparan */
    #rapor-printable-content * {
        color: #000000 !important;
        /* Paksa semua elemen anak memiliki teks hitam */
        background-color: transparent !important;
        /* Pastikan latar belakang elemen anak transparan */
        border-color: #e5e7eb !important;
        /* Paksa warna border terang untuk tabel */
    }

    /* Aturan khusus untuk header tabel: paksa latar belakang putih dan teks hitam */
    #rapor-printable-content th {
        background-color: #ffffff !important;
        /* Paksa latar belakang putih */
        color: #000000 !important;
        /* Paksa teks hitam */
        border: 1px solid #e5e7eb !important;
        /* Border terang agar terlihat di atas putih */
    }

    /* Border untuk sel tabel juga harus konsisten */
    #rapor-printable-content td {
        border: 1px solid #e5e7eb !important;
        /* Border terang agar terlihat di atas putih */
    }

    /* Paksa elemen <h1> di header rapor menjadi hitam */
    #rapor-printable-content h1 {
        color: #000000 !important;
    }
}
</style>
@endsection