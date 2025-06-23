@extends('layouts.app')

@section('title', 'Data Siswa - PAUD Gemilang')

@section('content')
<div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
    <header class="mb-6 text-center">
        <h1 class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">Data Siswa PAUD Gemilang</h1>
    </header>

    <section class="mb-6 flex justify-between items-center">
        <div class="flex gap-4">
            <button id="addStudentBtn"
                class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700 transition">
                Tambah Siswa Baru
            </button>
            <button id="printDataBtn" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">
                Cetak Data
            </button>
        </div>
        <input type="text" id="searchInput" placeholder="Cari siswa..."
            class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-60 focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-700 dark:text-gray-200" />
    </section>

    <div id="student-data-printable-content" class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-x-auto">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Daftar Siswa</h2>
        <table
            class="min-w-full table-auto text-sm sm:text-base border-collapse border border-gray-300 dark:border-gray-600">
            <thead class="bg-indigo-600 text-white text-left">
                <tr>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">No</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">NISN</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Nama</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Jenis Kelamin</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Umur</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Tanggal Lahir</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Kelas</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Telp Ortu</th>
                    <th class="px-3 py-2 border hidden sm:table-cell">Alamat</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center print:hidden">Aksi</th>
                </tr>
            </thead>
            <tbody id="studentTableBody" class="bg-white dark:bg-gray-800">
                @forelse($siswa as $i => $row)
                <tr>
                    <td class="px-4 py-2 border">{{ $i + 1 }}</td>
                    <td class="px-4 py-2 border">{{ $row->nisn }}</td>
                    <td class="px-4 py-2 border">{{ $row->username }}</td>
                    <td class="px-4 py-2 border">{{ $row->jenis_kelamin }}</td>
                    <td class="px-4 py-2 border">{{ $row->Umur }}</td>
                    <td class="px-4 py-2 border">{{ $row->tanggal_lahir }}</td>
                    <td class="px-4 py-2 border">{{ $row->kelas }}</td>
                    <td class="px-4 py-2 border">{{ $row->No_tlpOrtu }}</td>
                    <td class="px-3 py-2 border hidden sm:table-cell">{{ $row->alamat }}</td>
                    <td class="px-4 py-2 border text-center print:hidden">  
                        <div class="flex items-center justify-center space-x-3">
                            <button class="edit-btn text-blue-600 flex items-center gap-1 hover:underline" data-id="{{ $row->id }}">
                                <i data-feather="edit"></i>
                            </button>
                            <button class="delete-btn text-red-600 flex items-center gap-1 hover:underline" data-id="{{ $row->id }}">
                                <i data-feather="trash-2"></i>
                            </button>
                        </div>
                    </td>
                        <!-- Aksi edit/hapus bisa di sini -->

                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4 text-gray-500 dark:text-gray-400">Data siswa tidak
                        ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Siswa -->
<div id="studentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md max-h-screen overflow-y-auto">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200" id="modalTitle">Tambah Siswa</h2>
        <form id="studentForm" class="space-y-4 overflow-y-auto max-h-[70vh]">
            @csrf
            <div>
                <label for="studentNISN" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">NISN</label>
                <input type="text" id="studentNISN"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-700 dark:text-gray-200"
                    required />
            </div>
            <div>
                <label for="studentName" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Nama</label>
                <input type="text" id="studentName"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-700 dark:text-gray-200"
                    required />
            </div>
            <div>
                <label for="studentGender" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Jenis Kelamin</label>
                <select id="studentGender"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-700 dark:text-gray-200"
                    required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div>
                <label for="studentAge" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Umur</label>
                <input type="number" id="studentAge"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-700 dark:text-gray-200"
                    required />
            </div>
            <div>
                <label for="studentBirthDate" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Tanggal
                    Lahir</label>
                <input type="date" id="studentBirthDate"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-700 dark:text-gray-200"
                    required />
            </div>
            <div>
                <label for="studentClass"
                    class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Kelas</label>
                <input type="text" id="studentClass"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-700 dark:text-gray-200"
                    required />
            </div>
            <div>
                <label for="studentPhone" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Telp
                    Ortu</label>
                <input type="text" id="studentPhone"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-700 dark:text-gray-200"
                    required />
            </div>
            <div>
                <label for="studentAddress"
                    class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Alamat</label>
                <input type="text" id="studentAddress"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-700 dark:text-gray-200"
                    required />
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" id="cancelBtn"
                    class="px-4 py-2 rounded border border-gray-400 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                    Batal
                </button>
                <button type="submit"
                    class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Info Modal -->
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

<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
feather.replace();
const studentModal = document.getElementById('studentModal');
const studentForm = document.getElementById('studentForm');
const modalTitle = document.getElementById('modalTitle');
const addStudentBtn = document.getElementById('addStudentBtn');
const printDataBtn = document.getElementById('printDataBtn');
const cancelBtn = document.getElementById('cancelBtn');

const infoModalElements = {
    modal: document.getElementById("info-modal"),
    message: document.getElementById("info-modal-message"),
    okBtn: document.getElementById("info-modal-ok")
};

function showInfoModal(message) {
    infoModalElements.message.innerHTML = message;
    infoModalElements.modal.classList.remove("hidden");
}
infoModalElements.okBtn.addEventListener("click", () => {
    infoModalElements.modal.classList.add("hidden");
});

// Modal show/hide
addStudentBtn.addEventListener('click', () => {
    modalTitle.textContent = 'Tambah Siswa';
    studentForm.reset();
    delete studentForm.dataset.editId; // agar mode tambah
    studentModal.classList.remove('hidden');
});
cancelBtn.addEventListener('click', () => {
    studentModal.classList.add('hidden');
    studentForm.reset();
});

// Submit form ke backend (insert DB via Laravel)
studentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const nisn = document.getElementById('studentNISN').value;
    const name = document.getElementById('studentName').value;
    const gender = document.getElementById('studentGender').value;
    const genderKode = gender === "Perempuan" ? "P" : "L";
    const age = document.getElementById('studentAge').value;
    const birthDate = document.getElementById('studentBirthDate').value;
    const kelas = document.getElementById('studentClass').value;
    const phone = document.getElementById('studentPhone').value;
    const address = document.getElementById('studentAddress').value;

    const isEdit = studentForm.dataset.editId;
    const url = isEdit ? `/siswa/${isEdit}` : '/siswa';
    const method = isEdit ? 'PUT' : 'POST';

    fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                nisn,
                name,
                gender,
                age,
                birthDate,
                class: kelas,
                phone,
                address
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw err;
                });
            }
            return response.json();
        })
        .then(data => {
            showInfoModal(data.message || 'Siswa berhasil disimpan!');
            // Tambahkan baris ke tabel langsung tanpa reload
            const tbody = document.getElementById('studentTableBody');
            const count = tbody.rows.length;
            const row = data.data;
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="px-4 py-2 border">${count + 1}</td>
                <td class="px-4 py-2 border">${row.nisn}</td>
                <td class="px-4 py-2 border">${row.username}</td>
                <td class="px-4 py-2 border">${row.jenis_kelamin}</td>
                <td class="px-4 py-2 border">${row.Umur}</td>
                <td class="px-4 py-2 border">${row.tanggal_lahir}</td>
                <td class="px-4 py-2 border">${row.kelas}</td>
                <td class="px-4 py-2 border">${row.No_tlpOrtu}</td>
                <td class="px-4 py-2 border">${row.alamat}</td>
                <td class="px-4 py-2 border text-center print:hidden"></td>
            `;

            tbody.appendChild(newRow);

            studentModal.classList.add('hidden');
            studentForm.reset();
        })
        .catch(err => {
            let errorMsg = 'Gagal menyimpan data!';
            if (err && err.errors) {
                errorMsg += '<br>' + Object.values(err.errors).join('<br>');
            }
            showInfoModal(errorMsg);
        });
});

document.addEventListener('click', function (e) {
    const editBtn = e.target.closest('.edit-btn');
    const deleteBtn = e.target.closest('.delete-btn');

    if (editBtn) {
        const id = editBtn.dataset.id;
        fetch(`/siswa/${id}`)
            .then(res => res.json())
            .then(data => {
                const siswa = data.data;
                document.getElementById('studentNISN').value = siswa.nisn;
                document.getElementById('studentName').value = siswa.username;
                document.getElementById('studentGender').value = siswa.jenis_kelamin;
                document.getElementById('studentAge').value = siswa.Umur;
                document.getElementById('studentBirthDate').value = siswa.tanggal_lahir;
                document.getElementById('studentClass').value = siswa.kelas;
                document.getElementById('studentPhone').value = siswa.No_tlpOrtu;
                document.getElementById('studentAddress').value = siswa.alamat;

                modalTitle.textContent = 'Edit Siswa';
                studentModal.classList.remove('hidden');
                studentForm.dataset.editId = id;
            });
    }

    if (deleteBtn) {
        const id = deleteBtn.dataset.id;
        if (confirm('Yakin ingin menghapus data siswa ini?')) {
            fetch(`/siswa/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                showInfoModal(data.message || 'Data siswa berhasil dihapus.');
                deleteBtn.closest('tr').remove();
            })
            .catch(() => showInfoModal('Gagal menghapus data siswa.'));
        }
    }
});

printDataBtn.addEventListener('click', () => {
    const element = document.getElementById('student-data-printable-content');
    html2pdf(element, {
    margin: 0.3,
    filename: 'data-guru-paud-gemilang.pdf',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: {
        unit: 'mm',
        format: 'a4',
        orientation: 'landscape'  // agar muat lebar tabel
    }
    });
});
</script>
<style>
@media print {
    html, body {
        width: 100%;
        height: auto;
        margin: 0;
        padding: 0;
        overflow: visible;
    }

    #student-data-printable-content {
        width: 100% !important;
        overflow: visible !important;
        box-shadow: none !important;
        padding: 0.5in !important;
    }

    table {
        table-layout: auto !important;
        width: 100% !important;
    }

    th, td {
        word-break: break-word;
    }
}

@media (max-width: 640px) {
    table {
        font-size: 14px;
    }

    th, td {
        padding: 0.5rem;
    }

    /* Sembunyikan kolom alamat di layar kecil */
    th:nth-child(9), td:nth-child(9) {
        display: none;
    }

    /* Jadikan input lebih nyaman di modal */
    #studentModal input, #studentModal select {
        font-size: 16px;
    }
}
</style>
@endsection
