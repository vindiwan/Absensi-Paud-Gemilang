@extends('layouts.app')

@section('title', 'Rekap Absen Otomatis')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <!-- Rekap Absen Section (Harian & Bulanan) -->
    <div class="border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 p-4 shadow-md w-full">
        <!-- Tabs -->
        <div class="flex gap-4 border-b dark:border-gray-600 mb-4">
            <button id="tab-harian"
                class="py-2 px-4 border-b-2 border-indigo-500 font-semibold text-indigo-600 dark:text-indigo-400 rounded-t-md">Harian</button>
            <button id="tab-bulanan"
                class="py-2 px-4 text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-t-md">Bulanan</button>
        </div>

        <!-- Harian Section -->
        <section id="rekap-harian">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <select id="select-kelas-harian"
                    class="border border-gray-300 dark:border-gray-600 p-2 rounded-md bg-white dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="Semua Kelas">Semua Kelas</option>
                    <option value="A">Kelas A</option>
                    <option value="B">Kelas B</option>
                </select>
                <input type="date" id="tanggal-harian"
                    class="border border-gray-300 dark:border-gray-600 p-2 rounded-md bg-white dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                <button id="filter-harian"
                    class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 transition duration-200 shadow-md">Filter</button>
                <button id="reset-harian"
                    class="bg-gray-300 dark:bg-gray-600 dark:text-white px-4 py-2 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-200 shadow-md">Reset</button>
                <button id="excel-harian"
                    class="bg-green-500 text-white px-4 py-2 rounded-md flex items-center gap-1 hover:bg-green-600 transition duration-200 shadow-md">
                    <span class="material-icons text-lg">description</span> Excel
                </button>
            </div>
            <div class="overflow-x-auto">
                <table id="table-harian"
                    class="w-full border border-gray-300 dark:border-gray-600 text-sm text-center rounded-lg overflow-hidden">
                    <thead class="bg-indigo-500 text-white">
                        <tr>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4 rounded-tl-lg">No</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4">Nama Siswa</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4">Kelas</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4">Tanggal</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4">Status</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4 rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body-harian" class="bg-white dark:bg-gray-800">
                        <!-- Data akan dimuat di sini oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Bulanan Section -->
        <section id="rekap-bulanan" class="hidden">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <select id="select-kelas-bulanan"
                    class="border border-gray-300 dark:border-gray-600 p-2 rounded-md bg-white dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="Semua Kelas">Semua Kelas</option>
                    <option value="A">Kelas A</option>
                    <option value="B">Kelas B</option>
                </select>
                <select id="select-bulan-bulanan"
                    class="border border-gray-300 dark:border-gray-600 p-2 rounded-md bg-white dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </select>
                <input type="number" id="input-tahun-bulanan"
                    class="border border-gray-300 dark:border-gray-600 p-2 rounded-md bg-white dark:bg-gray-700 dark:text-gray-200 w-28 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Tahun (e.g., 2025)" value="2025" />
                <button id="filter-bulanan"
                    class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 transition duration-200 shadow-md">Filter</button>
                <button id="reset-bulanan"
                    class="bg-gray-300 dark:bg-gray-600 dark:text-white px-4 py-2 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-200 shadow-md">Reset</button>
                <button id="excel-bulanan"
                    class="bg-green-500 text-white px-4 py-2 rounded-md flex items-center gap-1 hover:bg-green-600 transition duration-200 shadow-md">
                    <span class="material-icons text-lg">description</span> Excel
                </button>
            </div>
            <div class="overflow-x-auto">
                <table id="table-bulanan"
                    class="w-full border border-gray-300 dark:border-gray-600 text-sm text-center rounded-lg overflow-hidden">
                    <thead class="bg-indigo-500 text-white">
                        <tr>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4 rounded-tl-lg">No</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4">Nama Siswa</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4">Kelas</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4">Bulan</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4">Hadir</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4">Sakit</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4">Izin</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4">Alpha</th>
                            <th class="border border-gray-300 dark:border-gray-600 py-2 px-4 rounded-tr-lg">% Hadir
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table-body-bulanan" class="bg-white dark:bg-gray-800">
                        <!-- Data akan dimuat di sini oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<!-- Custom Confirmation Modal -->
<div id="confirmation-modal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden modal-overlay">
    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-xl w-96 max-w-sm mx-4">
        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Konfirmasi Penghapusan</h3>
        <p class="mb-6 text-gray-700 dark:text-gray-300">Apakah Anda yakin akan menghapus seluruh data yang Anda pilih
            ini?</p>
        <div class="flex justify-end gap-3">
            <button id="confirm-no"
                class="bg-gray-300 dark:bg-gray-600 dark:text-white px-4 py-2 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-200">TIDAK</button>
            <button id="confirm-yes"
                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-200">YA</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
// --- Referensi Elemen DOM ---
const btnHarian = document.getElementById("tab-harian");
const btnBulanan = document.getElementById("tab-bulanan");
const sectionHarian = document.getElementById("rekap-harian");
const sectionBulanan = document.getElementById("rekap-bulanan");

// Elemen Bagian Rekap Harian
const selectKelasHarian = document.getElementById("select-kelas-harian");
const inputTanggalHarian = document.getElementById("tanggal-harian");
const btnFilterHarian = document.getElementById("filter-harian");
const btnResetHarian = document.getElementById("reset-harian");
const tableBodyHarian = document.getElementById("table-body-harian");

// Elemen Bagian Rekap Bulanan
const selectKelasBulanan = document.getElementById("select-kelas-bulanan");
const selectBulanBulanan = document.getElementById("select-bulan-bulanan");
const inputTahunBulanan = document.getElementById("input-tahun-bulanan");
const btnFilterBulanan = document.getElementById("filter-bulanan");
const btnResetBulanan = document.getElementById("reset-bulanan");
const tableBodyBulanan = document.getElementById("table-body-bulanan");

// Elemen Modal Konfirmasi
const confirmationModal = document.getElementById("confirmation-modal");
const confirmYesBtn = document.getElementById("confirm-yes");
const confirmNoBtn = document.getElementById("confirm-no");
let confirmCallback = null; // Menyimpan fungsi callback untuk konfirmasi modal

// Elemen Modal Info (pengganti alert)
const infoModal = document.getElementById("info-modal");
const infoModalMessage = document.getElementById("info-modal-message");
const infoModalOkBtn = document.getElementById("info-modal-ok");


// Mapping nama bulan ke indeks (0-11)
const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
    "Oktober", "November", "Desember"
];

// rekapHarianData akan menjadi sumber utama data
let rekapHarianData =  [];
async function fetchRekapHarian() {
    const kelas = selectKelasHarian.value;
    const tanggal = inputTanggalHarian.value;
    const params = new URLSearchParams();

    if (kelas && kelas !== "Semua Kelas") params.append("kelas", kelas);
    if (tanggal) params.append("tanggal", tanggal);

    const res = await fetch(`/rekap-harian?${params.toString()}`);
    const data = await res.json();
    rekapHarianData = data;
    renderTableHarian(rekapHarianData);
}
// rekapBulananData akan selalu dihitung ulang dari rekapHarianData
let rekapBulananData = [];
async function updateRekapBulanan() {
    const kelas = selectKelasBulanan.value;
    const bulan = monthNames.indexOf(selectBulanBulanan.value) + 1;
    const tahun = inputTahunBulanan.value;

    const params = new URLSearchParams({
        kelas: kelas !== "Semua Kelas" ? kelas : '',
        bulan,
        tahun
    });

    const res = await fetch(`/api/rekap-bulanan?${params.toString()}`);
    const data = await res.json();
    rekapBulananData = data;
    renderTableBulanan(rekapBulananData);
}


// --- Logika Penggantian Tab ---
btnHarian.addEventListener("click", () => {
    sectionHarian.classList.remove("hidden");
    sectionBulanan.classList.add("hidden");
    btnHarian.classList.add("border-b-2", "border-indigo-500", "font-semibold", "text-indigo-600",
        "dark:text-indigo-400");
    btnBulanan.classList.remove("border-b-2", "border-indigo-500", "font-semibold", "text-indigo-600",
        "dark:text-indigo-400");
    filterHarian(); // Filter ulang tabel harian saat tab diklik
});

btnBulanan.addEventListener("click", () => {
    sectionBulanan.classList.remove("hidden");
    sectionHarian.classList.add("hidden");
    btnBulanan.classList.add("border-b-2", "border-indigo-500", "font-semibold", "text-indigo-600",
        "dark:text-indigo-400");
    btnHarian.classList.remove("border-b-2", "border-indigo-500", "font-semibold", "text-indigo-600",
        "dark:text-indigo-400");
    updateRekapBulanan(); // Pastikan data bulanan terbaru saat tab diklik
});

// --- Fungsionalitas Ekspor Excel ---
function exportTableToExcel(tableId, fileName, excludeColumnIndex = -1) {
    const table = document.getElementById(tableId);
    let tableToExport;

    if (excludeColumnIndex !== -1) {
        // Mengkloning tabel untuk menghindari modifikasi DOM asli
        tableToExport = table.cloneNode(true);
        // Menghapus kolom yang ditentukan dari tabel yang dikloning
        tableToExport.querySelectorAll('tr').forEach(row => {
            if (row.cells[excludeColumnIndex]) {
                row.cells[excludeColumnIndex].remove();
            }
        });
    } else {
        tableToExport = table;
    }

    const wb = XLSX.utils.table_to_book(tableToExport, {
        sheet: "Sheet1"
    });
    XLSX.writeFile(wb, fileName);
}

document.getElementById("excel-harian").addEventListener("click", () => {
    // Mengecualikan kolom 'Aksi' (indeks 5, 0-indexed)
    exportTableToExcel("table-harian", "rekap-absen-harian.xlsx", 5);
});

document.getElementById("excel-bulanan").addEventListener("click", () => {
    // Tidak ada pengecualian kolom untuk laporan bulanan
    exportTableToExcel("table-bulanan", "rekap-absen-bulanan.xlsx");
});

// --- Logika Bagian Rekap Harian ---

// Fungsi untuk merender tabel Harian berdasarkan data yang disediakan
function renderTableHarian(dataToRender) {
    tableBodyHarian.innerHTML = ""; // Hapus baris yang ada
    if (dataToRender.length === 0) {
        const noDataRow = document.createElement("tr");
        noDataRow.innerHTML =
            `<td colspan="6" class="py-4 text-gray-500 dark:text-gray-400">Tidak ada data absen yang ditemukan.</td>`;
        tableBodyHarian.appendChild(noDataRow);
        return;
    }

    dataToRender.forEach((item, index) => {
        const row = document.createElement("tr");
        row.classList.add("border-t", "border-gray-300", "dark:border-gray-600");
        const statusClass = item.status === 'Hadir' ? 'text-green-500' : 'text-red-500';
        row.dataset.id = item.id; // Menyimpan ID item untuk pencarian mudah
        row.innerHTML = `
                <td class="py-2 px-4">${index + 1}</td>
                <td class="py-2 px-4 editable" data-field="nama" data-id-siswa="${item.idSiswa}">${item.nama}</td>
                <td class="py-2 px-4 editable" data-field="kelas">${item.kelas}</td>
                <td class="py-2 px-4 editable" data-field="tanggal">${item.tanggal}</td>
                <td class="py-2 px-4 editable ${statusClass}" data-field="status">${item.status}</td>
                <td class="py-2 px-4 space-x-1">
                    <button class="edit-btn bg-indigo-400 dark:bg-indigo-600 text-white p-1 rounded-md hover:bg-indigo-500 dark:hover:bg-indigo-700 transition duration-200">
                        <span class="material-icons text-sm">edit</span>
                    </button>
                    <button class="delete-btn bg-red-400 dark:bg-red-600 text-white p-1 rounded-md hover:bg-red-500 dark:hover:bg-red-700 transition duration-200">
                        <span class="material-icons text-sm">delete</span>
                    </button>
                </td>
            `;
        tableBodyHarian.appendChild(row);
    });
}

// Filter data Harian
function filterHarian() {
    const selectedKelas = selectKelasHarian.value;
    const selectedTanggal = inputTanggalHarian.value;

    let filteredData = rekapHarianData;

    if (selectedKelas !== "Semua Kelas") {
        filteredData = filteredData.filter(item => item.kelas === selectedKelas);
    }
    if (selectedTanggal) {
        filteredData = filteredData.filter(item => item.tanggal === selectedTanggal);
    }
    renderTableHarian(filteredData);
}

// Event listener untuk tombol Filter Harian
btnFilterHarian.addEventListener("click", fetchRekapHarian);

// Event listener untuk tombol Reset Harian
btnResetHarian.addEventListener("click", () => {
    showConfirmationModal(() => {
        const selectedKelas = selectKelasHarian.value;
        const selectedTanggal = inputTanggalHarian.value;

        // Jika tidak ada filter yang diterapkan, hapus semua data
        if (selectedKelas === "Semua Kelas" && !selectedTanggal) {
            rekapHarianData = [];
        } else {
            // Jika filter diterapkan, hapus hanya data yang difilter
            rekapHarianData = rekapHarianData.filter(item => {
                const classMatch = selectedKelas === "Semua Kelas" || item.kelas ===
                    selectedKelas;
                const dateMatch = !selectedTanggal || item.tanggal === selectedTanggal;
                return !(classMatch &&
                    dateMatch); // Pertahankan item yang *tidak* cocok dengan filter
            });
        }
        // Reset input filter
        selectKelasHarian.value = "Semua Kelas";
        inputTanggalHarian.value = "";
        // Render ulang tabel dengan data yang tersisa dan perbarui bulanan
        filterHarian();
        updateRekapBulanan();
    });
});

// Edit dan Delete untuk Tabel Harian (delegated event listener)
tableBodyHarian.addEventListener("click", function(e) {
    const target = e.target.closest("button");
    if (!target) return;

    const row = target.closest("tr");
    const itemId = parseInt(row.dataset.id); // Dapatkan ID dari atribut data-id
    const itemIndex = rekapHarianData.findIndex(item => item.id === itemId);

    if (target.classList.contains("edit-btn")) {
        row.querySelectorAll(".editable").forEach(cell => {
            const text = cell.textContent;
            const field = cell.dataset.field;
            let inputElement;

            if (field === 'status') {
                // Untuk kolom status, gunakan dropdown select
                inputElement = document.createElement('select');
                inputElement.classList.add("border", "border-gray-300", "dark:border-gray-600",
                    "rounded-md", "px-2", "py-1", "w-full", "bg-white", "dark:bg-gray-700",
                    "text-gray-900", "dark:text-gray-200");
                const options = ['Hadir', 'Sakit', 'Izin', 'Alpha'];
                options.forEach(optionText => {
                    const option = document.createElement('option');
                    option.value = optionText;
                    option.textContent = optionText;
                    if (optionText === text) {
                        option.selected = true;
                    }
                    inputElement.appendChild(option);
                });
            } else if (field === 'tanggal') {
                // Untuk kolom tanggal, gunakan input tanggal
                inputElement = document.createElement('input');
                inputElement.type = 'date';
                inputElement.value = text;
                inputElement.classList.add("border", "border-gray-300", "dark:border-gray-600",
                    "rounded-md", "px-2", "py-1", "w-full", "bg-white", "dark:bg-gray-700",
                    "text-gray-900", "dark:text-gray-200");
            } else if (field === 'kelas') {
                // Untuk kolom kelas, gunakan dropdown select
                inputElement = document.createElement('select');
                inputElement.classList.add("border", "border-gray-300", "dark:border-gray-600",
                    "rounded-md", "px-2", "py-1", "w-full", "bg-white", "dark:bg-gray-700",
                    "text-gray-900", "dark:text-gray-200");
                const options = ['A', 'B']; // Sesuaikan dengan kelas yang tersedia
                options.forEach(optionText => {
                    const option = document.createElement('option');
                    option.value = optionText;
                    option.textContent = optionText;
                    if (optionText === text) {
                        option.selected = true;
                    }
                    inputElement.appendChild(option);
                });
            } else {
                // Untuk kolom lain yang dapat diedit, gunakan input teks
                inputElement = document.createElement('input');
                inputElement.type = 'text';
                inputElement.value = text;
                inputElement.classList.add("border", "border-gray-300", "dark:border-gray-600",
                    "rounded-md", "px-2", "py-1", "w-full", "bg-white", "dark:bg-gray-700",
                    "text-gray-900", "dark:text-gray-200");
            }
            cell.innerHTML = '';
            cell.appendChild(inputElement);
        });
        target.innerHTML = `<span class="material-icons text-sm">save</span>`;
        target.classList.remove("edit-btn");
        target.classList.add("save-btn");
        target.classList.remove("bg-indigo-400", "dark:bg-indigo-600");
        target.classList.add("bg-green-500", "dark:bg-green-700");
    } else if (target.classList.contains("save-btn")) {
        const updatedItem = {
            ...rekapHarianData[itemIndex]
        }; // Buat salinan item asli

        row.querySelectorAll(".editable").forEach(cell => {
            const input = cell.querySelector("input") || cell.querySelector("select");
            const newValue = input.value;
            const field = cell.dataset.field;

            cell.textContent = newValue;
            // Perbarui properti yang sesuai di updatedItem
            updatedItem[field] = newValue;
        });

        rekapHarianData[itemIndex] = updatedItem;

        target.innerHTML = `<span class="material-icons text-sm">edit</span>`;
        target.classList.remove("save-btn");
        target.classList.add("edit-btn");
        target.classList.remove("bg-green-500", "dark:bg-green-700");
        target.classList.add("bg-indigo-400", "dark:bg-indigo-600");

        // Render ulang tabel harian dan perbarui bulanan
        filterHarian();
        updateRekapBulanan();
    } else if (target.classList.contains("delete-btn")) {
        showConfirmationModal(() => {
            rekapHarianData.splice(itemIndex, 1); // Hapus dari array
            filterHarian(); // Render ulang tabel harian
            updateRekapBulanan(); // Perbarui bulanan
        });
    }
});

// --- Logika Bagian Rekap Bulanan ---

// Fungsi untuk menghitung dan memperbarui rekap bulanan dari data harian
function updateRekapBulanan() {
    const monthlyAggregatedData = new Map(); // Key: `${nama}-${kelas}-${bulan}-${tahun}`

    rekapHarianData.forEach(dailyRecord => {
        const date = new Date(dailyRecord.tanggal);
        const year = date.getFullYear();
        const month = monthNames[date.getMonth()]; // Mengambil nama bulan dari array

        // Buat kunci unik untuk setiap siswa di setiap kelas per bulan dan tahun
        // Menggunakan idSiswa + kelas + bulan + tahun untuk memastikan unik per siswa dalam satu kelas per bulan
        const key = `${dailyRecord.idSiswa}-${dailyRecord.kelas}-${month}-${year}`;

        if (!monthlyAggregatedData.has(key)) {
            monthlyAggregatedData.set(key, {
                id: Date.now() + Math.random(), // ID sederhana yang unik
                idSiswa: dailyRecord.idSiswa,
                nama: dailyRecord.nama,
                kelas: dailyRecord.kelas,
                bulan: month,
                tahun: year,
                hadir: 0,
                sakit: 0,
                izin: 0,
                alpha: 0,
                totalHariAbsen: 0 // Untuk menghitung persentase
            });
        }

        const monthlyRecord = monthlyAggregatedData.get(key);
        switch (dailyRecord.status) {
            case 'Hadir':
                monthlyRecord.hadir++;
                break;
            case 'Sakit':
                monthlyRecord.sakit++;
                break;
            case 'Izin':
                monthlyRecord.izin++;
                break;
            case 'Alpha':
                monthlyRecord.alpha++;
                break;
        }
        monthlyRecord.totalHariAbsen++; // Menambah total hari yang tercatat untuk perhitungan persentase
    });

    // Konversi nilai Map kembali ke array dan hitung persentase
    rekapBulananData = Array.from(monthlyAggregatedData.values()).map(item => {
        const total = item.hadir + item.sakit + item.izin + item.alpha;
        // Hindari pembagian dengan nol
        const percentage = total === 0 ? '0%' : ((item.hadir / total) * 100).toFixed(2) + '%';
        return {
            id: item.id,
            nama: item.nama,
            kelas: item.kelas,
            bulan: item.bulan,
            tahun: item.tahun,
            hadir: item.hadir,
            sakit: item.sakit,
            izin: item.izin,
            alpha: item.alpha,
            persentase: percentage
        };
    }).sort((a, b) => {
        // Urutkan berdasarkan tahun, kemudian bulan, kemudian kelas, kemudian nama
        if (a.tahun !== b.tahun) return a.tahun - b.tahun;
        const monthOrder = monthNames.indexOf(a.bulan) - monthNames.indexOf(b.bulan);
        if (monthOrder !== 0) return monthOrder;
        if (a.kelas !== b.kelas) return a.kelas.localeCompare(b.kelas);
        return a.nama.localeCompare(b.nama);
    });

    filterBulanan(); // Render ulang tabel bulanan dengan data yang baru dihitung
}

// Fungsi untuk merender tabel Bulanan berdasarkan data yang disediakan
function renderTableBulanan(dataToRender) {
    tableBodyBulanan.innerHTML = ""; // Hapus baris yang ada
    if (dataToRender.length === 0) {
        const noDataRow = document.createElement("tr");
        noDataRow.innerHTML =
            `<td colspan="9" class="py-4 text-gray-500 dark:text-gray-400">Tidak ada data absen yang ditemukan.</td>`;
        tableBodyBulanan.appendChild(noDataRow);
        return;
    }

    dataToRender.forEach((item, index) => {
        const row = document.createElement("tr");
        row.classList.add("border-t", "border-gray-300", "dark:border-gray-600");
        row.innerHTML = `
                <td class="py-2 px-4">${index + 1}</td>
                <td class="py-2 px-4">${item.nama}</td>
                <td class="py-2 px-4">${item.kelas}</td>
                <td class="py-2 px-4">${item.bulan}</td>
                <td class="py-2 px-4">${item.hadir}</td>
                <td class="py-2 px-4">${item.sakit}</td>
                <td class="py-2 px-4">${item.izin}</td>
                <td class="py-2 px-4">${item.alpha}</td>
                <td class="py-2 px-4">${item.persentase}</td>
            `;
        tableBodyBulanan.appendChild(row);
    });
}

// Filter data Bulanan
function filterBulanan() {
    const selectedKelas = selectKelasBulanan.value;
    const selectedBulan = selectBulanBulanan.value;
    const selectedTahun = inputTahunBulanan.value;

    let filteredData = rekapBulananData;

    if (selectedKelas !== "Semua Kelas") {
        filteredData = filteredData.filter(item => item.kelas === selectedKelas);
    }
    if (selectedBulan) {
        filteredData = filteredData.filter(item => item.bulan === selectedBulan);
    }
    if (selectedTahun) {
        filteredData = filteredData.filter(item => item.tahun && item.tahun.toString() === selectedTahun);
    }
    renderTableBulanan(filteredData);
}

// Event listener untuk tombol Filter Bulanan
btnFilterBulanan.addEventListener("click", updateRekapBulanan);
// Event listener untuk tombol Reset Bulanan
btnResetBulanan.addEventListener("click", () => {
    showConfirmationModal(() => {
        const selectedKelas = selectKelasBulanan.value;
        const selectedBulan = selectBulanBulanan.value;
        const selectedTahun = inputTahunBulanan.value;

        // Logika reset bulanan: hapus data harian yang relevan, kemudian rekap bulanan akan dihitung ulang
        rekapHarianData = rekapHarianData.filter(dailyRecord => {
            const date = new Date(dailyRecord.tanggal);
            const year = date.getFullYear();
            const month = monthNames[date.getMonth()];

            const classMatch = selectedKelas === "Semua Kelas" || dailyRecord.kelas ===
                selectedKelas;
            const monthMatch = !selectedBulan || month === selectedBulan;
            const yearMatch = !selectedTahun || year.toString() === selectedTahun;

            // Pertahankan record harian yang TIDAK cocok dengan kriteria reset bulanan
            return !(classMatch && monthMatch && yearMatch);
        });

        // Reset input filter bulanan
        selectKelasBulanan.value = "Semua Kelas";
        selectBulanBulanan.value = "Januari"; // Asumsi "Januari" adalah opsi pertama
        inputTahunBulanan.value = new Date().getFullYear().toString(); // Reset tahun ke tahun saat ini

        // Perbarui dan render ulang kedua tabel
        filterHarian(); // Untuk memastikan tabel harian juga merefleksikan perubahan
        updateRekapBulanan(); // Ini akan memicu filterBulanan() secara otomatis
    });
});

// --- Logika Modal Konfirmasi Kustom ---

// Fungsi untuk menampilkan modal konfirmasi kustom (untuk YA/TIDAK)
function showConfirmationModal(callback) {
    confirmationModal.classList.remove("hidden");
    confirmCallback = callback; // Simpan fungsi callback
}

// Event listener untuk tombol 'YA' di modal konfirmasi
confirmYesBtn.addEventListener("click", () => {
    if (confirmCallback) {
        confirmCallback(); // Jalankan callback yang tersimpan
    }
    confirmationModal.classList.add("hidden"); // Sembunyikan modal
});

// Event listener untuk tombol 'TIDAK' di modal konfirmasi
confirmNoBtn.addEventListener("click", () => {
    confirmationModal.classList.add("hidden"); // Sembunyikan modal
});

// --- Modal Informasi/Peringatan Kustom (pengganti alert) ---
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


// --- Pemuatan Halaman Awal ---
// Ini berjalan saat DOM dimuat sepenuhnya
window.onload = function() {
    window.onload = function () {
    fetchRekapHarian(); // Panggil data harian dari server
    updateRekapBulanan(); // Data bulanan dari server
};
    // Set tahun default untuk filter bulanan ke tahun saat ini
    inputTahunBulanan.value = new Date().getFullYear().toString();

    // Pastikan data harian dimuat ke dalam variabel
    rekapHarianData = [];

    // Render tabel harian awal
    filterHarian();
    // Hitung dan render tabel bulanan awal dari data harian
    updateRekapBulanan();
};
</script>
@endsection