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
        Schema::create('background', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('cover');
            $table->string('pembuka');
            $table->string('mempelai');
            $table->string('lovestory');
            $table->string('galeri');
            $table->string('videoprewed');
            $table->string('acara');
            $table->string('rsvp');
            $table->string('ucapan');
            $table->string('angpao');
            $table->string('livestreaming');
            $table->string('susunanacara');
            $table->string('penutup');



            $table->integer('orderid')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('background');
    }
};
