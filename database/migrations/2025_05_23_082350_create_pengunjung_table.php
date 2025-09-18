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
        Schema::create('pengunjung', function (Blueprint $table) {
            $table->id('id_pengunjung');
            $table->date('tanggal'); 
            $table->string('nama', 100);
            $table->integer('angkatan')->nullable();
            $table->string('jurusan', 50)->nullable();
            $table->string('kelas', 10)->nullable(); 
            $table->text('keluhan')->nullable();
            $table->string('terapi', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengunjung');
    }
};
