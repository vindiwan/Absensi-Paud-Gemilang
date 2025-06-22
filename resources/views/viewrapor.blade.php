<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PAUD Gemilang - Lihat Rapor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
    <style>
    @media print {
        .print\:hidden {
            display: none !important;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
        }

        #rapor-container {
            box-shadow: none !important;
            margin: 0 !important;
            padding: 0.5in !important;
            width: 100%;
        }
    }
    </style>
</head>

<body class="bg-gray-100">
    <div id="rapor-container" class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow text-sm mt-0">

        <!-- Header -->
        <div class="text-left border-b-2 border-indigo-500 mb-8 pb-5">
            <h1 class="text-2xl font-bold text-indigo-600 uppercase">PAUD GEMILANG</h1>
            <p class="text-gray-600">Jl. Benda Baru No.6 RT.06/01 Pamulang, Tangerang Selatan</p>
            <p class="text-gray-600">Telp: 0896-1234-5678</p>
        </div>

        <!-- Info Siswa -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Data Siswa</h2>
            <table class="w-full border text-left">
                <tbody>
                    <tr>
                        <td class="p-2 w-1/3">Nama</td>
                        <td class="p-2">: Ahmad Ramadhan</td>
                    </tr>
                    <tr>
                        <td class="p-2">Jenis Kelamin</td>
                        <td class="p-2">: Laki-laki</td>
                    </tr>
                    <tr>
                        <td class="p-2">Kelas</td>
                        <td class="p-2">: B</td>
                    </tr>
                    <tr>
                        <td class="p-2">Wali Kelas</td>
                        <td class="p-2">: Ibu Siti</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Nilai -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Nilai Rapor</h2>
            <table class="w-full border-collapse border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="border p-2">Aspek</th>
                        <th class="border p-2">Nilai</th>
                        <th class="border p-2">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border p-2">Motorik</td>
                        <td class="border p-2">★★★★★</td>
                        <td class="border p-2">Mampu menggerakkan anggota tubuh dengan baik.</td>
                    </tr>
                    <tr>
                        <td class="border p-2">Bahasa</td>
                        <td class="border p-2">★★★☆☆</td>
                        <td class="border p-2">Dapat memahami instruksi sederhana.</td>
                    </tr>
                    <tr>
                        <td class="border p-2">Sosial Emosional</td>
                        <td class="border p-2">★★★★★</td>
                        <td class="border p-2">Dapat berinteraksi dengan teman sebayanya.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Kehadiran -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Kehadiran</h2>
            <table class="w-full border-collapse border border-gray-300 text-sm">
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
                        <td class="border p-2 text-center">120</td>
                        <td class="border p-2 text-center">5</td>
                        <td class="border p-2 text-center">3</td>
                        <td class="border p-2 text-center">2</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Catatan -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Catatan Wali Kelas</h2>
            <p class="text-gray-700">Ahmad menunjukkan perkembangan yang baik selama semester ini. Terus pertahankan
                semangat
                belajarnya!</p>
        </div>

        <!-- Tanda Tangan -->
        <div class="flex justify-end mt-10">
            <div class="text-center">
                <p>Tangerang Selatan, 20 Juni 2025</p>
                <p>Wali Kelas</p>
                <div class="h-16"></div>
                <p class="font-semibold">Ibu Siti</p>
            </div>
        </div>

        <!-- Tombol Aksi (tidak dicetak) -->
        <div class="flex justify-between mt-10 print:hidden">
            <button onclick="window.history.back()"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Kembali
            </button>
            <div class="flex gap-2">
                <button onclick="printRapor()"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded">
                    Cetak Rapor
                </button>
                <button onclick="window.location.href='/edit-rapor'"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                    Edit Rapor
                </button>
            </div>
        </div>
    </div>

    <!-- Script Cetak -->
    <script>
    function printRapor() {
        window.print();
    }
    </script>
</body>

</html>