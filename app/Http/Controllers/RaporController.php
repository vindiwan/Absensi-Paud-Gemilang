<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RaporController extends Controller
{
    // TAMPILKAN FORM INPUT RAPOR
public function index()
{
    $siswa = DB::table('users_siswa')->get()->map(function ($s) {
        return [
            'id' => $s->id,
            'nisn' => $s->nisn,
            'name' => $s->username,
            'kelas' => $s->kelas,
            'gender' => $s->jenis_kelamin,
            'age' => $s->Umur,
            'hasReport' => false,
        ];
    })->values()->toArray();

    $rapor = DB::table('rapor')->get()->map(function ($item) {
        return [
            'siswa_id' => $item->siswa_id,
            'nisn' => (string) $item->nisn,
            'studentName' => $item->username,
            'gender' => $item->jenis_kelamin,
            'class' => $item->kelas,
            'aspects' => json_decode($item->aspek, true),
            'specialNotes' => $item->catatan_wali,
            'presentDays' => $item->hadir,
            'permitDays' => $item->izin,
            'sickDays' => $item->sakit,
            'absentDays' => $item->alpha,
            'teacherName' => $item->wali_kelas,
            'reportDate' => $item->created_at
                ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d')
                : now()->format('Y-m-d'),
        ];
    });

    // Ambil data rapor dan decode aspek
    $rapor = DB::table('rapor')->get()->map(function ($item) {
        $item->aspek = json_decode($item->aspek, true);
        $item->nisn = (string) ($item->nisn ?? '');
        return $item;
    });

    return view('dbrapor', compact('siswa', 'rapor'));
    }

    public function create($username)
    {
        $siswa = DB::table('users_siswa')->where('username', $username)->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
        }

        return view('dbrapor', compact('siswa'));
    }
    // SIMPAN RAPOR BARU
public function store(Request $request)
{
    if (!$request->isJson()) {
        return response()->json(['message' => 'Request harus berupa JSON'], 400);
    }

    $data = $request->json()->all();

    // Validasi secara manual agar error bisa direspons sebagai JSON
    $validator = Validator::make($data, [
        'siswa_id' => 'required|exists:users_siswa,id',
        'kelas' => 'required|string',
        'jenis_kelamin' => 'required|string',
        'nisn' => 'required|string',
        'hadir' => 'required|integer',
        'izin' => 'required|integer',
        'sakit' => 'required|integer',
        'alpha' => 'required|integer',
        'wali_kelas' => 'required|string',
        'catatan_wali' => 'nullable|string',
        'aspek' => 'nullable|json',
    ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);     
        }
        


    $siswa = DB::table('users_siswa')->where('id', $data['siswa_id'])->first();

    DB::table('rapor')->updateOrInsert(
        ['siswa_id' => $data['siswa_id']],
        [
            'username' => $siswa->username,
            'kelas' => $data['kelas'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'nisn' => $data['nisn'],
            'hadir' => $data['hadir'],
            'izin' => $data['izin'],
            'sakit' => $data['sakit'],
            'alpha' => $data['alpha'],
            'wali_kelas' => $data['wali_kelas'],
            'catatan_wali' => $data['catatan_wali'],
            'aspek' => json_encode(json_decode($data['aspek']), JSON_UNESCAPED_UNICODE),
            'updated_at' => now(),
            'created_at' => now(),
        ]
    );

    return response()->json(['message' => 'Data rapor berhasil disimpan.']);
}
    
    // TAMPILKAN DETAIL RAPOR
    public function show($nisn)
    {
        $siswa = DB::table('users_siswa')->where('nisn', $nisn)->first();
        $rapor = DB::table('rapor')->where('nisn', $nisn)->first();

        if (!$rapor) {
            return redirect()->back()->with('error', 'Rapor tidak ditemukan.');
        }

        $rapor->aspek = json_decode($rapor->aspek, true);
        return view('rapor.view', compact('siswa', 'rapor'));
    }

    // CETAK PDF (opsional)
    public function cetak($nisn)
    {
        $siswa = DB::table('users_siswa')->where('nisn', $nisn)->first();
        $rapor = DB::table('rapor')->where('nisn', $nisn)->first();

        if (!$rapor) {
            return redirect()->back()->with('error', 'Rapor tidak ditemukan.');
        }

        $rapor->aspek = json_decode($rapor->aspek, true);

        // Contoh untuk PDF: bisa gunakan dompdf atau library lainnya
        return view('rapor.pdf', compact('siswa', 'rapor'));
    }
}
