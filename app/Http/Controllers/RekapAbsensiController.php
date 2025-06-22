<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapAbsensiController extends Controller
{
    public function rekapHarian(Request $request)
{
    $kelas = $request->kelas;
    $tanggal = $request->tanggal;

    $query = DB::table('absensi')
        ->select(
            'absensi.id',
            'absensi.username as nama',
            'absensi.kelas',
            'absensi.tanggal',
            'absensi.status'
        );

    if ($kelas) {
        $query->where('absensi.kelas', $kelas);
    }

    if ($tanggal) {
        $query->whereDate('absensi.tanggal', $tanggal);
    }

    // ✅ Hapus ORDER BY yang menyebabkan error
    $data = $query->orderBy('absensi.username')->get();

    return response()->json($data);
}

    public function rekapBulanan(Request $request)
    {
        $kelas = $request->kelas;
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = DB::table('absensi')
            ->select('username', 'kelas', DB::raw('MONTH(tanggal) as bulan'), DB::raw('YEAR(tanggal) as tahun'), 'status')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun);

        if ($kelas) {
            $query->where('kelas', $kelas);
        }

        $data = $query->get();

        // Hitung rekap per siswa
        $rekap = [];

        foreach ($data as $row) {
            $key = "{$row->username}-{$row->kelas}";
            if (!isset($rekap[$key])) {
                $rekap[$key] = [
                    'nama' => $row->username,
                    'kelas' => $row->kelas,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'hadir' => 0,
                    'sakit' => 0,
                    'izin' => 0,
                    'alpha' => 0,
                ];
            }

            switch ($row->status) {
                case 'Hadir': $rekap[$key]['hadir']++; break;
                case 'Sakit': $rekap[$key]['sakit']++; break;
                case 'Izin':  $rekap[$key]['izin']++;  break;
                case 'Alpha': $rekap[$key]['alpha']++; break;
            }
        }

        // Hitung persentase kehadiran
        $rekap = array_map(function ($item) {
            $total = $item['hadir'] + $item['sakit'] + $item['izin'] + $item['alpha'];
            $item['persentase'] = $total > 0 ? round(($item['hadir'] / $total) * 100, 2) . '%' : '0%';
            return $item;
        }, $rekap);

        return response()->json(array_values($rekap));
    }
}
