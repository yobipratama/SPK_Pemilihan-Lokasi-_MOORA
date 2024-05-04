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
        Schema::create('kri_penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_penilaian_id');
            $table->integer('bobot');
            $table->foreign('sub_penilaian_id')->references('id')->on('sub_penilaians');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kri_penilaians');
    }
};
