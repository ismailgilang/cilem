<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('name');
            $table->string('cif')->unique();
            $table->string('portofolio');
            $table->string('penempatan');
            $table->string('dana');
            $table->string('waktu');
            $table->date('tanggal');
            $table->string('ajuan_nisbah');
            $table->string('nisbah_rate')->nullable();
            $table->string('status')->nullable();
            $table->string('persetujuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabahs');
    }
};
