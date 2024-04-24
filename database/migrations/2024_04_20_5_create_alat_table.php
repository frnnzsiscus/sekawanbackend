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
        Schema::create('alat', function (Blueprint $table) {
            $table->integer('alat_id')->autoIncrement();
            $table->integer('alat_kategori_id')->nullable(false);
            $table->string('alat_nama')->nullable(false);
            $table->string('alat_deskripsi')->nullable(false);
            $table->char('alat_hargaperhari')->nullable(false);
            $table->char('alat_stok')->nullable(false);
            $table->timestamps();

            $table->foreign('alat_kategori_id')->references('kategori_id')->on('kategori')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat');
    }
};
