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
        Schema::create('task_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->boolean('read')->default(false);
            $table->boolean('write')->default(false);
            $table->boolean('mark_complete')->default(false);
            $table->boolean('update')->default(false);
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_roles');
    }
};
