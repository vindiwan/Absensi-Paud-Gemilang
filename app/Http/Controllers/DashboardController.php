<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Total siswa terdaftar (dari users_siswa)
        $totalSiswa = DB::table('users_siswa')->count();

        // Data absensi hari ini
        $absensiHariIni = DB::table('absensi')
            ->whereDate('tanggal', $today)
            ->get();

        $totalHadir = $absensiHariIni->where('status', 'Hadir')->count();
        $totalTidakHadir = $absensiHariIni->whereIn('status', ['Sakit', 'Izin', 'Alpha'])->count();

        return view('dashboard', [
            'totalSiswa' => $totalSiswa,
            'totalHadir' => $totalHadir,
            'totalTidakHadir' => $totalTidakHadir,
        ]);

        $absensiHariIni = DB::table('absensi')->whereDate('tanggal', $filterTanggal)->get();
        $filterTanggal = $request->input('tanggal') ?? Carbon::today()->toDateString();
    }
}