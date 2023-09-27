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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('userid');
            $table->string('nominal');
            $table->string('bukti_transfer');
            $table->string('tanggal_bayar');
            $table->string('status');
            $table->string('paket');
            $table->string('noreff');
            $table->string('jenis');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
