<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    // Tampilkan daftar siswa dari users_siswa
    public function index()
    {
        $siswa = DB::table('users_siswa')->get();
        return view('absensi', compact('siswa'));
    }

    // Simpan data absensi ke tabel absensi
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'absensi' => 'required|array',
        'absensi.*.id' => 'required|integer|exists:users_siswa,id',
        'absensi.*.username' => 'required|string',
        'absensi.*.kelas' => 'required|string',
        'absensi.*.status' => 'required|in:Hadir,Izin,Sakit,Alpha',
    ]);

    $tanggal = date('Y-m-d');

    foreach ($request->absensi as $item) {
        // Cek apakah sudah ada absensi untuk user ini di tanggal ini
        $existing = DB::table('absensi')
            ->where('username', $item['username'])
            ->where('tanggal', $tanggal)
            ->first();

        if ($existing) {
            // Jika sudah ada, update
            DB::table('absensi')
                ->where('id', $existing->id)
                ->update([
                    'kelas'      => $item['kelas'],
                    'status'     => $item['status'],
                    'updated_at' => now(),
                ]);
        } else {
            // Jika belum ada, insert
            DB::table('absensi')->insert([
                'siswa_id' => $item['id'], // ← ini WAJIB!
                'username'   => $item['username'],
                'kelas'      => $item['kelas'],
                'tanggal'    => $tanggal,
                'status'     => $item['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return response()->json(['message' => 'Absensi berhasil disimpan!']);
}


    // Tampil rekap (list absensi + filter)
    public function rekap(Request $request)
    {
        // Ambil semua kelas unik dari absensi
        $allKelas = DB::table('absensi')->distinct()->pluck('kelas');
        
        $query = DB::table('absensi');
        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }
        $absensi = $query->orderByDesc('tanggal')->orderBy('kelas')->get();

        return view('rekapabsen', [
            'absensi' => $absensi,
            'allKelas' => $allKelas,
        ]);
    }

    // Hapus data absensi
    public function destroy($id)
    {
        DB::table('absensi')->where('id', $id)->delete();
        return back()->with('success', 'Data absensi berhasil dihapus');
    }

}