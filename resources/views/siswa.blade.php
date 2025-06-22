<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nilai Rapor - PAUD Gemilang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-4">
    <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-lg p-6">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <h1 class="text-2xl font-bold text-blue-700">PAUD Gemilang</h1>
            <!-- Ubah p ini menjadi span dengan id agar bisa disesuaikan -->
            <p id="current-date" class="text-gray-500"></p>
        </div>

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-700">Daftar Siswa Kelas A</h2>
            <div class="flex gap-2">
                <button id="add-student-btn" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg">+
                    Tambah Siswa</button>
                <button onclick="window.location.href='dbrapor.html'"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Kembali</button>
            </div>
        </div>

        <!-- Form Tambah Siswa (disembunyikan) -->
        <div id="add-student-form" class="bg-gray-50 p-4 rounded-lg mb-4 hidden">
            <h3 class="text-lg font-semibold mb-2">Tambah Siswa</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <input id="new-name" type="text" placeholder="Nama Siswa" class="p-2 border rounded" />
                <input id="new-nis" type="text" placeholder="NIS" class="p-2 border rounded" />
                <input id="new-age" type="number" placeholder="Usia" class="p-2 border rounded" />
            </div>
            <button id="save-student-btn"
                class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>

        <div class="mb-6">
            <input type="text" placeholder="Cari siswa..."
                class="w-full p-3 rounded-xl border border-gray-300 shadow-sm" />
        </div>

        <div id="student-cards" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Kartu siswa dimuat lewat JS -->
        </div>
    </div>

    <script>
    // Update tanggal saat ini
    const currentDateElement = document.getElementById('current-date');
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
        'November', 'Desember'
    ];

    const now = new Date();
    const dayName = days[now.getDay()];
    const dayNumber = now.getDate();
    const monthName = months[now.getMonth()];
    const year = now.getFullYear();

    const formattedDate = `${dayName}, ${dayNumber} ${monthName} ${year}`;
    currentDateElement.textContent = formattedDate;


    const studentCards = document.getElementById('student-cards');

    function renderStudents() {
        studentCards.innerHTML = '';
        students.sort((a, b) => a.name.localeCompare(b.name)); // Urutkan abjad

        students.forEach(student => {
            const card = document.createElement('div');
            card.className = 'bg-white border rounded-xl p-4 shadow';

            let buttons = '';
            if (student.hasReport) {
                buttons = `
          <div class="flex gap-2 mt-2">
            <a href="lihat_rapor.html?id=${student.id}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg">Lihat</a>
            <a href="edit_rapor.html?id=${student.id}" class="border border-gray-400 px-4 py-2 rounded-lg flex items-center gap-1 text-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-4.586-7.414a2 2 0 112.828 2.828L11 16l-4 1 1-4 7.414-7.414z" />
              </svg> Edit
            </a>
          </div>`;
            } else {
                buttons =
                    `
          <p class="text-red-500 italic">Belum ada rapor</p>
          <a href="buat_rapor.html?id=${student.id}" class="mt-2 inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">+ Buat</a>`;
            }

            card.innerHTML = `
          <h3 class="text-lg font-semibold">${student.name}</h3>
          <p><strong>NIS:</strong> ${student.nis}</p>
          <p><strong>Usia:</strong> ${student.age} tahun</p>
          ${buttons}
        `;
            studentCards.appendChild(card);
        });
    }

    renderStudents();

    // Tampilkan form tambah
    document.getElementById('add-student-btn').addEventListener('click', () => {
        document.getElementById('add-student-form').classList.toggle('hidden');
    });

    // Simpan data siswa baru
    document.getElementById('save-student-btn').addEventListener('click', () => {
        const name = document.getElementById('new-name').value.trim();
        const nis = document.getElementById('new-nis').value.trim();
        const age = parseInt(document.getElementById('new-age').value);

        if (name && nis && age) {
            const newId = students.length ? Math.max(...students.map(s => s.id)) + 1 : 1;
            students.push({
                id: newId,
                name,
                nis,
                age,
                hasReport: false
            });
            renderStudents();

            // Reset dan sembunyikan form
            document.getElementById('new-name').value = '';
            document.getElementById('new-nis').value = '';
            document.getElementById('new-age').value = '';
            document.getElementById('add-student-form').classList.add('hidden');
        } else {
            alert('Mohon lengkapi semua kolom!');
        }
    });
    </script>
</body>

</html>