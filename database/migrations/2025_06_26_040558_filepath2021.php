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
        Schema::table('tahun2021s', function (Blueprint $table) {
        $table->string('filepath2021')->nullable();});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
