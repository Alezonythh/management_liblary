<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pinjam_bukus', function (Blueprint $table) {
            if (!Schema::hasColumn('pinjam_bukus', 'status')) {
                $table->string('status')->default('menunggu konfirmasi')->after('tanggal_kembali');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pinjam_bukus', function (Blueprint $table) {
            //
        });
    }
};
