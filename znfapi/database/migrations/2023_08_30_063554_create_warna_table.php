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
        Schema::create('warna', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('warnateks');
            $table->string('warnatexticon');
            $table->string('warnabutton');
            $table->string('warnabackground');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warna');
    }
};
