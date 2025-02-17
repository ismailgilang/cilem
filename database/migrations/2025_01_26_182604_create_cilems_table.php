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
        Schema::create('cilems', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik');
            $table->string('banyak');
            $table->string('harga_asli');
            $table->string('uang_muka');
            $table->string('pembiayaan');
            $table->string('adm');
            $table->string('tot_adm');
            $table->string('angsuran');
            $table->string('bayar_angsuran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cilems');
    }
};
