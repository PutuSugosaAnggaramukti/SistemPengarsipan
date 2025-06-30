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
        Schema::create('tahun2023s', function (Blueprint $table) {
            $table->id();
            $table->string('original_name');
            $table->string('generated_name');
            $table->year('year');
            $table->softDeletes(); // adds deleted_at timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun2023s');
    }
};
