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
        Schema::create('survey', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bisnis');
            $table->string('jenis_usaha');
            $table->string('nama_pic');
            $table->bigInteger('no_hp');
            $table->bigInteger('no_pelanggan');
            $table->string('alamat');
            $table->string('foto');
            $table->string('status')->default('none');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
