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
        Schema::create('font', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('primaryfont');
            $table->string('secondaryfont');
            $table->string('regularfont');
            $table->string('titlefont');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('font');
    }
};
