@extends('layouts.app')

@section('title', 'Rekap Absensi Siswa')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-2xl font-bold mb-4 text-indigo-700">Rekap Absensi Siswa</h1>

    <!-- FILTER -->
    <form method="GET" class="flex flex-wrap gap-4 mb-6">
        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border rounded p-2" />
        <select name="kelas" class="border rounded p-2">
            <option value="">Semua Kelas</option>
            @foreach($allKelas as $k)
            <option value="{{ $k }}" @selected(request('kelas')==$k)>{{ $k }}</option>
            @endforeach
        </select>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded" type="submit">Filter</button>
        <a href="{{ route('rekapabsen') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Reset</a>
    </form>

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="py-2 px-4">No</th>
                    <th class="py-2 px-4">Nama</th>
                    <th class="py-2 px-4">Kelas</th>
                    <th class="py-2 px-4">Tanggal</th>
                    <th class="py-2 px-4">Status</th>
                    <th class="py-2 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absensi as $i => $row)
                <tr class="border-b border-gray-200">
                    <td class="py-2 px-4">{{ $i + 1 }}</td>
                    <td class="py-2 px-4">{{ $row->username }}</td>
                    <td class="py-2 px-4">{{ $row->kelas }}</td>
                    <td class="py-2 px-4">{{ $row->tanggal }}</td>
                    <td class="py-2 px-4">{{ $row->status }}</td>
                    <td class="py-2 px-4">
                        <form action="{{ route('absensi.destroy', $row->id) }}" method="POST"
                            onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-6 text-center text-gray-400">Tidak ada data absensi ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection