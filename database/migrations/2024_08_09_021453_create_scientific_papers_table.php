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
        Schema::create('scientific_papers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->integer('year');
            $table->integer('nim')->unique();
            $table->string('author', 30)->unique();
            $table->string('mentor', 70);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scientific_papers');
    }
};
