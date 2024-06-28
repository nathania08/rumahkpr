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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('no_identitas');
            $table->string('pekerjaan');
            $table->string('gaji');
            $table->text('alamat');
            $table->enum('jenis_pembayaran', ['tabungan_mandiri', 'tabungan_lainnya']);
            $table->timestamp('janji_temu');
            $table->enum('status', ['unpaid', 'paid', 'pending', 'loan', 'last_payment_decline'])->default('unpaid');
            $table->string('catatan')->nullable();
            $table->integer('properti_id');
            $table->integer('jumlah_dibayar')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
