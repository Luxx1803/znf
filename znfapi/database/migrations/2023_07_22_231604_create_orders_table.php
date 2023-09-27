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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('jenis');
            $table->string('name');
            $table->string('paket');
            $table->string('harga');
            $table->string('masaaktif');
            $table->string('noref');
            $table->string('tema_id');

            $table->string('galeri')->nullable();
            $table->string('status')->nullable();
            $table->string('fotopria')->nullable();
            $table->string('fotowanita')->nullable();
            $table->string('namelwanita')->nullable();
            $table->string('namelpria')->nullable();
            $table->string('namewanita')->nullable();
            $table->string('namepria')->nullable();
            $table->string('nameotpria')->nullable();
            $table->string('nameotwanita')->nullable();
            $table->string('igpria')->nullable();
            $table->string('igwanita')->nullable();
            $table->longText('lovestory')->nullable()->default('lorem');
            $table->string('tglacara')->nullable();
            $table->string('tglakad')->nullable();
            $table->string('jamakad')->nullable();
            $table->string('tempatakad')->nullable();
            $table->string('alamatakad')->nullable();
            $table->string('linkgmapsakad')->nullable();
            $table->string('tglresepsi')->nullable();
            $table->string('jamresepsi')->nullable();
            $table->string('tempatresepsi')->nullable();
            $table->string('alamatresepsi')->nullable();
            $table->string('linkgmapsresepsi')->nullable();
            $table->string('linkvideoprewed')->nullable();
            $table->string('jamlive')->nullable();
            $table->string('linkliveyt')->nullable();
            $table->string('linkliveig')->nullable();
            $table->string('linklivetiktok')->nullable();
            $table->string('fotocover')->nullable();
            $table->string('fotolovestory')->nullable();
            $table->string('fotorsvp')->nullable();
            $table->string('fotopenutup')->nullable();
            $table->string('namabank1')->nullable();
            $table->string('norek1')->nullable();
            $table->string('an1')->nullable();
            $table->string('namabank2')->nullable();
            $table->string('an2')->nullable();
            $table->string('norek2')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
