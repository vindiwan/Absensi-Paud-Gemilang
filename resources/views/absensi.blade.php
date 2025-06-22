@extends('layouts.app')

@section('title', 'Absensi Siswa PAUD Gemilang')

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Absensi Siswa PAUD Gemilang</h2>
        <p class="text-gray-600 dark:text-gray-400">Tanggal: <span
                id="tanggal">{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</span></p>
    </div>
    <!-- Kolom Pencarian -->
    <div class="mb-4">
        <input type="text" id="searchInput" placeholder="Cari Nama Siswa..."
            class="w-full border border-gray-300 dark:border-gray-600 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white dark:bg-gray-700 dark:text-gray-200" />
    </div>

    <form id="absensiForm">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md">
                <thead class="bg-indigo-500 text-white">
                    <tr>
                        <th class="py-2 px-4 border">ID Siswa</th>
                        <th class="py-2 px-4 border">Nama</th>
                        <th class="py-2 px-4 border">Kelas</th>
                        <th class="py-2 px-4 border">Status</th>
                    </tr>
                </thead>
                <tbody id="absensiBody">
                    @foreach ($siswa as $row)
                    <tr>
                        <td class="py-2 px-4 border">{{ $row->id }}</td>
                        <td class="py-2 px-4 border">{{ $row->username }}</td>
                        <td class="py-2 px-4 border">{{ $row->kelas }}</td>
                        <td class="py-2 px-4 border">
                        <div class="flex gap-1 status-buttons">
                            <button type="button" class="status-btn bg-blue-500 text-white rounded px-2 py-1" data-value="Hadir">Hadir</button>
                            <button type="button" class="status-btn bg-blue-500 text-white rounded px-2 py-1" data-value="Izin">Izin</button>
                            <button type="button" class="status-btn bg-blue-500 text-white rounded px-2 py-1" data-value="Sakit">Sakit</button>
                            <button type="button" class="status-btn bg-blue-500 text-white rounded px-2 py-1" data-value="Alpha">Tidak Hadir</button>
                        </div>
                            <input type="hidden" name="status[]" value="Hadir" class="status-input">
                            <input type="hidden" name="id[]" value="{{ $row->id }}">
                            <input type="hidden" name="username[]" value="{{ $row->username }}">
                            <input type="hidden" name="kelas[]" value="{{ $row->kelas }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-6 flex gap-4">
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-md">
                Simpan Absensi
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('absensiForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Ambil semua data absensi dari form
    let ids = Array.from(document.getElementsByName('id[]')).map(x => x.value);
    let usernames = Array.from(document.getElementsByName('username[]')).map(x => x.value);
    let kelas = Array.from(document.getElementsByName('kelas[]')).map(x => x.value);
    let statuses = Array.from(document.getElementsByClassName('status-input')).map(x => x.value);

    let absensiData = [];
    for (let i = 0; i < ids.length; i++) {
        absensiData.push({
            id: ids[i],
            username: usernames[i],
            kelas: kelas[i],
            status: statuses[i]
        });
    }

    fetch('/absensi', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                absensi: absensiData
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message ?? 'Berhasil simpan absensi!');
            // Optional: bisa redirect atau reload
        })
        .catch(error => {
            alert('Gagal menyimpan absensi');
        });
});

document.addEventListener('DOMContentLoaded', () => {
document.querySelectorAll('.status-buttons').forEach(group => {
    const buttons = group.querySelectorAll('.status-btn');
    const input = group.parentElement.querySelector('.status-input');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Reset semua tombol
                buttons.forEach(b => b.classList.remove('bg-blue-700', 'ring', 'ring-offset-2'));
                // Tandai tombol aktif
                btn.classList.add('bg-blue-700', 'ring', 'ring-offset-2');
                input.value = btn.dataset.value;
            });
        });
    });
});

// Optional: filter pencarian siswa
document.getElementById('searchInput').addEventListener('input', function() {
    const keyword = this.value.toLowerCase();
    const rows = document.querySelectorAll('#absensiBody tr');
    rows.forEach(row => {
        const nama = row.children[1].textContent.toLowerCase();
        const kelas = row.children[2].textContent.toLowerCase();
        if (nama.includes(keyword) || kelas.includes(keyword)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
@endsection