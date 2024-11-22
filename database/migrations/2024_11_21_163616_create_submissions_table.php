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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained('assignments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('file_name'); // hanya bisa pakai file
            $table->date('submit_date');
            // secara default statusnya Waiting To Be Assessed - menunggu diperiksa
            // status lain, Assessed - sudah dinilai.
            $table->string('status')->default('Waiting To Be Assessed');
            $table->double('score')->nullable();
            $table->timestamps();
            $table->unique(['assignment_id', 'student_id']); // 1 assignment 1 submission (kalau kumpul ulang file lama ditimpak)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
