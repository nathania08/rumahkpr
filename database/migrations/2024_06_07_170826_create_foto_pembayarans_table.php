<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('foto_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_transfer');
            $table->string('foto');
            $table->text('catatan')->nullable();
            $table->integer('jumlah_transfer');
            $table->integer('pembayaran_id');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_pembayarans');
    }
};
