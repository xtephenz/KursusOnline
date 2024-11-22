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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->text('file_name'); // soal hanya bisa pakai file
            $table->date('start_date');
            $table->date('due_date');
            $table->integer('attempts')->nullable()->default(null); // null = unlimited attempts
            // secara default, statusnya On Going - sedang berjalan (selama belum lewat due date)
            // status lain, Locked - sudah lewat due date + tidak bisa lagi mengumpul
            $table->string('status')->default('On Going');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
