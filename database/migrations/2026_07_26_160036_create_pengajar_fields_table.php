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
        Schema::create('pengajar_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // lowercase, underscore
            $table->string('label'); // human readable
            $table->enum('type', ['text', 'number', 'textarea', 'select', 'radio', 'date'])->default('text');
            $table->json('options')->nullable(); // for select/radio
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajar_fields');
    }
};
