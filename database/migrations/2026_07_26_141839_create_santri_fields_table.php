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
        Schema::create('santri_fields', function (Blueprint $table) {
            $table->id();
            $table->string('label', 100); // e.g. "Jenis kelamin"
            $table->string('name', 100)->unique(); // e.g. "jenis_kelamin"
            $table->enum('type', ['text', 'number', 'textarea', 'select', 'radio', 'date'])->default('text');
            $table->json('options')->nullable(); // For select/radio options
            $table->boolean('is_required')->default(true);
            $table->integer('order')->default(0); // For sorting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santri_fields');
    }
};
