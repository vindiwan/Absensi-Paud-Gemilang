<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rapor', function (Blueprint $table) {
            $table->json('aspek')->nullable()->after('wali_kelas');
        });
    }

    public function down()
    {
        Schema::table('rapor', function (Blueprint $table) {
            $table->dropColumn('aspek');
        });
    }
};