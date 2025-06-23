<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index()
    {
        $guru = DB::table('users_guru')->get();
        return view('dataguru', compact('guru'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'      => 'required|string|unique:users_guru,username',
            'name'          => 'required|string',
            'nip'           => 'required|string|unique:users_guru,NIP',
            'email'         => 'required|email|unique:users_guru,email',
            'birthDate'     => 'required|date',
            'education'     => 'required|string',
            'address'       => 'required|string',
            'password'      => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data tidak valid',
                'errors'  => $validator->errors(),
            ], 422);
        }

        DB::table('users_guru')->insert([
            'username'      => $request->username,
            'nama_lengkap'  => $request->name,
            'NIP'           => $request->nip,
            'tanggal_lahir' => $request->birthDate,
            'Pendidikan'    => $request->education,
            'alamat'        => $request->address,
            'jenis_kelamin' => 'Laki-laki',
            'email'         => $request->email,
            'password'      => bcrypt('passwordguru'),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        $data = DB::table('users_guru')->orderByDesc('created_at')->first();

        return response()->json([
            'message' => 'Guru berhasil disimpan!',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $guru = DB::table('users_guru')->where('id', $id)->first();
        return response()->json(['data' => $guru]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users_guru,username,' . $id,
            'name'     => 'required|string',
            'nip'      => 'required|string|unique:users_guru,NIP,' . $id,
            'email'    => 'required|email|unique:users_guru,email,' . $id,
            'birthDate'=> 'required|date',
            'education'=> 'required|string',
            'address'  => 'required|string',
            'password'  => 'nullable|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

         $data = [
            'username'      => $request->username,
            'nama_lengkap'  => $request->name,
            'NIP'           => $request->nip,
            'email'         => $request->email,
            'tanggal_lahir' => $request->birthDate,
            'Pendidikan'    => $request->education,
            'alamat'        => $request->address,
            'updated_at'    => now()
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        DB::table('users_guru')->where('id', $id)->update($data);

        $updated = DB::table('users_guru')->where('id', $id)->first();

        return response()->json([
            'message' => 'Data guru berhasil diperbarui',
            'data' => $updated
        ]);
    }

    public function destroy($id)
    {
        DB::table('users_guru')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Guru berhasil dihapus.'
        ]);
    }

}
