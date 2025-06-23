@extends('layouts.app')

@section('title', 'Data Guru - PAUD Gemilang')

@section('content')
<div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
    <header class="mb-6 text-center">
        <h1 class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">Data Guru PAUD Gemilang</h1>
    </header>

    <section class="mb-6 flex justify-between items-center">
        <div class="flex gap-4">
            <button id="addTeacherBtn"
                class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700 transition">
                Tambah Guru Baru
            </button>
            <button id="printDataBtn" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">
                Cetak Data
            </button>
        </div>
        <input type="text" id="searchInput" placeholder="Cari guru..."
            class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-60 focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:bg-gray-700 dark:text-gray-200" />
    </section>

    <div id="teacher-data-printable-content" class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-x-auto print:overflow-visible">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Daftar Guru</h2>
        <table
            class="table-auto whitespace-nowrap border border-gray-300 dark:border-gray-600 border-collapse rounded-md overflow-hidden text-sm">
            <thead class="bg-indigo-600 text-white text-left">
                <tr>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">No</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Nama Guru</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">NIP</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">email</th>
                    <th class="px-4 py-2 whitespace-nowrap border border-gray-300 dark:border-gray-600">Tanggal Lahir</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Jabatan</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Alamat</th>
                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 print:hidden">Aksi</th>
                </tr>
            </thead>
            <tbody id="teacherTableBody">
                @forelse($guru as $i => $g)
                <tr>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 whitespace-nowrap">{{ $i + 1 }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 whitespace-nowrap">{{ $g->nama_lengkap }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 whitespace-nowrap">{{ $g->NIP }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 whitespace-nowrap">{{ $g->email }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 whitespace-nowrap">{{ $g->tanggal_lahir }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 whitespace-nowrap">{{ $g->Pendidikan }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 whitespace-nowrap">{{ $g->alamat }}</td>
                    <td class="px-4 py-2 border print:hidden">
                        <div class="flex items-center justify-center space-x-3">
                            <button class="edit-teacher-btn text-blue-600 hover:text-blue-800 print:hidden" title="Edit" data-id="{{ $g->id }}">
                                <i data-feather="edit"></i>
                            </button>
                            <button class="delete-teacher-btn text-red-600 hover:text-red-800 print:hidden" title="Hapus" data-id="{{ $g->id }}">
                                <i data-feather="trash-2"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500 dark:text-gray-400">Data guru tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Guru -->
<div id="teacherModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-md max-h-[90vh] overflow-hidden flex flex-col">
        <div class="overflow-y-auto px-6 py-4 space-y-4 flex-1">
            <h2 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200" id="modalTitle">Tambah Guru</h2>
            <form id="teacherForm" class="space-y-4">
            @csrf
            <div>
                <label for="teacherName" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Nama
                    Guru</label>
                <input type="text" id="teacherName"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full" required />
            </div>
            <div>
                <label for="teacherNIP" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">NIP</label>
                <input type="text" id="teacherNIP"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full" required />
            </div>
            <div>
                <label for="teacherEmail" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Email</label>
                <input type="email" id="teacherEmail"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full" required />
            </div>
            <div>
                <label for="teacherBirthDate" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Tanggal
                    Lahir</label>
                <input type="date" id="teacherBirthDate"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full" required />
            </div>
            <div>
                <label for="teacherEducation"
                    class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Jabatan</label>
                <input type="text" id="teacherEducation"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full" required />
            </div>
            <div>
                <label for="teacherAddress"
                    class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Alamat</label>
                <input type="text" id="teacherAddress"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full" required />
            <div>
                <label for="teacherUsername" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Username</label>
                <input type="text" id="teacherUsername"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full" required />
            </div>
            <div id="passwordFieldWrapper">
                <label for="teacherPassword" class="block font-semibold mb-1 text-gray-800 dark:text-gray-200">Password</label>
                <input type="password" id="teacherPassword"
                    class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full"/>
            </div>
            <button type="button" id="togglePasswordField" class="text-sm text-blue-600 hover:underline hidden">
                Ubah Password
            </button>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" id="cancelBtn"
                    class="px-4 py-2 rounded border border-gray-400 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                    Batal
                </button>
                <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700 transition">
                    Simpan
                </button>
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
const passwordWrapper = document.getElementById('passwordFieldWrapper');
const addTeacherBtn = document.getElementById('addTeacherBtn');
const printDataBtn = document.getElementById('printDataBtn');
const teacherModal = document.getElementById('teacherModal');
const cancelBtn = document.getElementById('cancelBtn');
const teacherForm = document.getElementById('teacherForm');
const teacherTableBody = document.getElementById('teacherTableBody');
const modalTitle = document.getElementById('modalTitle');
const togglePasswordBtn = document.getElementById('togglePasswordField');


// Info modal helper
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

addTeacherBtn.addEventListener('click', () => {
    teacherModal.classList.remove('hidden');
    teacherForm.reset();
    modalTitle.textContent = 'Tambah Guru';

    passwordWrapper.classList.remove('hidden');
    togglePasswordBtn.classList.add('hidden'); // Sembunyikan tombol ubah password
    teacherForm.teacherPassword.required = true;
    delete teacherForm.dataset.editId;
});

cancelBtn.addEventListener('click', () => {
    teacherModal.classList.add('hidden');
    teacherForm.reset();
});

// AJAX insert ke backend
teacherForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = teacherForm.teacherName.value.trim();
    const username = teacherForm.teacherUsername.value.trim();
    const nip = teacherForm.teacherNIP.value.trim();
    const email = teacherForm.teacherEmail.value.trim();
    const birthDate = teacherForm.teacherBirthDate.value;
    const education = teacherForm.teacherEducation.value.trim();
    const address = teacherForm.teacherAddress.value.trim();


    const isEdit = teacherForm.dataset.editId;
    const url = isEdit ? `/guru/${isEdit}` : '/guru';
    const method = isEdit ? 'PUT' : 'POST';

    fetch(url, {
        method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                username,
                name,
                nip,
                email,
                birthDate,
                education,
                address,
                password: teacherForm.teacherPassword.value.trim()
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
            showInfoModal(data.message || 'Guru berhasil disimpan!');
            // Tambahkan baris ke tabel langsung tanpa reload
            const tbody = document.getElementById('teacherTableBody');
            const count = tbody.rows.length;
            const g = data.data;
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="px-4 py-2 border">${count + 1}</td>
                <td class="px-4 py-2 border">${g.nama_lengkap}</td>
                <td class="px-4 py-2 border">${g.NIP}</td>
                <td class="px-4 py-2 border">${g.email}</td>
                <td class="px-4 py-2 border">${g.tanggal_lahir}</td>
                <td class="px-4 py-2 border">${g.Pendidikan}</td>
                <td class="px-4 py-2 border">${g.alamat}</td>
                <td class="px-4 py-2 border print:hidden"></td>
        `;
            tbody.appendChild(newRow);
            teacherModal.classList.add('hidden');
            teacherForm.reset();
        })
        .catch(err => {
            let errorMsg = 'Gagal menyimpan data!';
            if (err && err.errors) {
                errorMsg += '<br>' + Object.values(err.errors).join('<br>');
            }
            showInfoModal(errorMsg);
        });
});

printDataBtn.addEventListener('click', () => {
    const element = document.getElementById('teacher-data-printable-content');
    html2pdf(element, {
        
        margin: 0.3,
        filename: 'data-guru-paud-gemilang.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: {
            unit: 'mm',
            format: 'a4',
            orientation: 'landscape'
        }
    });
});

document.addEventListener('click', function (e) {
    if (e.target.closest('.edit-teacher-btn')) {
        const id = e.target.closest('.edit-teacher-btn').dataset.id;
        fetch(`/guru/${id}`)
            .then(res => res.json())
            .then(data => {
                const g = data.data;
                teacherForm.teacherName.value = g.nama_lengkap;
                teacherForm.teacherUsername.value = g.username;
                teacherForm.teacherNIP.value = g.NIP;
                teacherForm.teacherEmail.value = g.email;
                teacherForm.teacherBirthDate.value = g.tanggal_lahir;
                teacherForm.teacherEducation.value = g.Pendidikan;
                teacherForm.teacherAddress.value = g.alamat;
                teacherForm.dataset.editId = id;
                modalTitle.textContent = 'Edit Guru';
                teacherModal.classList.remove('hidden');

                passwordWrapper.classList.add('hidden'); // Sembunyikan field password saat edit
                teacherForm.teacherPassword.required = false;
                togglePasswordBtn.classList.remove('hidden');
                teacherForm.dataset.editId = id;
                modalTitle.textContent = 'Edit Guru';
                teacherModal.classList.remove('hidden');
            });
    }

    if (e.target.closest('.delete-teacher-btn')) {
        const id = e.target.closest('.delete-teacher-btn').dataset.id;
        if (confirm('Yakin ingin menghapus data guru ini?')) {
            fetch(`/guru/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                showInfoModal(data.message || 'Data guru berhasil dihapus.');
                e.target.closest('tr').remove();
            })
            .catch(() => showInfoModal('Gagal menghapus data guru.'));
        }
    }
});

feather.replace();

togglePasswordBtn.addEventListener('click', () => {
    passwordWrapper.classList.remove('hidden');
    teacherForm.teacherPassword.required = true;
    togglePasswordBtn.classList.add('hidden');
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

    #teacher-data-printable-content {
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
</style>
@endsection
