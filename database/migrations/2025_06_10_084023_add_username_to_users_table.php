<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // TABEL GURU
        Schema::create('users_guru', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique(); // untuk login
            $table->string('nama_lengkap');       // untuk tampilan
            $table->string('email')->unique();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('password');
            $table->string('NIP');
            $table->string('Pendidikan');
            $table->rememberToken();
            $table->timestamps();
        });
        

        // TABEL SISWA
        Schema::create('users_siswa', function (Blueprint $table) {
            $table->id(); // Auto increment primary key
            $table->string('nisn')->unique(); // Input NISN dari user
            $table->string('username');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->integer('Umur');
            $table->date('tanggal_lahir');
            $table->string('kelas');
            $table->string('No_tlpOrtu');
            $table->text('alamat');
            $table->timestamps();
        });

        // TABEL ABSENSI
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('username');
            $table->string('kelas');
            $table->date('tanggal');
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpha']);
            $table->timestamps();
        });
        
        Schema::create('rapor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('users_siswa')->onDelete('cascade');

            $table->string('username');
            $table->string('kelas');
            $table->string('jenis_kelamin');
            $table->string('nisn');
            $table->text('catatan_wali')->nullable();
            $table->integer('hadir')->default(0);
            $table->integer('izin')->default(0);
            $table->integer('sakit')->default(0);
            $table->integer('alpha')->default(0);
            $table->string('wali_kelas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
        Schema::dropIfExists('users_siswa');
        Schema::dropIfExists('users_guru');

        Schema::dropIfExists('rapor');
    }

    
    
};