<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    // TAMPILKAN DATA SISWA
    public function index()
    {
        $siswa = DB::table('users_siswa')->get();
        return view('datasiswa', compact('siswa'));
    }

    // TAMBAH DATA SISWA VIA AJAX
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn'          => 'required|unique:users_siswa,nisn',
            'name'          => 'required|string',
            'gender'        => 'required|string',
            'age'           => 'required|integer',
            'birthDate'     => 'required|date',
            'class'         => 'required|string',
            'phone'         => 'required|string',
            'address'       => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data tidak valid',
                'errors'  => $validator->errors(),
            ], 422);
        }

        DB::table('users_siswa')->insert([
            'nisn'          => $request->nisn,
            'username'      => $request->name,
            'Umur'          => $request->age,
            'tanggal_lahir' => $request->birthDate,
            'kelas'         => $request->class,
            'No_tlpOrtu'    => $request->phone,
            'alamat'        => $request->address,
            'jenis_kelamin' => $request->gender, // Default, sesuaikan jika perlu
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        $data = DB::table('users_siswa')->orderByDesc('created_at')->first();

        return response()->json([
            'message' => 'Siswa berhasil disimpan!',
            'data' => $data
        ]);
    }
    
    public function show($id)
    {
        $siswa = DB::table('users_siswa')->where('id', $id)->first();
        return response()->json(['data' => $siswa]);
    }

    public function update(Request $request, $id)
    {
    $validator = Validator::make($request->all(), [
        'nisn' => [
        'required',
        Rule::unique('users_siswa', 'nisn')->ignore($id),
    ],
        'name'      => 'required|string',
        'gender'    => 'required|string',
        'age'       => 'required|integer',
        'birthDate' => 'required|date',
        'class'     => 'required|string',
        'phone'     => 'required|string',
        'address'   => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validasi gagal',
            'errors' => $validator->errors(),
        ], 422);
    }

    DB::table('users_siswa')->where('id', $id)->update([
        'nisn'          => $request->nisn,
        'username'      => $request->name,
        'jenis_kelamin' => $request->gender,
        'Umur'          => $request->age,
        'tanggal_lahir' => $request->birthDate,
        'kelas'         => $request->class,
        'No_tlpOrtu'    => $request->phone,
        'alamat'        => $request->address,
        'updated_at' => now(),
    ]);
    $updatedData = DB::table('users_siswa')->where('id', $id)->first();

    return response()->json([
        'message' => 'Data siswa berhasil diperbarui',
        'data'    => $updatedData
    ]);
    }
    public function destroy($id)
    {
        DB::table('users_siswa')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Siswa berhasil dihapus.'
        ]);
    }
}